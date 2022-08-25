<?php

namespace App\Http\Controllers;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;

class CartController extends Controller
{
    //
    public function addToCart($itemID)
    {
        $product = Product::find($itemID);
        if(!$product) {
            abort(404);
        }

        //add to database
        if(!Auth::guest()){
            $exist = "";
            $exist = DB::table('cart_items')->where('userID', '=', Auth::user()->id)->where('itemID', '=', $itemID)->get();
            if($exist == ""){
                DB::table('cart_items')->insert([
                    'userID' => Auth::user()->id,
                    'itemID' => $itemID
                ]);
            }else{
                DB::table('cart_items')->where('userID', '=', Auth::user()->id)->where('itemID', '=', $itemID)->increment('quantity');
            }
        }

        //add to session
        $cart = session()->get('cart');
        if(!$cart) {
            $cart = [
                $itemID => [
                        "id" => $itemID,
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "photo" => $product->pictures
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$itemID])) {
            $cart[$itemID]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$itemID] = [
            "id" => $itemID,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->pictures
        ];
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function removeFromCart($itemID)
    {
        if($itemID) {
            //update in database
            if(!Auth::guest()){
                DB::table('cart_items')->where('userID', '=', Auth::user()->id)->where('itemID', '=', $itemID)->decrement('quantity');
                $quantity = DB::table('cart_items')->where('userID', '=', Auth::user()->id)->where('itemID', '=', $itemID)->select('quantity')->get();

                DB::table('cart_items')->where('quantity', '=', 0)->delete();
            }

            //update in session
            $cart = session()->get('cart');
            if(isset($cart[$itemID])) {
                $cart[$itemID]['quantity']--;

                if($cart[$itemID]['quantity'] == 0)
                    unset($cart[$itemID]);

                    session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }

        return redirect()->back();
    }

    public function deleteFromCart($itemID)
    {
        if($itemID) {
            //update in database
            if(!Auth::guest()){
                DB::table('cart_items')->where('userID', '=', Auth::user()->id)->where('itemID', '=', $itemID)->delete();
            }

            //update in session
            $cart = session()->get('cart');
            if(isset($cart[$itemID])) {
                unset($cart[$itemID]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }

        return redirect()->back();
    }

    public function clearCart(){
        if(!Auth::guest()){
            DB::table('cart_items')->where('userID', '=', Auth::user()->id)->delete();
        }

        session()->forget('cart');

        return redirect("/");
    }

    public function saveOrder(Request $request) {

        if ($request->totalPrice == 0) {
            $cart_is_empty = 1;
            return view("checkout", ["cart_is_empty"=>$cart_is_empty]);
        }

        $id = Auth::id();

        if (!empty($id)) {
            $user = DB::table('users')->select('*')->where('id', $id)->get();
            $user = $user[0];

            $validation_errors=array();
            if (!($user->phone)) {
                array_push($validation_errors, "Telephone number");
            }
            if (!($user->state)) {
                array_push($validation_errors, "State");
            }
            if (!($user->city)) {
                array_push($validation_errors, "City");
            }
            if (!($user->aptNumber)) {
                array_push($validation_errors, "Address");
            }
            if (!($user->postalCode)) {
                array_push($validation_errors, "Postal code");
            }
            if (!($user->cardExp)) {
                array_push($validation_errors, "Card expiration date");
            }
            if (!($user->cardNo)) {
                array_push($validation_errors, "Credit card number");
            }

            if (!empty($validation_errors)) {
                return view("checkout", ["validation_errors"=>$validation_errors]);
            }
        }

        $order = new Order();

        $order->product_id = $request->products;
        $order->price = $request->totalPrice;

        if(!Auth::guest())
            $order->user_id = Auth::user()->id;
        else
            $order->user_id = 0;

        $order->save();

        return redirect('/cart/clearCart');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
