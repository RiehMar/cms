<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewController extends Controller
{
    //

    public function index()
    {
        //
        return "its working";
    }

    public function show($id)
    {
        //
        return "its working".$id;
    }

    public function contact(){

        $people = ['Edwin', 'Jose', 'James', 'Peter', 'Maria'];
        return view('contact', compact('people'));
    }

    public function show_post($id, $name, $password){
        // return view('post_view')->with('id', $id);
        return view('post_view', compact('id','name','password'));
    }
}
