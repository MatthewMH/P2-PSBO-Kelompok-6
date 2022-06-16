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

    public function save_item(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $user->save_item($request->buyer_username, $request->item_name, $request->seller_username);

        return response()->json(["message" => "Item Saved!"]);
    }

    public function show_saved_items(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $saves = $user->show_saved_items($request->username);
        
        if(!$saves)
        {
            return response()->json(["message" => "No Item Saved!"]);
        }
        else
        {
            return response()->json(["message" => "Item in Saved Shown!"]);
        }
    }

    public function delete_save_item(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $user->delete_save_item($request->username, $request->item_name);
        return response()->json(["message" => "Item deleted from Saved!"]);
    }

    public function buying_history(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $hist = $user->buying_history($request->username);

        if(!$hist)
        {
            return response()->json(["message" => "No buying record found!"]);
        }
        else
        {
            return response()->json(["message" => "Buying records shown!"]);
        }
    }

    public function review_item(Request $request)
    {
        $user = UserFactory::makeBuyer();
        $user->review_item($request->buyer_username, $request->item, $request->seller_username, $request->review);

        return response()->json(["message" => "Review Added!"]);
    }
}
