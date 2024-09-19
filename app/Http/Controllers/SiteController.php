<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use Session;
use Redirect;
use Storage;
use File;
use \Illuminate\Http\UploadedFile;
use URL;

class SiteController extends Controller
{
    public function index(){
        $site = new Site();
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars();
        $data['carType'] = $site->getCarType();
        return view('site/home',$data);
    }

    public function ourCars(){
        $site = new Site();
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars();
        $data['carType'] = $site->getCarType();
        return view('site/our-cars',$data);
    }

    public function carDetails(){
        $site = new Site();
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars();
        $data['carType'] = $site->getCarType();
        return view('site/car-details',$data);
    }

    public function aboutUs(){
        return view('site/about-us');
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
