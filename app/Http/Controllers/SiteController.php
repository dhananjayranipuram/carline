<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Mail\OtpVerification;
use App\Mail\BookingConfirmation;
use App\Mail\ContactUs;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
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
        date_default_timezone_set('Asia/Calcutta');
        $site = new Site();
        $emirates = $site->getEmirates();
        $layoutCarTypes = $site->getCarType();
        // Share 'emirates' with all views
        view()->share('emirates', $emirates);
        view()->share('layoutCarTypes', $layoutCarTypes);
    }

    public function index(){
        $site = new Site();
        $input['format'] = 'normal';
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars($input);
        $data['carType'] = $site->getCarType();
        $data['specs'] = $site->getCarSpecifications($input);
        $data['all_specs'] = $site->getAllSpecifications();
        $temp = [];
        foreach ($data['specs'] as $key => $value) {
            if(!isset($temp[$value->car_id])){
                $temp[$value->car_id] = [];
            }
            array_push($temp[$value->car_id],$value);
        }
        $data['specs'] = $temp;
        return view('site/home',$data);
    }

    public function ourCars(){
        $site = new Site();
        $input['format'] = 'normal';
        $data['brands'] = $site->getBrands();
        $data['cars'] = $site->getCars($input);
        $data['carType'] = $site->getCarType();
        $data['specs'] = $site->getCarSpecifications($input);
        $data['all_specs'] = $site->getAllSpecifications();
        $temp = [];
        foreach ($data['specs'] as $key => $value) {
            if(!isset($temp[$value->car_id])){
                $temp[$value->car_id] = [];
            }
            array_push($temp[$value->car_id],$value);
        }
        $data['specs'] = $temp;
        // echo '<pre>';print_r($data['all_specs']);exit;
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
                'carTransmission' => [''],
                'carSeats' => [''],
                'transId' => [''],
                'seatId' => [''],
                'searchText' => [''],
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
            'babySeat' => ['required'],
            'carId' => ['required'],
        ]);
        if($credentials['returntosame'] == 'on'){
            $credentials['destinationEmirate'] = $credentials['sourceEmirates'];
        }
        $res = $this->calculateRate($credentials);
        
        return json_encode($res);
    }
    
    public function checkCarBooking(Request $request)
    {
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'pickupdate' => ['required'],
            'returndate' => ['required'],
            'pickuptime' => ['required'],
            'returntime' => ['required'],
            'carId' => ['required'],
            'type' => ['nullable'],
        ]);

        $selectedTime = Carbon::parse("$credentials[pickupdate] $credentials[pickuptime]");

        if ($selectedTime->isPast()) {
            $response['status'] = '400';
            $response['message'] = 'Booking not available';
            return response()->json($response);
        }
        
        $res = $site->checkCarBooking($credentials);
        $carCount = $site->getCarQty($credentials);

        if($res){
            $response['status'] = '400';
            $response['message'] = 'Booking not available';
        }else{
            $response['status'] = '200';
            $response['message'] = 'Booking available';
        }
        return response()->json($response);
    }

    public function checkTime(Request $request)
    {
        $site = new Site();
        $timeSlots = [];
        $credentials = $request->validate([
            'pickupdate' => ['nullable'],
            'returndate' => ['nullable'],
            'type' => ['required'],
            'carId' => ['required'],
        ]);
        $credentials['type'] = 'date';
        $res = $site->checkCarBooking($credentials);
        $carCount = $site->getCarQty($credentials);
        if(!empty($res)){
            if($res[0]->cnt<$carCount){
                return response()->json($this->generateTimeslot(null,null));
            }else{

                if($credentials['pickupdate']&&$credentials['returndate']){
                    $credentials['type'] = 'both';
                    $res = $site->getTimeAvailable($credentials);
                    if($res){
                        return response()->json($timeSlots);
                    }else{
                        $timeSlots = $this->generateTimeslot('','');
                        return response()->json($timeSlots);
                    }
                }
                $res = $site->getTimeAvailable($credentials);
                $pickupTime = null;
                $dropoffTime = null;
        
                if ($res) {
                    foreach ($res as $value) {
                        if ($value->pickup_time) {
                            $pickupTime = $value->pickup_time;
                        }
                        if ($value->return_time) {
                            $dropoffTime = $value->return_time;
                        }
                    }
                }
        
                return response()->json($this->generateTimeslot($pickupTime,$dropoffTime));
            }
        }else{
            return response()->json($this->generateTimeslot(null,null));
        }
        
    }

    public function generateTimeslot($pickupTime,$dropoffTime){
        $timeSlots = [];
        $startTime = $dropoffTime ? strtotime($dropoffTime) : strtotime("12:00 AM");
        $endTime = $pickupTime ? strtotime($pickupTime) : strtotime("11:59 PM");

        if ($startTime > $endTime) {
            return response()->json(['error' => 'Invalid time range'], 400);
        }

        $slotDuration = 30; // Slot duration in minutes

        while ($startTime <= $endTime) {
            $timeSlots[] = date("g:i A", $startTime);
            $startTime = strtotime("+$slotDuration minutes", $startTime);
        }
        return $timeSlots;
    }

    public function checkDocumentUploaded(Request $request){
        $site = new Site();
        $input['id'] = Session::get('userId');
        $response = [];
        $res = $site->getDocumentUpload($input);

        if($res->document_uploaded == 1){
            $response['status'] = '200';
            $response['message'] = 'User uploaded document';
            $response['cnt'] = $res->document_uploaded;
        }else{
            $response['status'] = '200';
            $response['message'] = 'User not uploaded document';
            $response['cnt'] = $res->document_uploaded;
        }
        return json_encode($response);
    }

    public function uploadDocuments(Request $request)
    {
        $site = new Site();
        $response = [];

        // Validation
        $credentials = $request->validate([
            'rider_type' => ['required'],
            'pass_front' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'pass_back' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_front' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_back' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'eid_front' => [
                'nullable',
                'max:2048',
                Rule::requiredIf(function () use ($request) {
                    return $request->rider_type === 'resident'; // Only required if rider_type is 'resident'
                }),
            ],
            'eid_back' => [
                'nullable',
                'max:2048',
                Rule::requiredIf(function () use ($request) {
                    return $request->rider_type === 'resident'; // Only required if rider_type is 'resident'
                }),
            ],
        ]);

        // Handle file uploads using the helper function
        $uploadedFiles = $this->handleFileUploads($request, [
            'pass_front', 
            'pass_back', 
            'dl_front', 
            'dl_back', 
            'eid_front', 
            'eid_back'
        ]);

        // Check for errors in uploaded files
        if ($uploadedFiles['errors']) {
            return response()->json(['status' => '400', 'message' => $uploadedFiles['errors']], 400);
        }

        // Add user ID to the uploaded files data
        $uploadedFiles['id'] = $request->session()->get('userId');

        // Save uploaded documents
        $res = $site->saveUploadedDocuments($uploadedFiles);

        // Prepare response
        if ($res) {
            return response()->json(['status' => '200', 'message' => 'Document uploaded successfully.']);
        } else {
            return response()->json(['status' => '500', 'message' => 'Something went wrong.'], 500);
        }
    }

    private function handleFileUploads(Request $request, array $fields)
    {
        $uploadedFiles = [];
        $errors = [];

        foreach ($fields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $uploadedFiles[$field] = 'storage/' . $file->store('uploads/documents', 'public');
            } else {
                // Collect errors for missing required files if needed
                if (in_array($field, ['eid_front', 'eid_back']) && $request->rider_type === 'resident') {
                    $errors[] = "Please select " . ucfirst(str_replace('_', ' ', $field)) . " image.";
                }
            }
        }

        return ['uploadedFiles' => $uploadedFiles, 'errors' => $errors];
    }

    public function calculateRate($credentials) {
        $site = new Site();
        $res = [];
        $deposit = $rate = $emirateCharges = $babySeatCharges = $total = 0;
    
        // Calculate the time difference in days and hours
        $pickupdate = strtotime($credentials['pickupdate'] . ' ' . $credentials['pickuptime']);
        $returndate = strtotime($credentials['returndate'] . ' ' . $credentials['returntime']);
        $datediff = $returndate - $pickupdate;
    
        // Calculate the number of complete days
        $days = floor($datediff / (60 * 60 * 24));
        // Calculate any extra hours after full days
        $extraHours = ($datediff % (60 * 60 * 24)) / (60 * 60);
    
        // Add an additional day if extra hours exceed one-hour buffer
        if ($extraHours > 1) {
            $days++;
        }
    
        // Retrieve car details and calculate rate and deposit
        $credentials['format'] = 'normal';
        $carRes = $site->getCarsRate($credentials);
        
        if (!empty($carRes)) {
            // Apply offer price if available, otherwise use regular rent
            $rate = (float) str_replace(',', '', $carRes[0]->offer_flag == 1 ? $carRes[0]->offer_price : $carRes[0]->rent);
            $deposit = !empty($carRes[0]->deposit) ? (float) str_replace(',', '', $carRes[0]->deposit) : 0;
        }
        
        // Additional charge if pickup and destination emirates differ
        if ($credentials['destinationEmirate'] != $credentials['sourceEmirates']) {
            $resEmirate = $site->getEmiratesForRate($credentials);
            
            $emirateCharges = !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
        }
        
        if($credentials['babySeat']=='on'){
            $babySeatCharges = 30;
        }

        // Calculate the total amount and VAT
        $total = $days * $rate + $deposit + $emirateCharges + $babySeatCharges;
        $vat = 0.05 * $total;
    
        // Prepare result data
        $res['days'] = $days;
        $res['vat'] = $vat;
        $res['emirate'] = $emirateCharges;
        $res['rate'] = $days * $rate;
        $res['deposit'] = $deposit;
        $res['babySeat'] = $babySeatCharges;
        $res['total'] = $total + $vat;
    
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
            'babySeat' => ['required'],
            'carId' => ['required'],
            'userId' => ['required'],
        ]);
        $rateData = $this->calculateRate($credentials);
        $credentials['rate'] = $rateData['total'];
        // print_r($credentials);exit;
        $res = $site->saveBookingData($credentials);
        if($res){

            $data['id'] = $credentials['userId'];
            $userData = $site->getMyDetails($data);
            if($userData){
                $credentials['user_data'] = $userData;
                Mail::to($userData[0]->email)->send(new BookingConfirmation((object)$credentials));
            }
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
        $data['bookingHistory'] = $site->getBookingHistory($input);
        // echo '<pre>';print_r($data);exit;
        return view('site/my-account',$data);
    }
    
    public function myAccountDetails(){
        $site = new Site();
        $data = [];
        $input['id'] = Session::get('userId');
        $data = $site->getMyDetails($input);
        // echo '<pre>';print_r($data);exit;
        return response()->json($data);
    }

    public function updateUser(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'phone' => ['required'],
            'flat' => ['required'],
            'building' => ['required'],
            'landmark' => ['required'],
            'city' => ['required'],
            'emirates' => ['required'],
        ]);

        $credentials['id'] = Session::get('userId');

        $res = $site->updateUserData($credentials);
        if($res){
            $response['status'] = '200';
            $response['message'] = 'User data updates succesfully.';
            $response['userId'] = $res;
        }else{
            $response['status'] = '401';
            $response['message'] = 'Updation failed.';
        }
        return json_encode($response);
    }
}
