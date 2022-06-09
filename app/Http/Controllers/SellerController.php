<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Seller;
use App\Models\UserFactory;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    private $user;

    public function signup(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'required|email|unique:sellers,email|max:255',
            'username' => 'required|unique:sellers,username|max:255',
            'password' => 'required|max:255',
            'location' => 'required|max:255',
            'contact' => 'required|unique:sellers,contact|max:13'
        ]);
        if($validated->fails())
        {
            return response()->json([
                "message" => "Input not valid!",
            ], 400);
        }
        else
        {
            $user = UserFactory::makeSeller();
            $user->signup($request->email, $request->username, $request->password, $request->location, $request->contact);

            return response()->json(["message" => "Sign Up Successful!"]);
        }
    }

    public function login(Request $request)
    {
        $user = UserFactory::makeSeller();
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

    public function add_item(Request $request)
    {
        $user = UserFactory::makeSeller();
        $user->add_item($request->username, $request->item_name, $request->price, $request->count);

        return response()->json(["message" => "Item Added Successfully!"]);
    }

    public function show_item(Request $request)
    {
        $user = UserFactory::makeSeller();
        $items = $user->show_item($request->username);

        if(!$items)
        {
            return response()->json(["message" => "No Item!"]);
        }
        else
        {
            return response()->json(["message" => "Item shown!"]);
        }
    }

    public function delete_item(Request $request)
    {
        $user = UserFactory::makeSeller();
        $delete = $user->delete_item($request->username, $request->item_name, $request->count);

        if($delete == 0)
        {
            return response()->json(["message" => "Number of item to be deleted is higher than stock!"]);
        }
        else if($delete == 1)
        {
            return response()->json(["message" => "Item deleted!"]);
        }
        else
        {
            return response()->json(["message" => "Stock reduced!"]);
        }
    }

    public function selling_history()
    {
        
    }

    public function transfer_amount()
    {
        
    }
}
