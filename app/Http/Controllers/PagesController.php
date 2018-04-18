<?php

namespace noname\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Mein';
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'boat ass';
        return view('pages.about') -> with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Our services',
            'services' => ['have a seat', 'stuff 2']
        );
        return view('pages.services') -> with($data);
    }

    
    
}
