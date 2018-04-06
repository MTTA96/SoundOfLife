<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class Info extends Controller
{
    public function UserInfo($name)
    {
      $user = User::where('name', $name)->first();
      return view('info',['user'=>$user]);
    }

    public function UserList(){
      $users = User::where('id','!=',Auth::id()->get());
      return view('info',['list'=>$users]);
    }
}
?>
