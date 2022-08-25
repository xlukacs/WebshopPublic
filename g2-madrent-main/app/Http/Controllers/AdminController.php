<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function showPanel()
    {
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->select('id', 'name', 'description', 'price')->limit(4)->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("users")->where("id",'=',1)->get();

        $formName = "users";

        return view('admin.adminPanel', compact('categoryList','productList','userList', 'formName', 'formData'));
    }  

    //=============Delete records==============
    public function deleteCategory(Request $request, $id)
    {
        DB::table('category_groups')->where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function deleteProduct(Request $request, $id)
    {
        $pictures = DB::table('products')->where('products.id','=',$id)->select('products.pictures as pictures')->get();

        if($pictures[0]->pictures){
            $list = explode(',', substr($pictures[0]->pictures, 1));
            foreach ($list as $item) {
                $image_path =  $_SERVER['DOCUMENT_ROOT']."/images/products/{$item}";
                $image_path = str_replace("/","\\", $image_path);
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
        }
        DB::table('products')->where('id', '=', $id)->delete();
        return redirect()->back();
    }
    
    public function deleteUser(Request $request, $id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->back();
    }

    //=============PATCH records==============
    public function updateCategory(Request $request, $id)
    {
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->select('id', 'name', 'description', 'price')->limit(4)->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("category_groups")->where("id",'=',$id)->get();
        
        $formName = "categories";

        return view('admin.editPopup', compact('categoryList','productList','userList', 'formData', 'formName'));
    }

    public function updateProduct(Request $request, $id)
    {
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->select('id', 'name', 'description', 'price', 'pictures')->limit(4)->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("products")->where("id",'=',$id)->get();
        
        $formName = "products";

        return view('admin.editPopup', compact('categoryList','productList','userList', 'formData', 'formName'));
    }
    
    public function updateUser(Request $request, $id)
    {
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->select('id', 'name', 'description', 'price')->limit(4)->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("users")->where("id",'=',$id)->get();

        $formName = "users";

        return view('admin.editPopup', compact('categoryList','productList','userList', 'formData', 'formName'));
    }

    public function updateRecord(Request $request, $tableName, $id){
        if($tableName == "category_groups"){
            DB::table($tableName)->where('id', '=',$id)->update(['picture' => $request->categoryIcon]);   
        }
        if($tableName == "products"){
            $pictureList = $request->pictures;
            $category = DB::table('products')->where('products.id','=',$id)->join('category_groups', 'category_groups.id','=','products.categoryID')->select('category_groups.name as categoryName')->get();
            if($request->delPictures){
                $list = explode(',', substr($request->delPictures, 1));
                //dd($list);
                foreach ($list as $item) {
                    $image_path =  $_SERVER['DOCUMENT_ROOT']."/images/products{$item}";
                    $image_path = str_replace("/","\\", $image_path);
                    //File::delete($image_path);
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                    //dd($image_path);
                }
                //dd($request->delPictures);
            }
            if($request->filePic){
                $file = $request->file('filePic');
                $fileName = Auth::user()->id . '_' . time() . '_'. $file->getClientOriginalName();  

                $file->move(public_path('/images/products/'.$category[0]->categoryName), $fileName);
                $pictureList .= ',/'.$category[0]->categoryName."/".$fileName;
            }
            
            DB::table($tableName)->where('id', '=',$id)->update(['name'=>$request->productName, 'description' => $request->productDescription, 'price' => $request->productPrice, 'pictures' => $pictureList]);   
        }
        if($tableName == "users"){
            DB::table($tableName)->where('id', '=',$id)->update(['role' => $request->userRole]);   
        }

        return redirect('/adminPanel');//TODO maybe message with a popup/prompt
    }

    //=============PUT records==============
    public function insertProduct(Request $request){
        //dd($request);
        $request->validate([
            'productName' => 'required|string|max:64',
            'productDescription' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'filePic' => 'required|image|max:128',
        ]); 

        $file = $request->file('filePic');
        $fileName = Auth::user()->id . '_' . time() . '_'. $file->getClientOriginalName();  

        $type = $file->getClientMimeType();
        $size = $file->getSize();

        $file->move(public_path('/images/products/'.$request->category), $fileName);
        
        $categoryFromDB = DB::table('category_groups')->select('category_groups.id')->where('name','=',$request->category)->get();
        $categoryID = $categoryFromDB[0]->id;
        DB::table('products')->insert(['name'=>$request->productName, 'description' => $request->productDescription, 'price' => $request->productPrice, 'pictures'=>'/'.$request->category.'/'.$fileName, 'inStock'=>0, 'brand'=>'NVIDIA', 'vm_size'=>'16', 'categoryID'=>$categoryID]);
 

        return redirect('/adminPanel');//TODO maybe message with a popup/prompt
    }
    
    public function addRecord(Request $request, $tableName){
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("users")->where("id",'=',1)->get();

        $formName = $tableName;
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->select('id', 'name', 'description', 'price')->limit(4)->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();

        return view('admin.addRecord', compact('categoryList','productList','userList', 'formData', 'formName'));
    }

    public function showSearchRes(Request $request)
    {
        $categoryList = DB::table('category_groups')->select('id', 'name', 'picture')->limit(4)->get();
        $productList = DB::table('products')->where('name','LIKE','%'.$request->searchQuery.'%')->get();
        $userList = DB::table('users')->select('id', 'name', 'role')->limit(4)->get();
        $formData = DB::table("users")->where("id",'=',1)->get();

        $formName = "users";

        return view('admin.adminPanel', compact('categoryList','productList','userList', 'formName', 'formData'));
    }
}
