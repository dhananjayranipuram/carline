<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Mail\OtpVerification;
use App\Mail\ContactUs;
use Session;
use Redirect;
use Storage;
use File;
use \Illuminate\Http\UploadedFile;
use URL;
use Mail;

class SiteController extends Controller
{
    public function __construct()
    {
        $site = new Site();
        $emirates = $site->getEmirates();

        // Share 'emirates' with all views
        view()->share('emirates', $emirates);
    }

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

    public function checkRate(Request $request){
        $site = new Site();
        $credentials = $request->validate([
            'destinationEmirate' => [''],
            'sourceEmirates' => ['required'],
            'pickupdate' => ['required'],
            'returndate' => ['required'],
            'pickuptime' => ['required'],
            'returntime' => ['required'],
            'returntosame' => ['required'],
            'id' => ['required'],
        ]);
        if(isset($credentials['returntosame'])){
            $credentials['destinationEmirate'] = $credentials['sourceEmirates'];
        }
        $res = $this->calculateRate($credentials);
        
        return json_encode($res);
    }

    public function calculateRate($credentials){
        $site = new Site();
        $res = [];
        $rate = 0;
        $pickupdate = strtotime($credentials['pickupdate'].' '.$credentials['pickuptime']);
        $returndate = strtotime($credentials['returndate'].' '.$credentials['returntime']);
        $datediff = $returndate - $pickupdate;

        $days =  round($datediff / (60 * 60 * 24));
        $tempDays =  $datediff / (60 * 60 * 24);
        $extraHours =  ($tempDays - floor($tempDays)) * (24)-1;
        $days = ceil($days + $extraHours);

        $credentials['format'] = 'normal';
        $carRes = $site->getCars($credentials);
        // print_r($carRes);exit;
        if(!empty($carRes)){
            if($carRes[0]->offer_flag==1){
                $rate += (float) str_replace(',', '', $carRes[0]->offer_price);
            }else{
                $rate += (float)str_replace(',', '', $carRes[0]->rent);
            }
        }
        $rate = $days*$rate;
        if($credentials['destinationEmirate'] != $credentials['sourceEmirates']){
            $resEmirate = $site->getEmirates($credentials);
            if(!empty($resEmirate)){
                $rate += (float)str_replace(',', '', $resEmirate[0]->rate);
            }
        }
        $vat = 0.18*$rate;
        $res['days'] = $days;
        $res['vat'] = $vat;
        $res['rate'] = $rate;
        $res['total'] = $rate+$vat;
        return $res;
    }

    public function loginUser(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $res = $site->login($credentials);
        if($res){
            Session::put('userId', $res[0]->id);
            Session::put('userdata', $res);
            $response['status'] = '200';
            $response['message'] = 'User login succesfully.';
            $response['userId'] = $res[0]->id;
        }else{
            $response['status'] = '401';
            $response['message'] = 'Login failed.';
        }
        return json_encode($response);
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/home');
    }

    public function sendContactUs(Request $request){
        $admin = new Site();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required'],
                'phone' => ['required'],
                'message' => ['required']
            ]);
            
            Mail::to('dhananjayranipuram@gmail.com')->send(new ContactUs((object)$filterData));

            return Redirect::to('/contact');
        }
    }

    public function saveCarBooking(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'destinationData' => ['required'],
            'sourceData' => ['required'],
            'sourceEmirates' => ['required'],
            'destinationEmirate' => ['required'],
            'pickupdate' => ['required'],
            'returndate' => ['required'],
            'pickuptime' => ['required'],
            'returntime' => ['required'],
            'carId' => ['required'],
            'userId' => ['required'],
        ]);
        $rateData = $this->calculateRate($credentials);
        $credentials['rate'] = $rateData['total'];
        // print_r($credentials);exit;
        $res = $site->saveBookingData($credentials);
        if($res){
            $response['status'] = '200';
            $response['message'] = 'Booked succesfully.';
            $response['bookingId'] = $res;
        }else{
            $response['status'] = '401';
            $response['message'] = 'Booking failed.';
        }
        return json_encode($response);
    }

    public function myAccount(){
        $site = new Site();
        $data = [];
        $input['id'] = Session::get('userId');
        $data['userAccount'] = $site->getMyDetails($input);
        return view('site/my-account',$data);
    }
}
