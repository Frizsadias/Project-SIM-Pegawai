<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // UserController.php
public function dashboard()
{
    return view('user.dashboard-user');
}
}
