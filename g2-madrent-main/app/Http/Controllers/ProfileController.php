<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $subSite = "orders";
        $ordersList = DB::table('orders')->where('orders.user_id', '=', Auth::user()->id)->get();

        $nthOrder = 0;
        $orderProductList = [];

        if (count($ordersList) > 0) {
            foreach ($ordersList as $order) {
                $data;
                $data['id'] = $nthOrder;
                $data['ordered_at'] = $order->created_at;
                $products = explode(',', $order->product_id);
                $nthItem = 0;
                unset($orderItems);
                foreach ($products as $product) {
                    $productData = explode(':', $product);
                    $data['quantity'] = $productData[1];
                    $productData = DB::table('products')->where('products.id', '=', $productData[0])->get();
                    $pictures = explode(',', $productData[0]->pictures);
                    $data['picture'] = $pictures[0];
                    $data['name'] = $productData[0]->name;
                    $data['price'] = $productData[0]->price * $data['quantity'];
                    $orderItems[$nthItem++] = $data;
                }
                $orderProductList[$nthOrder++] = $orderItems;
            }
        }

        return view('profile.profile', compact('subSite', 'orderProductList'));
    }

    public function settings()
    {
        $subSite = "settings";

        $userData = DB::table('users')->where('id', '=', Auth::user()->id)
            ->get();


        return view('profile.profile', compact('subSite', 'userData'));
    }

    public function edit($id)
    {
        return view('edit_data', compact('id'));
    }

    public function update(Request $request, $id)
    {
        if (!$request) {
            abort(404);
        }
        $users = DB::table('users')->select('id')->where('id', $id)->get();

        if (empty($users)) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'aptNumber' => 'required|string|max:255',
            'phone' => 'required|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/',
            'cardExp' => array('required', 'regex:/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/'),
            'cardNo' => 'required|regex:/^([0-9]{4}[ ][0-9]{4}[ ][0-9]{4}[ ][0-9]{4})/',
            'postalCode' => 'required|regex: /\d{3}[ ]?\d{2}/'
        ]);

        $name = $request->input('name');
        $lastName = $request->input('lastName');
        $phone = $request->input('phone');
        $state = $request->input('state');
        $city = $request->input('city');
        $aptNumber = $request->input('aptNumber');
        $postalCode = $request->input('postalCode');
        $cardExp = $request->input('cardExp');
        $cardNo = $request->input('cardNo');

        DB::update('update users set name = ?, lastName = ?, phone = ?, state = ?, city = ?,
                 aptNumber = ?, postalCode = ?, cardEXp = ?, cardNo = ? where id = ?', [$name, $lastName,
            $phone, $state, $city, $aptNumber, $postalCode, $cardExp, $cardNo, $id]);

        $request->session()->flash('status', 'User Updated Successfully');

        return redirect('/cart/checkout');
    }

    public function applySettings(Request $request, $colName)
    {
        $user = Auth::user();
        if($colName == "phoneNum"){
            $request->validate([
                'phoneNumber' => 'required'
            ]);
            DB::table('users')->where('id', '=', Auth::user()->id)->update(['phone' => $request->phoneNumber]);
        }
        if($colName == "email"){
            $request->validate([
                'email' => 'required|email'
            ]);
            DB::table('users')->where('id', '=', Auth::user()->id)->update(['email' => $request->email]);
            $user->email = $request->email;
        }
        if($colName == "password"){
            $request->validate([
                'password' => 'required'
            ]);
            DB::table('users')->where('id', '=', Auth::user()->id)->update(['password' => Hash::make($request->password)]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('/profile/settings');
    }
}
