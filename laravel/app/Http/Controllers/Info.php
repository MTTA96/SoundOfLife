<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\lain;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Info extends Controller
{
  //dont know what this for
  public function __construct()
  {
    $this->middleware('auth');
  }

  //User Info (DONE -- might need restyle)
  public function UserInfo($id)
  {
    $user = User::where('name', $id)->first();
    return view('info',['user'=>$user]);
  }

  //User list (NOT DONE)
  public function UserList(){
    $users = User::where('id','!=',Auth::id()->get());
    return view('info',['list'=>$users]);
  }

  //User edit get function (DONE)
  public function UserEdit($id){
    $user = User::where('id', $id)->first();
    return view('edit',['user'=>$user]);
  }

  //User edit post function (DONE -- ERRORS NOT SHOWING)
  public function Update(Request $request, $id){
    $this->validate(request(),[
      'name' => 'required',
      'email' => 'required|email',
      'question' => 'required|min:6',
      'answer' => 'required|min:6',
    ]);

    $user = User::where('id',$id)->first();
    $user->name=request('name');
    $user->email=request('email');
    $user->question=request('question');
    $user->answer=request('answer');
    $user->descr=request('descr');
    $user->save();
    return view('info',['user'=>$user]);
  }

  //Change password get function (DONE)
  public function ChangePass($id){
    $user = User::where('id', $id)->first();
    return view('changepass',['user'=>$user]);
  }

  //Change password post function (NOT DONE -- UNRESPONSIVE)
  public function PassChange(Request $request, $id){

    $this->validate(request(),[
      'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::where('id',$id)->first();
    $user->password=Hash::make(request('password'));
    $user->save();
    return view('info',['user'=>$user]);
  }
}
?>
