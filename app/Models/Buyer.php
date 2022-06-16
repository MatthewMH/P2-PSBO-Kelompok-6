<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserFactory;
use App\Models\Item;
use App\Models\Seller;
use App\Models\Delivery;
use App\Models\Saved;

class Buyer implements User_activity
{
    public function signup($email, $username, $password, $location, $contact)
    {
        DB::table('buyers')->insert([
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'location' => $location,
            'contact' => $contact,
            'amount' => 0
        ]);
    }

    public function login($username, $password)
    {
        $users = DB::select('select * from buyers where username = ? and password = ?', [$username, $password]);
        return $users;
    }

    public function buy_item($buyer_username, $seller_username, $item, $price, $count, $delivery)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$buyer_username]))->pluck('id');
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$seller_username]))->pluck('id');
        
        $buyer_amount = collect(DB::select('select amount from buyers where id = ?', [$id_buyer[0]]))->pluck('amount');
        $seller_amount = collect(DB::select('select amount from sellers where id = ?', [$id_seller[0]]))->pluck('amount');

        $id_shipment = collect(DB::select('select id from deliveries where delivery_name = ?', [$delivery]))->pluck('id');
        $shipment_price = collect(DB::select('select delivery_price from deliveries where id = ?', [$id_shipment[0]]))->pluck('delivery_price');
        
        $id_item = collect(DB::select('select id from items where item_name = ?', [$item]))->pluck('id');

        if($buyer_amount[0] >= $price * $count + $shipment_price[0])
        {
            $seller = UserFactory::makeSeller();
            $delete = $seller->delete_item($seller_username, $item, $count);
            
            if($delete)
            {
                $buyer_affected = DB::table('buyers')->where('id', $id_buyer[0])->update(['amount' => $buyer_amount[0] - ($price * $count) - $shipment_price[0]]);
                $seller_affected = DB::table('sellers')->where('id', $id_seller[0])->update(['amount' => $seller_amount[0] + $price * $count]);
                
                $transaction = new Transaction();
                $transaction->set_id_seller($id_seller[0]);
                $transaction->set_id_buyer($id_buyer[0]);
                $transaction->set_id_item($id_item[0]);
                $transaction->set_price($price);
                $transaction->set_count($count);
                $transaction->set_total_price($price * $count);

                $transaction->insert_to_db();
            }
        }
    }

    public function save_item($buyer_username, $item_name, $seller_username)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$buyer_username]))->pluck('id');
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$seller_username]))->pluck('id');
        $id_item = collect(DB::select('select id from items where item_name = ?', [$item_name]))->pluck('id');
        
        $saved = new Saved();
        $saved->set_id_seller($id_seller[0]);
        $saved->set_id_buyer($id_buyer[0]);
        $saved->set_id_item($id_item[0]);

        $saved->insert_to_db();
    }

    public function show_saved_items($username)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $saves = DB::select('select * from saveds where idbuyer = ?', [$id_buyer[0]]);

        return $saves;
    }

    public function delete_save_item($username, $item_name)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $id_item = collect(DB::select('select id from items where item_name = ?', [$item_name]))->pluck('id');
        $deleted = DB::table('saveds')->where('idbuyer', $id_buyer[0])->where('iditem', $id_item[0])->delete();
    }

    public function buying_history($username)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $history = DB::select('select * from transactions where idbuyer = ?', [$id_buyer[0]]);

        return $history;
    }

    public function review_item($buyer_username, $item, $seller_username, $review)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$buyer_username]))->pluck('id');
        $id_item = collect(DB::select('select id from items where item_name = ?', [$item]))->pluck('id');
        $id_seller = collect(DB::select('select id from sellers where username = ?', [$seller_username]))->pluck('id');

        $reviews = new Reviews();
        $reviews->set_id_buyer($id_buyer[0]);
        $reviews->set_id_item($id_item[0]);
        $reviews->set_id_seller($id_seller[0]);
        $reviews->set_review($review);

        $reviews->insert_to_db();
    }

    public function add_amount($username, $amount)
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $amount_prev = collect(DB::select('select amount from buyers where id = ?', [$id_buyer[0]]))->pluck('amount');
        $affected = DB::table('buyers')->where('id', $id_buyer[0])->update(['amount' => $amount_prev[0] + $amount]);
    }
}
