<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    // SuperAdminController.php
public function dashboard()
{
    return view('super-admin.dashboard-super-admin');
}
}
