<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(!Auth::guest()){
            $cartList = DB::table('cart_items') ->join('products', 'cart_items.itemID','=','products.id')
                                                ->select('products.id as id', 'products.name as name', 'cart_items.quantity as quantity','products.pictures as pictures', 'products.price as price')
                                                ->where('cart_items.userID','=', Auth::user()->id)->get();

            $cart = session()->get('cart');
            if($cart)
                session()->forget('cart');
        
            echo $cartList;
            foreach($cartList as $cartItem){
                $cart[$cartItem->id] = [
                    "id" => $cartItem->id,
                    "name" => $cartItem->name,
                    "quantity" => $cartItem->quantity,
                    "price" => $cartItem->price,
                    "photo" => $cartItem->pictures
                ];     
            }

            session()->put('cart', $cart);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
