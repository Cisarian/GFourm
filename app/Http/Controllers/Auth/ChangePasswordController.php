<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    function __contruct()
    {
        $this-middleware('auth');
    }

    public function changePassword($user_id)
    {
        $validateData = [];
        $user = User::where('id', $user_id)->first();
        $checkData = request()->validate([
            'name' => 'nullable',
            'password'=> 'nullable'
        ]);
        if($checkData['name'] != null)
        {
            $validateData = request()->validate([
                'name' => 'min:3'                
            ]);
            if($validateData['name'] == $user->name){
            
            } else {
                $user -> name = $validateData['name'];
            }
        }
        if($checkData['password'] != null)
        {
            $validateData = request()->validate([
                'password' => 'required|required_with:password_confirmation|confirmed|min:8'
            ]);
            $user -> password = Hash::make($validateData['password']);
        }
        /*
        $validateData = request()->validate([
            'name' => 'min:3',
            'password' => 'required|required_with:password_confirmation|confirmed|min:8',
        ]);
        */
        
        $user -> save();
        
        return redirect(route('home'));
    }
    
}