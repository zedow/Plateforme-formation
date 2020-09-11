<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\Http\Requests\ContactRequest;

class c_contact extends Controller
{
    public function getData()
    {
        return view('contacter');
    }
    
    public function postData(ContactRequest $request)
    {
        /*
        Mail::send('emailContact',$request->all(),function($message)
        {
            $message->to('e')->subject('SFConsulting | Contact');
        }
        );*/
        return view('confirmer')->width('test',$request);
    }
}
