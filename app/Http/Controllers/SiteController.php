<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Mail\OtpVerification;
use Session;
use Redirect;
use Storage;
use File;
use \Illuminate\Http\UploadedFile;
use URL;
use Mail;

class SiteController extends Controller
{
    public function index(){
        $site = new Site();
        $input['format'] = 'normal';
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars($input);
        $data['carType'] = $site->getCarType();
        return view('site/home',$data);
    }

    public function ourCars(){
        $site = new Site();
        $input['format'] = 'normal';
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars($input);
        $data['carType'] = $site->getCarType();
        $data['specs'] = $site->getCarSpecifications($input);
        $temp = [];
        foreach ($data['specs'] as $key => $value) {
            if(!isset($temp[$value->car_id])){
                $temp[$value->car_id] = [];
            }
            array_push($temp[$value->car_id],$value);
        }
        $data['specs'] = $temp;
        // echo '<pre>';print_r($temp);exit;
        return view('site/our-cars',$data);
    }

    public function carDetails(){
        $queries = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $input['id'] = base64_decode($queries['id']);
        $input['format'] = 'normal';
        $site = new Site();
        $data['carDet'] = $site->getCars($input);
        $data['features'] = $site->getCarFeatures($input);
        $data['specs'] = $site->getCarSpecifications($input);
        $data['emirates'] = $site->getEmirates();
        // echo '<pre>';print_r($data);exit;
        // $data['brands'] = $site->getBrands();
        // $data['cars'] = $site->getCars();
        // $data['carType'] = $site->getCarType();
        $data['generalInfo'] = $site->getCarGeneralInfo();
        $data['policy'] = $site->getPolicyAgreement();
        return view('site/car-details',$data);
    }

    public function filterCars(Request $request){
        $site = new Site();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'type' => [''],
                'brand' => [''],
            ]);
            
            // $filterData['type'] = implode(',', $filterData['type']);
            // $filterData['brand'] = implode(',', $filterData['brand']);
            $filterData['format'] = 'filter';
            $data['carDet'] = $site->getCars($filterData);
            $data['specs'] = $site->getCarSpecifications($filterData);
            $temp = [];
            foreach ($data['specs'] as $key => $value) {
                if(!isset($temp[$value->car_id])){
                    $temp[$value->car_id] = [];
                }
                array_push($temp[$value->car_id],$value);
            }
            $data['specs'] = $temp;
            return json_encode($data);
        }
    }

    public function aboutUs(){
        return view('site/about-us');
    }

    public function offers(){
        $site = new Site();
        $input['format'] = 'offer';
        $data['cars'] = $site->getCars($input);
        $data['specs'] = $site->getCarSpecifications($input);
        $temp = [];
        foreach ($data['specs'] as $key => $value) {
            if(!isset($temp[$value->car_id])){
                $temp[$value->car_id] = [];
            }
            array_push($temp[$value->car_id],$value);
        }
        $data['specs'] = $temp;
        return view('site/offers',$data);
    }

    public function news(){
        return view('site/news');
    }

    public function contactUs(){
        return view('site/contact-us');
    }

    public function sendOtp(Request $request){
        $site = new Site();
        $res = [];
        $credentials = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
        ]);
        // $ex = $site->getUserExist($credentials);
        // print_r($ex);exit;
        // if($ex[0]->cnt == 0){
            $credentials['otp'] = mt_rand(100000,999999);
            $res = $site->saveOtp($credentials);
            if($res){
                Mail::to($credentials['email'])->send(new OtpVerification((object)$credentials));
            }
            $res = [
                'status' => '200',
                'exist' => '0',
                'message' => '',
            ];
        // }else{
        //     $res = [
        //         'status' => '200',
        //         'exist' => '1',
        //         'message' => 'User already exist.',
        //     ];
        // }
        return json_encode($res);
    }

    public function verifyOtp(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'otp' => ['required'],
        ]);
        $res = $site->verifyOtp($credentials);
        if($res){
            $response['status'] = '200';
            $response['message'] = 'OTP verified succesfully.';
        }else{
            $response['status'] = '401';
            $response['message'] = 'Invalid OTP.';
        }
        return json_encode($response);
    }

    public function registerUser(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'flat' => ['required'],
            'building' => ['required'],
            'landmark' => ['required'],
            'city' => ['required'],
            'emirates' => ['required'],
            'password' => ['required'],
        ]);

        $res = $site->registerUserData($credentials);
        if($res){
            Session::put('userId', $res);
            $response['status'] = '200';
            $response['message'] = 'User registered succesfully.';
            $response['userId'] = $res;
        }else{
            $response['status'] = '401';
            $response['message'] = 'Registration failed.';
        }
        return json_encode($response);
    }
}
