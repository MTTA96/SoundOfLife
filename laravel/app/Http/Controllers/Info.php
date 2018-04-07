<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\lain;
use Illuminate\Http\Request;
use App\Http\Requests;

class Info extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }

  public function UserInfo($name)
  {
    $user = User::where('name', $name)->first();
    return view('info',['user'=>$user]);
  }

  public function UserList(){
    $users = User::where('id','!=',Auth::id()->get());
    return view('info',['list'=>$users]);
  }

  public function UserEdit($id){
    $user = User::where('id', $id)->first();
    return view('edit',['user'=>$user]);
  }

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
}
?>
