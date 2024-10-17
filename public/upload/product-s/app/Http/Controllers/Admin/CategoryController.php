<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;


class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


   public function updatecategory(Request $request)
    {
        $editcategory = DB::table('categorys')->where('id', $request->cat_id)->update([
            'category_name' => $request->category_name,
            'updated_at'    => date('Y-m-d H:i:s'),
            'status'        => $request->status,
        ]);
        $catid = $request->cat_id;
        $qrcode ="";
        if($request->photo != null){
         $qrcode = $catid.'.'.$request->file('photo')->extension();
         $filepath = public_path('upload'.DIRECTORY_SEPARATOR.'catimage'.DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['photo']['tmp_name'], $filepath.$qrcode);
         $sql = "update categorys set photo='$qrcode' where id = $catid";
           DB::update(DB::raw($sql));
       }
        return redirect()->back()->with( 'success', 'Category Updated Successfully ... !' );
    }

    public function manageSubcategory($id)
    {
        $sql = "select * from categorys where parent_id=$id order by id";
        $subcat = DB::select(DB::raw($sql));
        $sql = "select * from categorys where id=$id";
        $cat = DB::select(DB::raw($sql));
        $cat_name = "";
        $cat_id = 0;
        if (count($cat) > 0) {
            $cat_name = $cat[0]->category_name;
            $cat_id = $cat[0]->id;
        }
        return view("admin/category/subcategory", compact('subcat', 'cat_name', 'cat_id'));
    }

    public function addSubCategory(Request $request)
    {
		$category = $request->subcategory_name;
		$category_name = str_replace( "'", '', $category );
        $category_names = str_replace( [ '\\', '/' ], ' ', $category_name );
        $output = preg_replace( '!\s+!', ' ', $category_names );
        $category_url =  strtolower( str_replace( ' ', '_', $output ) );
		
        $addsubcategory = DB::table('categorys')->insert([
            'parent_id'        => $request->category_id,
            'category_name'    => $request->subcategory_name,
            'category_url'    => $category_url,
            'created_at'       => date('Y-m-d H:i:s'),
            'status'           => 1,
        ]);
        $last_insert_id = DB::getPdo()->lastInsertId();

        $qrcode ="";
        if($request->photo != null){
         $qrcode = $last_insert_id.'.'.$request->file('photo')->extension();
         $filepath = public_path('upload'.DIRECTORY_SEPARATOR.'catimage'.DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['photo']['tmp_name'], $filepath.$qrcode);
         $sql = "update categorys set photo='$qrcode' where id = $last_insert_id";
           DB::update(DB::raw($sql));
       }

        return redirect("admin/subcategory/" . $request->category_id)->with('success', 'SubCategory Added Successfully');
    }



















    public function catattribute()
    {
        $sql = "select * from categorys where parent_id=0 and status=1 order by id";
        $category = DB::select(DB::raw($sql));
        $sql = "select * from attribute order by attr_name";
        $attributes = DB::select(DB::raw($sql));
        $sql = "select a.*,b.category_name,c.attr_name,c.attr_type,d.category_name as cat from category_attribute a,categorys b,attribute c,categorys d where a.category_id=b.id and a.attr_id=c.id and b.parent_id=d.id";
        $attrlink = DB::select(DB::raw($sql));
        return view("admin/category/catattribute", compact('category','attributes','attrlink'));
    }

    public function linkattribute(Request $request){
        $cat_id = $request->cat_id;
        $sub_cat_id = $request->sub_cat_id;
        $attr_id = $request->attr_id;
        $sql = "insert into category_attribute (category_id,attr_id) values ($sub_cat_id,$attr_id)";
        DB::insert(DB::raw($sql));
        return redirect('admin/catattribute')->with('success', 'Attribute Linked Successfully');
    }

    public function getsubcategory(Request $request){
        $parent_id = $request->cat_id;
        $sql = "select id,category_name from categorys where parent_id=$parent_id and status=1 order by id";
        $subcategory = DB::select(DB::raw($sql));
        return response()->json($subcategory);
    }

    public function getcity(Request $request){
        $name = $request->state_id;
        $sql = "select * from states where name='$name'";
        $state = DB::select(DB::raw($sql));
        $state_id = $state[0]->id;
        $sql = "select id,city from cities where state_id=$state_id order by city";
        $cities = DB::select(DB::raw($sql));
        return response()->json($cities);
    }

    public function getattributes(Request $request){
        $sub_cat_id = $request->sub_cat_id;
        $sql = "select b.* from category_attribute a,attribute b where a.attr_id = b.id and a.category_id=$sub_cat_id";
        $attributes = DB::select(DB::raw($sql));
        return response()->json($attributes);
    }

    public function attribute()
    {
        $sql = "select * from attribute order by attr_name";
        $attributes = DB::select(DB::raw($sql));
        $attributes = json_decode(json_encode($attributes),true);
        foreach ($attributes as $key => $attr) {
            $attr_id = $attr["id"];
            $sql = "select * from category_attribute where attr_id = $attr_id";
            $result = DB::select(DB::raw($sql));
            $attributes[$key]["can_delete"] = true;
            if(count($result) > 0){
                $attributes[$key]["can_delete"] = false;
            }
        }
        $attributes = json_decode(json_encode($attributes));
        return view("admin/category/attribute", compact('attributes'));
    }

    public function categorys()
    {
        $sql = "select * from categorys where parent_id=0 and status=1 order by id";
        $category = DB::select(DB::raw($sql));
        return view("admin/category/index", compact('category'));
    }

    public function AddCategory(Request $request)
    {
		$category = $request->category_name;
		$category_name = str_replace( "'", '', $category );
        $category_names = str_replace( [ '\\', '/' ], ' ', $category_name );
        $output = preg_replace( '!\s+!', ' ', $category_names );
        $category_url =  strtolower( str_replace( ' ', '_', $output ) );

        $addcategory = DB::table('categorys')->insert([
            'parent_id' => 0,
            'category_name' => $request->category_name,
            'category_url' => $category_url,
            'created_at'    => date('Y-m-d H:i:s'),
            'status'        => 1,
        ]);

        $last_insert_id = DB::getPdo()->lastInsertId();

        $profile_photo = '';
        if ( $request->photo != null ) {
            $profile_photo = $last_insert_id . '.' . $request->file( 'photo' )->extension();
            $filepath = public_path( 'upload' . DIRECTORY_SEPARATOR . 'catimage' . DIRECTORY_SEPARATOR );
            move_uploaded_file( $_FILES[ 'photo' ][ 'tmp_name' ], $filepath . $profile_photo );
        }

        $addimg = DB::table( 'categorys' )->where( 'id', $last_insert_id )->update( [
            'photo' => $profile_photo,
        ] );
        return redirect()->back()->with( 'success', 'Add Category Successfully ... !' );
    }


    public function AddAttribute(Request $request)
    {
        $attr_value = "";
        if($request->attr_type == "dropdown" || $request->attr_type == "checkbox" || $request->attr_type == "radio"){
            $attr_value = $request->attr_value;
        }
        $addattribute = DB::table('attribute')->insert([
            'attr_name'        => $request->attr_name,
            'attr_type'        => $request->attr_type,
            'attr_value'       => $attr_value,
        ]);
        return redirect('admin/attribute')->with('success', 'Attribute Added Successfully');
    }

    public function deleteattribute($id)
    {
        $sql = "select * from category_attribute where attr_id = $id";
        $result = DB::select(DB::raw($sql));
        if(count($result) > 0){
            return redirect('admin/attribute')->with('success', 'This Attribute Cannot be Deleted');
        }else{
            $sql = "delete from attribute where id=$id";
            DB::delete(DB::raw($sql));
        }
        // return redirect()->back()->with( 'success', 'Attribute Deleted Successfully ... !' );
        return redirect('admin/attribute')->with('success', 'Attribute Deleted Successfully');
    }

    public function deleteattributelink($id)
    {
        $sql = "delete from category_attribute where id=$id";
        DB::delete(DB::raw($sql));
        return redirect('admin/catattribute')->with('success', 'Attribute Link Deleted Successfully');
    }

    public function deletesubcategory($id)
    {
        $sql = "delete from categorys where id=$id";
        DB::delete(DB::raw($sql));
        return redirect('admin/categorys')->with('success', 'Category Deleted Successfully');
    }



    public function editsubcategory(Request $request)
    {

        $editsubcategory = DB::table('categorys')->where('id', $request->row_id)->update([
            'category_name' => $request->subcategory_name,
            'updated_at'       => date('Y-m-d H:i:s'),
            'status'           => $request->status,
        ]);
        $qrcode ="";
        if($request->photo != null){
         $qrcode = $editsubcategory.'.'.$request->file('photo')->extension();
         $filepath = public_path('upload'.DIRECTORY_SEPARATOR.'catimage'.DIRECTORY_SEPARATOR);
         move_uploaded_file($_FILES['photo']['tmp_name'], $filepath.$qrcode);
         $sql = "update categorys set photo='$qrcode' where id = $row_id";
           DB::update(DB::raw($sql));
           $addimg = DB::table( 'categorys' )->where( 'id', $request->row_id )->update( [
            'photo' => $qrcode,
        ] );
        dd($request->all());
           }
        return redirect("admin/subcategory/". $request->parent_id)->with('success', 'Category Updated Successfully');
    }

    public function DeleteSubcat($id)
    {

        $cat = DB::table('categorys')->where('id', $id)->get();
        $parent_id = 0;
        if (count($cat) > 0) {
            $parent_id = $cat[0]->parent_id;
        }
        $deletesubcat = DB::table('categorys')->where('id', $id)->delete();

        return redirect("admin/subcategory/". $parent_id)->with('success', 'Subcategory Deleted Successfully');
    }

}
