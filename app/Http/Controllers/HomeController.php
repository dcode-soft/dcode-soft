<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Mail\Notification;
use Mail;

class HomeController extends Controller
{
    public function store(Request $request){
        Validator::make($request->all(), [
            'email' => 'required|email',
            // 'email' => 'required|email|unique:newsletters,email',
        ])->validate();
            
        $Newsletter = new Newsletter();
        $Newsletter->email = $request->email;
        $Newsletter->ip = $_SERVER['REMOTE_ADDR'];
        $Newsletter->datetime = date('Y-m-d H:i:s');
        $Newsletter->save();
        
        $json['success'] = true;
        $json['redirect'] = route('zip');

        return response()->json($json);
    }
    public function zip(){
        $filename = public_path('assets/assets.zip');
        
        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=assets.zip");
        header("Content-length: " . filesize($filename));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile($filename);
        exit;
    }
}
