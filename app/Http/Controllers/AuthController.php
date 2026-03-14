<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        session(['user_id' => $user->id]);

        return redirect('/posts');
    }

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $user = User::where('email',$request->email)->first();

        if($user && Hash::check($request->password,$user->password)){
            session(['user_id'=>$user->id]);
            return redirect('/posts');
        }

        return back()->with('error','Invalid credentials');
    }

    public function logout()
    {
        session()->forget('user_id');
        return redirect('/login');
    }
}