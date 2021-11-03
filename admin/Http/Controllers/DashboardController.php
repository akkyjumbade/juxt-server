<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeoLocation;

class DashboardController extends Controller
{
   function index() {
      return view('admin::index');
   }
   function logout() {
      \Auth::logout();
      return redirect()->to('/');
   }
}
