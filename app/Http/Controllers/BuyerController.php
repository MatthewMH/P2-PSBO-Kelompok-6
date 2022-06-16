<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Buyer;
use App\Models\UserFactory;

use Illuminate\Http\Request;

class BuyerController extends Controller
{
    private $user;

    public function signup(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|unique:buyers,email|max:255',
            'username' => 'required|unique:buyers,username|max:255',
            'password' => 'required|max:255',
            'location' => 'required|max:255',
            'contact' => 'required|unique:buyers,contact|max:13'
        ]);
        if($validated->fails())
        {
            return response()->json([
                "message" => "Input not valid!",
            ], 400);
        }
        else
        {
            $user = UserFactory::makeBuyer();
            $user->signup($request->email, $request->username, $request->password, $request->location, $request->contact);

            return response()->json(["message" => "Sign Up Successful!"]);
        }
    }

    public function login(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $val_user = $user->login($request->username, $request->password);

        if(!$val_user)
        {
            return response()->json(["message" => "Login Unsuccessful!"]);
        }
        else
        {
            return response()->json(["message" => "Login Successful!"]);
        }
    }

    public function add_amount(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $user->add_amount($request->username, $request->amount);

        return response()->json(["message" => "Amount Added Successfully!"]);
    }

    public function buy_item(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $buy = $user->buy_item($request->buyer_username, $request->seller_username, $request->item, $request->price, $request->count, $request->delivery);

        return response()->json(["message" => "Item bought!"]);
    }


}
