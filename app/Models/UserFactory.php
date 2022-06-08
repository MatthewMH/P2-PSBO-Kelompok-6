<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;

interface User_activity
{
    public function saves($email, $username, $password, $location, $contact);
    public function login($username, $password);
}

class UserFactory extends Model
{
    public static function makeSeller(): User_activity
    {
        return new Seller();
    }
}
