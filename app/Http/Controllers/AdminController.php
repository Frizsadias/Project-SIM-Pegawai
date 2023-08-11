<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // AdminController.php
public function dashboard()
{
    return view('admin.dashboard-admin');
}
}