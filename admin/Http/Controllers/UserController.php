<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   function index() {
      $users = User::latest()->paginate(100);
      return view('admin::users.index', compact(
         'users'
      ));
   }
   function logout() {
      \Auth::logout();
      return redirect()->to('/');
   }
}
