<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Categories;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index(Request $request){
        //FOR LEARNING PURPOSES dont mind this
        // $showPopup = true;
        // if($request->cookie("test") == null){
        //     Cookie::queue("test", "TESTVAL" ,120);
        // }else{
        //     $cookieData = $request->cookie("test");
        //     $showPopup = false;
        // }   

        $popupState = "refuse"; //allow, block, refuse
        //only change to allow or block if the user is authenticated
        if(!Auth::guest()){
            $hasVoted = false;
            if($hasVoted == true){
                $popupState = "block";            
            }
            else{
                $popupState = "allow";
            }
        }


        $categoryName = "home";
        $categories = DB::table('categories')->select('categories.name as categoryName')->join('category_groups', 'categories.groupID','=','category_groups.id')->where('category_groups.name', $categoryName)->get();
        return view('index', compact('categories', 'categoryName', 'popupState'));
    }

    public function category($categoryName){
        $productList = DB::table('products')->join('category_groups', 'products.categoryID','=','category_groups.id')
        ->where('category_groups.name','=',$categoryName)
        ->select('products.id as id', 'products.pictures as pictures', 'products.name as name', 'products.description as description', 'products.price as price')
        ->paginate(9)->withQueryString();

        $brandList = DB::table('products')->select('products.brand')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->get();
        $minProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->orderBy('price', 'asc')->limit(1)->get();
        $maxProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->orderBy('price', 'desc')->limit(1)->get();


        $searchQuery = "";
        $minPrice = $minProductValue[0]->price;
        $maxPrice = $maxProductValue[0]->price;
        $order = "ASC";
        $vmsize = "";
        $brand = "";

        $searchData['searchQuery'] = $searchQuery;
        $searchData['minPrice'] = $minPrice;
        $searchData['maxPrice'] = $maxPrice;
        $searchData['order'] = $order;
        $searchData['memVal'] = $vmsize;
        $searchData['brandVal'] = $brand;

        return view('products', compact('productList', 'categoryName', 'searchData', 'brandList','minProductValue','maxProductValue'));
    }

    public function products(Request $request)
    {
        $brandList = DB::table('products')->select('products.brand')->join('category_groups', 'products.categoryID','=','category_groups.id')->distinct()->get();
        $minProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->distinct()->orderBy('price', 'asc')->limit(1)->get();
        $maxProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->distinct()->orderBy('price', 'desc')->limit(1)->get();

        $categoryName = "home";
        $moneyForm = false;
        $additionalForm = false;
        $searchBar = false;
        $VMsize = false;
        $brands = false;

        $searchQuery = "";
        $minPrice = $minProductValue[0]->price;
        $maxPrice = $maxProductValue[0]->price;
        $order = "ASC";
        $vmsize = "";
        $brand = "";

        //init from hidden values
        if(isset($request->searchVal) || isset($request->minPrice)){
            $searchQuery = $request->searchVal;
            $minPrice = $request->minPrice;
            $maxPrice = $request->maxPrice;
            $order = $request->orderVal;
            $vmsize = $request->memVal;
            $brand = $request->brandVal;
        }

        //get if there are new values
        if(isset($request->lowerBound))
            $moneyForm = true;
        if(isset($request->additionalFilter))
            $additionalForm = true;
        if(isset($request->searchInputButton))
            $searchBar = true;
        if(isset($request->VMsize))
            $VMsize = true;
        if(isset($request->brand))
            $brands = true;


        if($searchBar)
            $searchQuery = $request->searchInput;


        if($moneyForm){
            $minPrice = $request->lowerBound;
            $maxPrice = $request->upperBound;
        }
        if($additionalForm){
            $order = $request->additionalFilter;
        }
        if($VMsize){
            $vmsize = $request->VMsize;
        }
        // if($brands){
        //     $args = explode("&", $request);
        //     $list = "";
        //     foreach($args as $arg){
        //         if(strpos($arg, "brand%5B%5D=") !== false){
        //             $moneyForm = true;
        //             $argParts = explode('=', $arg);
        //             $list = $list.$argParts[1].",";
        //         }
        //     }
        //     $list = substr($list, 0, -1);

        //     $brand = $list;
        // }

        $brand1 = "";
        $brand2 = "";
        $brand3 = "";

        $searchData['searchQuery'] = $searchQuery;
        $searchData['minPrice'] = $minPrice;
        $searchData['maxPrice'] = $maxPrice;
        $searchData['order'] = $order;
        $searchData['memVal'] = $vmsize;
        $searchData['brandVal'] = $brand;

        $brandListInURL = explode(",", $brand);
        if(count($brandListInURL) == 2){
            $brand1 = $brandListInURL[0];
            $brand2 = $brandListInURL[1];
        }else if(count($brandListInURL) == 1){
            $brand3 = $brandListInURL[0];
        }
        if($brand == null){
            $brandListInURL = [];
        }

        if(count($brandListInURL) > 0){
            //no category is set, basically search came from a random url
            $productList = DB::table('products')
            ->select('products.id as id', 'products.pictures as pictures', 'products.name as name', 'products.description as description', 'products.price as price')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->where(function($query) use ($brand1, $brand2, $brand3){
                $query->where('products.brand', 'LIKE', $brand1)
                    ->orWhere('products.brand', 'LIKE', $brand2)
                    ->orWhere('products.brand', 'LIKE', $brand3);

            })
            ->orderBy('price',$order)
            ->paginate(9)->withQueryString();

            $brandList = DB::table('products')
            ->select('products.brand')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->where(function($query) use ($brand1, $brand2, $brand3){
                $query->where('products.brand', 'LIKE', $brand1)
                    ->orWhere('products.brand', 'LIKE', $brand2)
                    ->orWhere('products.brand', 'LIKE', $brand3);

            })
            ->orderBy('price',$order)
            ->join('category_groups', 'products.categoryID','=','category_groups.id')
            ->distinct()->get();
        }else{
            //no category is set, basically search came from a random url
            $productList = DB::table('products')
            ->select('products.id as id', 'products.pictures as pictures', 'products.name as name', 'products.description as description', 'products.price as price')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->orderBy('price',$order)
            ->paginate(9)->withQueryString();

            $brandList = DB::table('products')
            ->select('products.brand')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->orderBy('price',$order)
            ->join('category_groups', 'products.categoryID','=','category_groups.id')
            ->distinct()->get();
        }


        //dd($searchData);

        return view('products', compact('productList', 'categoryName', 'searchData', 'brandList','minProductValue','maxProductValue'));
    }

    public function productsWithCategory(Request $request, $categoryName = "", $args = "")
    {
        $brandList = DB::table('products')->select('products.brand')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->get();
        $minProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->orderBy('price', 'asc')->limit(1)->get();
        $maxProductValue = DB::table('products')->select('products.price')->join('category_groups', 'products.categoryID','=','category_groups.id')->where('category_groups.name', $categoryName)->distinct()->orderBy('price', 'desc')->limit(1)->get();

        //dd($brandList);

        $moneyForm = false;
        $additionalForm = false;
        $searchBar = false;
        $VMsize = false;
        $brands = false;

        $searchQuery = "";
        $minPrice = $minProductValue[0]->price;
        $maxPrice = $maxProductValue[0]->price;
        $order = "ASC";
        $vmsize = "";
        $brand = "";

        //init from hidden values
        if(isset($request->searchVal) || isset($request->minPrice)){
            $searchQuery = $request->searchVal;
            $minPrice = $request->minPrice;
            $maxPrice = $request->maxPrice;
            $order = $request->orderVal;
            $vmsize = $request->memVal;
            $brand = $request->brandVal;
        }

        //get if there are new values
        if(isset($request->lowerBound))
            $moneyForm = true;
        if(isset($request->additionalFilter))
            $additionalForm = true;
        if(isset($request->searchInputButton))
            $searchBar = true;
        if(isset($request->VMsize))
            $VMsize = true;
        if(isset($request->brand))
            $brands = true;


        if($searchBar)
            $searchQuery = $request->searchInput;
        if($moneyForm){
            $minPrice = $request->lowerBound;
            $maxPrice = $request->upperBound;
        }
        if($additionalForm){
            $order = $request->additionalFilter;
        }
        if($VMsize){
            $vmsize = $request->VMsize;
        }
        /*if($brands){
            $args = explode("&", $request);
            $list = "";
            foreach($args as $arg){
                if(strpos($arg, "brand%5B%5D=") !== false){
                    $moneyForm = true;
                    $argParts = explode('=', $arg);

                    if(strpos($list, $argParts[1]) === false){
                        $list = $list.$argParts[1].",";
                    }
                }
            }
            $list = substr($list, 0, -1);

            $brand = $list;
        }*/

        $brand1 = "";
        $brand2 = "";
        $brand3 = "";

        $searchData['searchQuery'] = $searchQuery;
        $searchData['minPrice'] = $minPrice;
        $searchData['maxPrice'] = $maxPrice;
        $searchData['order'] = $order;
        $searchData['memVal'] = $vmsize;
        $searchData['brandVal'] = $brand;

        $brandListInURL = explode(",", $brand);
        if(count($brandListInURL) == 2){
            $brand1 = $brandListInURL[0];
            $brand2 = $brandListInURL[1];
        }else if(count($brandListInURL) == 1){
            $brand3 = $brandListInURL[0];
        }
        if($brand == null){
            $brandListInURL = [];
        }

        if(count($brandListInURL) > 0){
            //request came from an url where a category was selected
            $productList = DB::table('products')->join('category_groups', 'products.categoryID','=','category_groups.id')
            ->select('products.id as id', 'products.pictures as pictures', 'products.name as name', 'products.description as description', 'products.price as price')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('category_groups.name','=',$categoryName)
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->where(function($query) use ($brand1, $brand2, $brand3){
                $query->where('products.brand', 'LIKE', $brand1)
                        ->orWhere('products.brand', 'LIKE', $brand2)
                        ->orWhere('products.brand', 'LIKE', $brand3);

            })
            ->orderBy('price',$order)
            ->paginate(9)->withQueryString();
        }else{
            //request came from an url where a category was selected
            $productList = DB::table('products')->join('category_groups', 'products.categoryID','=','category_groups.id')
            ->select('products.id as id', 'products.pictures as pictures', 'products.name as name', 'products.description as description', 'products.price as price')
            ->where('products.name','LIKE',"%$searchQuery%")
            ->where('category_groups.name','=',$categoryName)
            ->where('price','>=', $minPrice)
            ->where('price', '<=', $maxPrice)
            ->where('products.vm_size', '>=', (int)$vmsize)
            ->orderBy('price',$order)
            ->paginate(9)->withQueryString();
        }



        return view('products', compact('productList', 'categoryName', 'searchData', 'brandList','minProductValue','maxProductValue'));
    }

    public function product($productID)
    {
        $categoryName = "PC";
        $productData = Product::find($productID);
        return view('product', compact('productData', 'categoryName'));
    }

    public function product_reviews($productID)
    {
        $productID = 1;
        $categoryName = "PC";
        $productData = Product::find($productID);
        return view('product_reviews', compact('productData', 'categoryName'));
    }

    public function edit_data()
    {
        return view('edit_data');
    }
}
