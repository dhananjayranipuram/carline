<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(){
        return view('site/home');
    }

    public function aboutUs(){
        return view('site/about-us');
    }

    public function ourCars(){
        return view('site/our-cars');
    }

    public function offers(){
        return view('site/offers');
    }

    public function news(){
        return view('site/news');
    }

    public function contactUs(){
        return view('site/contact-us');
    }
}
