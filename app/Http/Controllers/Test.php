<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMial;
use App\Models\User;

class Test extends Controller
{
    public function index(){
        $user = User::where('user_type', 1)->first();

        $details = [
            'user' => $user,
            'password' => '12331313',
        ];
        Mail::to($user->email)->send(new UserCreatedMial($details));
        var_dump('Sent mail');

    }

}