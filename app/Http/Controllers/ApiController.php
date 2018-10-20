<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    //login

    public function login(Request $request)
    {
        $userdata = array(
            'email' => $request['email'],
            'password' => $request['password']
        );

        if (Auth::attempt($userdata)) {
            $user = Auth::user();
            $response = 'success';
            $status = '1';
            $send = ['data' => $user,
                'response' => $response, 'status' => $status
            ];

            return json_encode($send);
        }
		 else {
            $redata = array();
            $response = 'Your Username or Password incorrect';
            $status = '0';
            $send = [
                'data' => $redata, 'response' => $response, 'status' => $status
            ];
            return json_encode($send);
        }
    }

//create new user

    public function Register(Request $request)
    {
        $user = User::where('email', $request['email'])->get();

        if (count($user) == 0) {
            $register = new User();
            $register->name = $request['name'];
            $register->email = $request['email'];
            $register->password = bcrypt($request['password']);
            $register->save();

            $response = 'success';
            $status = '1';
            $send = ['data' => $register,
                'response' => $response, 'status' => $status
            ];
            return json_encode($send);
        }
		 else {
            $redata = array();
            $response = 'User Already Exit';
            $status = '0';
            $send = [
                'data' => $redata, 'response' => $response, 'status' => $status
            ];
            return json_encode($send);
        }
    }
}