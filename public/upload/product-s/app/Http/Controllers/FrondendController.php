<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class FrondendController extends Controller {


    public function home() {

      $bestsell = DB::table( 'products' )->orderBy( 'id', 'Asc' )->limit(5)->get();
	  
      $products = DB::table( 'products' )->orderBy( 'id', 'Asc' )->limit(12)->get();
	  
      $banners  = DB::table( 'banners' )->orderBy( 'id', 'Asc' )->get();
    //   echo $banners;die;
        return view( 'web/index', compact( 'products','bestsell','banners' ) );
    }

	public function about_us ()
	{
		return view( 'web.aboutus' );
	}

	public function contact()
	{
		return view( 'web.contact' );
	}


    public function products(){
      $products = DB::table( 'products' )->orderBy( 'id', 'Asc' )->limit(12)->get();
        return view( 'web/products/index', compact( 'products') );
	}

    public function product( $id ){
		$product = 0;
      $product  = DB::table( 'products' )->where( 'id', $id )->first();
        return view( 'web/products/product', compact( 'product') );
    }

	public function categoryproducts($categoryurl){
		$getcategory_id = DB::table( 'categorys' )->where( 'category_url', $categoryurl )->first();
		$category_id = 0;
		$category_name = "";
		if($getcategory_id){
			$category_id = $getcategory_id->id;
			$category_name = $getcategory_id->category_name;
		}
		$products = DB::table( 'products' )->where( 'category_id', $category_id )->orderBy( 'id', 'Asc' )->get();
        return view( 'web/products/categoryproduct', compact( 'products','category_name') );
	}



	public function  admin()
	{

		return view( 'admin.login' );
	}

    public function slider() {

        $banners = DB::table( 'banners' )->orderBy( 'id', 'Asc' )->limit(12)->get();

          return view( 'web.slider', compact( 'banners' ) );
      }



    public function saveorder( Request $request ) {
        $adduser = DB::table( 'productorder' )->insert( [
            'product_id' => $request->prodect_id,
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'qity' => $request->qity,
            'email' => $request->email,
            'aderss' => $request->aderss,
            'status' => 'Active',
            'created_at' => date( 'Y-m-d H:i:s' ),
        ] );
	return redirect()->back()->with( 'success', 'Order Save Successfully ... !' );
    }

}
