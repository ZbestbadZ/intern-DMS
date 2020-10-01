<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index() {
        User::getPickup();
    }
}
