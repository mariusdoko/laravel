<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    // if user is not log in, return to login page.
    public function __construct(){
        $this->middleware('auth');

    }


    public function index(){
        return view('contact');
    }
}
