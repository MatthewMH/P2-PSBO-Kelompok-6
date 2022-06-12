<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\UserFactory;
use App\Models\Item;

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

    public function buy_item()
    {

    }

    public function save_item()
    {

    }

    public function show_save_item()
    {

    }

    public function delete_save_item()
    {

    }

    public function pay_item()
    {

    }

    public function choose_delivery()
    {

    }

    public function buying_history()
    {

    }

    public function review_item()
    {

    }

    public function add_amount()
    {
        $id_buyer = collect(DB::select('select id from buyers where username = ?', [$username]))->pluck('id');
        $amount = collect(DB::select('select amount from buyers where amount = ?', [$amount]))->pluck('amount');

        if(!$item)
        {
            DB::table('buyers')->insert([
                'idbuyer' => $id_buyer[0],
                'amount' => $amount
            ]);
        }
        else
        {
            $amount_prev = collect(DB::select('select amount from buyers where amount = ?',[$amount]))->pluck('amount');
            $affected = DB::table('buyers')->where('idbuyer', $id_buyer[0])->where('amount', $amount)->update(['amount' => $amount_prev[0] + $amount]);
        }
    }

    use HasFactory;
}
