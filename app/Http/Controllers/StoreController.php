<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    use PasswordValidationRules;

    public function register()
    {
        return view('stores.register');
    }

    //when register is clicked
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'store_name' => ['required', 'string', 'max:255', 'unique:stores,name'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'license' => ['required'],
        ]);

        //Create a User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        //Store the license
        $path = $request->license->store('licenses');


        //Create a Store for the User
        $store = Store::create([
            'user_id' => $user->id,
            'name' => $request->store_name,
            'state' => $request->state,
            'city' => $request->city,
            'country' => 'USA',
            'address' => $request->address,
            'phone' => $request->phone,
            'license' => $path,
            'approved' => false
        ]);





        return $request;
    }
}
