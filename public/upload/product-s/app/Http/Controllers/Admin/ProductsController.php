<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Jenssegers\Agent\Agent;
use App\FCM;

class ProductsController extends Controller {

    public function __construct() {
        $this->middleware( 'auth' );
    }

    public function products() {

      $products = DB::table( 'products' )->orderBy( 'id', 'Asc' )->get();

        return view( 'admin/products/viewproducts', compact( 'products' ) );
    }

    public function dropproduct( $id ) {
        $dropproduct = DB::table( 'products' )->where( 'id', $id )->delete();
        return redirect()->back()->with('success', 'product deleted Successfully ... !');
    }

    public function details( $status, $id ) {

        $orders = DB::table( 'order_details' )->select( 'order_details.*', 'orders.net_total')
        ->Join( 'orders', 'orders.id', '=', 'order_details.order_id' )
        ->where( 'order_details.order_id', $id )
        ->where( 'order_details.status', $status )
        ->orderBy( 'order_details.id', 'Asc' )->get();
        return view( 'admin/products/details', compact( 'orders' ) );
    }

    public function addproduct() {
        $seller_id = auth()->user()->id;
        $products = DB::table( 'products' )->orderBy( 'id', 'desc' )->get();
        $categorys = DB::table( 'categorys' )->where( 'parent_id', 0 )->where( 'status', 1 )->orderBy( 'id', 'desc' )->get();
        $seller = DB::table( 'users' )->where( 'id', $seller_id )->where( 'status', 1 )->orderBy( 'id', 'desc' )->get();

        return view( 'admin/products/addproduct', compact( 'products', 'categorys', 'seller') );
    }

    public function saveproduct( Request $request ) {
        $cat_id = $request->cat_id;
        $name = $request->product_name;
        $product_name = str_replace( "'", '', $name );
        $product_name = str_replace( [ '\\', '/' ], ' ', $product_name );
        $output = preg_replace( '!\s+!', ' ', $product_name );
        $product_url =  strtolower( str_replace( ' ', '_', $output ) );

        $adduser = DB::table( 'products' )->insert( [
            'category_id' => $request->sub_cat_id,
            'product_name' => $product_name,
            'price' => $request->price,
            'product_url' => $product_url,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'status' => 'Active',
        ] );

        $last_insert_id = DB::getPdo()->lastInsertId();

        return redirect( 'admin/editproduct'."/".$last_insert_id )->with( 'success', 'Products Added Successfully' );

    }

    public function editproduct( $id ) {

        $sql = 'select * from categorys where status=1 and parent_id = 0 order by id';
        $category = DB::select( DB::raw( $sql ) );

        $sql = "select * from products where id=$id";
        $products = DB::select( DB::raw( $sql ) );

        $sub_cat_id = $products[ 0 ]->category_id;
        $products = json_decode( json_encode( $products ), true );
        foreach ( $products as $key => $prod ) {
            $products[ $key ][ 'related' ] = array();
            $product_id = $prod[ 'id' ];
            $sql = "select related_id from related_products where product_id=$product_id order by id desc";
            $result = DB::select( $sql );
            $products[ $key ][ 'related' ] = $result;
        }

        $sql = "select parent_id from categorys where id=$sub_cat_id";
        $maicat = DB::select( DB::raw( $sql ) );
        $cat_id = 0;
        if ( count( $maicat ) > 0 ) {
            $cat_id = $maicat[ 0 ]->parent_id;
        }
        // $cat_id = $maicat[ 0 ]->parent_id;

        $sql = "select * from categorys where status=1 and parent_id = $cat_id and  parent_id != 0 order by category_name ";
        $sub_category = DB::select( DB::raw( $sql ) );
        $related = DB::table( 'products' )->orderBy( 'id', 'desc' )->get();
        $sql = "select * from products where category_id=$sub_cat_id and id != $id";
        $relatedproducts = DB::select( DB::raw( $sql ) );
		$sql = "select * from product_image where product_id=$id";
        $productimage = DB::select( DB::raw( $sql ) );

        // echo'<pre>'; print_r( $productimage );echo'</pre>'; die;

        return view( 'admin/products/editproduct', compact( 'products', 'category', 'sub_category', 'cat_id', 'sub_cat_id', 'related','relatedproducts','productimage') );
    }

    public function saveproductimage( Request $request ) {

        $product_id = $request->product_id;

        $product_name = $request->product_name;
        $output = preg_replace( '!\s+!', ' ', $product_name );
        $product_url =  strtolower( str_replace( ' ', '_', $output ) );

        $phone = '';
        if ( $request->phone != null ) {
            $phone = $product_url . '-' . $product_id . '.' . $request->file( 'phone' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'phone' ][ 'tmp_name' ], $filepath . $phone );

            $addimg = DB::table( 'product_image' )->where( 'id', $product_id )->insert( [
                'phone'      => $phone,
                'product_id' => $product_id

            ] );
        }

	return redirect()->back()->with( 'success', 'Products ADD Successfully ... !' );

    }

    public function updateproduct( Request $request ) {
        $product_id = $request->product_id;
        $category_id = $request->sub_cat_id;
        $name = $request->product_name;
        $product_name = str_replace( "'", '', $name );
        $product_name = str_replace( [ '\\', '/' ], ' ', $product_name );
        $output = preg_replace( '!\s+!', ' ', $product_name );
        $product_url =  strtolower( str_replace( ' ', '_', $output ) );
        DB::table( 'products' )->where( 'id', $product_id )->update( [
            'product_name'       =>   $request->product_name,
            'cut_price'          =>   $request->cut_price,
            'selling_price'      =>   $request->selling_price,
            'category_id'        =>   $category_id,
            'product_url'        =>   $request->product_url,
            'description'        =>   $request->description,
            'short_description'  =>   $request->short_description,
            'customer_request_one_id'  =>   $request->customer_request_one_id,
            'stock'              => $request->stock,
            'status'             => $request->status,
        ] );
        if ( $request->input( 'related' ) == '' ) {
            DB::table( 'related_products' )->where( 'product_id', $product_id )->delete();
        } else {
            DB::table( 'related_products' )->where( 'product_id', $product_id )->delete();
            foreach ( $request->input( 'related' ) as $key => $related_id ) {

                DB::table( 'related_products' )->insert( [
                    'product_id'       =>   $product_id,
                    'related_id'       =>   $related_id,
                    'created_at'       =>   date( 'Y-m-d H:i:s' ),
                ] );
            }
        }

        $product_image = '';
        if ( $request->product_image != null ) {
            $product_image = $product_url . '-' . $product_id . '.' . $request->file( 'product_image' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'product_image' ][ 'tmp_name' ], $filepath . $product_image );
            $addimg = DB::table( 'products' )->where( 'id', $product_id )->update( [
                'photo' => $product_image,
            ] );
        }

        $product_image2 = '';
        if ( $request->product_image2 != null ) {
            $product_image2 = $product_url . '-' . $product_id . '_2.' . $request->file( 'product_image2' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'product_image2' ][ 'tmp_name' ], $filepath . $product_image2 );
            $addimg = DB::table( 'products' )->where( 'id', $product_id )->update( [
                'photo2' => $product_image2,
            ] );
        }

        $product_image23 = '';
        if ( $request->product_image3 != null ) {
            $product_image3 = $product_url . '-' . $product_id . '_3.' . $request->file( 'product_image3' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'product_image3' ][ 'tmp_name' ], $filepath . $product_image3 );
            $addimg = DB::table( 'products' )->where( 'id', $product_id )->update( [
                'photo3' => $product_image3,
            ] );
        }
        return redirect( 'admin/products' )->with( 'success', 'Products Updated Successfully' );
    }

    public function pendingorder() {
        $pendingorder = DB::table( 'productorder' )->select( 'productorder.*', 'products.product_name')
        ->Join( 'products', 'products.id', '=', 'productorder.product_id' )
        ->where( 'productorder.status', 'Active' )
        ->orderBy( 'productorder.id', 'Asc' )->get();
        return view( 'admin/users/pendingorder', compact( 'pendingorder') );
    }

    public function completedorder() {
        $completedorder = DB::table( 'productorder' )->select( 'productorder.*', 'products.product_name')
        ->Join( 'products', 'products.id', '=', 'productorder.product_id' )
        ->where( 'productorder.status', 'Inactive' )
        ->orderBy( 'productorder.id', 'Asc' )->get();
        return view( 'admin/users/completedorder', compact( 'completedorder') );
    }
}
