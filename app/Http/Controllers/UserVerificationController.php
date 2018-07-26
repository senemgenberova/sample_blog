<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserVerification;


class UserVerificationController extends Controller
{
    public function verifyUser($token){
    	$message = "";

    	$verification = UserVerification::where('token',$token)->first();

    	if(isset($verification)){
    		if($verification->user->isVerified == 0){
    			$verification->user->isVerified = 1;
    			$verification->user->save();

    			$message = "Your account is verified, you can login now";
    		}
    		else{
    			$message = "Your account is already verified, you can login now";
    		}
    	}
    	else{
    		return redirect('/login')->with('warning','Your account is not found');
    	}

    	return redirect('/login')->with('success', $message );

    }
}
