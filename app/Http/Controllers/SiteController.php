<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Admin;
use App\Mail\OtpVerification;
use App\Mail\BookingConfirmation;
use App\Mail\BookingCancellation;
use App\Mail\ContactUs;
use App\Mail\ResetPaswordLink;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
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
        date_default_timezone_set('Asia/Dubai');
        // date_default_timezone_set('Asia/Kolkata');
        $site = new Site();
        $emirates = $site->getEmirates();
        $layoutCarTypes = $site->getCarType();
        $country = $site->getCountry();
    
        view()->share('emirates', $emirates);
        view()->share('country', $country);
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
                'sortBy' => [''],
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
    
    public function filterOfferCars(Request $request){
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
                'sortBy' => [''],
            ]);
            
            // $filterData['type'] = implode(',', $filterData['type']);
            // $filterData['brand'] = implode(',', $filterData['brand']);
            $filterData['format'] = 'filter';
            $data['carDet'] = $site->getOfferCars($filterData);
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
    
    public function policiesAgreements(){
        $site = new Site();
        $data['policy'] = $site->getPolicyAgreement();
        return response()->json($data);
    }

    public function offers(){
        $site = new Site();
        $input['format'] = 'offer';
        $data['cars'] = $site->getCars($input);
        $data['specs'] = $site->getCarSpecifications($input);
        $data['carType'] = $site->getCarType();
        $data['all_specs'] = $site->getAllSpecifications();
        $data['brands'] = $site->getBrands();
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
            'country' => ['required'],
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
            'destinationData' => [''],
            'sourceData' => [''],
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
            $credentials['destinationData'] = $credentials['sourceData'];
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
            'pickuptime' => ['nullable'],
            'returntime' => ['nullable'],
            'type' => ['required'],
            'carId' => ['required'],
        ]);
        $type = $credentials['type'];
        $credentials['type'] = 'date';
        // $res = $site->checkCarBooking($credentials);
        // $carCount = $site->getCarQty($credentials);
        // if(!empty($res)){
        //     echo $res[0]->cnt;exit;
        //     if($res[0]->cnt<$carCount){
                
        //         $timeSlots = $this->generateTimeslot('','');

        //         return response()->json($timeSlots);
        //     }else{
                if($type == 'pickup'){
                    if($credentials['pickupdate'] ){
                        if($credentials['pickupdate'] == date('Y-m-d')){
                            $time = strtotime(date('h:i a', time()));
                            $round = 30*60;
                            $rounded = round($time / $round) * $round;
                            $date = date("H:i", $rounded);
                            
                            $timeSlots = $this->generateStartTimeslot($date,'');
                            
                        }else{
                            $timeSlots = $this->generateTimeslot('','');
                        }
                        return response()->json($timeSlots);
                    }
                }else if($type == 'dropoff'){
                    if($credentials['returndate'] ){
                        if($credentials['returndate'] == date('Y-m-d')){
                            if($credentials['pickuptime']){
                                $time = strtotime($credentials['pickuptime']);
                                $time = strtotime('+2 hours', $time);
                                $round = 30*60;
                                $rounded = round($time / $round) * $round;
                                $date = date("H:i", $rounded);
                                
                                $timeSlots = $this->generateTimeslot('',$date);
                            }else{
                                $time = strtotime(date('h:i a', time()));
                                $time = strtotime('+2 hours', $time);
                                $round = 30*60;
                                $rounded = round($time / $round) * $round;
                                $date = date("H:i", $rounded);
                                
                                $timeSlots = $this->generateTimeslot('',$date);
                            }
                            
                        }else{
                            $timeSlots = $this->generateTimeslot('','');
                        }
                        return response()->json($timeSlots);
                    }
                }
                
            // }
        // }else{

        //     echo 456;exit;
        //     return response()->json($this->generateTimeslot(null,null));
        // }
        
    }

    public function generateTimeslot($pickupTime,$dropoffTime){
        
        $timeSlots = [];
        $startTime = $dropoffTime ? strtotime($dropoffTime) : strtotime("08:00 AM");
        $endTime = $pickupTime ? strtotime($pickupTime) : strtotime("08:00 PM");

        if ($startTime > $endTime) {
            return 'Invalid time range';
        }

        $slotDuration = 30; // Slot duration in minutes

        while ($startTime <= $endTime) {
            $timeSlots[] = date("g:i A", $startTime);
            $startTime = strtotime("+$slotDuration minutes", $startTime);
        }
        return $timeSlots;
    }

    public function generateStartTimeslot($pickupTime,$dropoffTime){
        // echo $pickupTime;
        $timeSlots = [];
        $startTime = $pickupTime ? strtotime($pickupTime) : strtotime("08:00 AM");
        
        $endTime = $dropoffTime ? strtotime($dropoffTime) : strtotime("08:00 PM");
        $startTime += 120*60;

        if ($startTime > $endTime) {
            return 'Invalid time range';
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
        $uploadCnt = 0;
        if($res->user_type == 'R'){
            $uploadCnt = $res->passf_flag * $res->dlf_flag * $res->dlb_flag * $res->eidf_flag * $res->eidb_flag;
        }else{
            $uploadCnt = $res->passf_flag * $res->passb_flag * $res->dlf_flag * $res->dlb_flag * $res->cdlf_flag * $res->cdlb_flag;
        }
        if($uploadCnt == 1){
            $response['status'] = '200';
            $response['message'] = 'User uploaded document';
            $response['cnt'] = $uploadCnt;
            $response['data'] = $res;
        }else{
            $response['status'] = '200';
            $response['message'] = 'User not uploaded document';
            $response['cnt'] = $uploadCnt;
            $response['data'] = $res;
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
            'pass_back' => [
                'nullable', 
                'file', 
                'mimes:jpg,png,pdf', 
                'max:2048',
                Rule::requiredIf(function () use ($request) {
                    return $request->rider_type === 'tourist'; // Only required if rider_type is 'tourist'
                }),
            ], //Pass_back will be known as Visa
            'dl_front' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_back' => ['required', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            // 'eid_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            // 'eid_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
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
            'cdl_front' => [
                'nullable',
                'max:2048',
                Rule::requiredIf(function () use ($request) {
                    return $request->rider_type === 'tourist';
                }),
            ],
            'cdl_back' => [
                'nullable',
                'max:2048',
                Rule::requiredIf(function () use ($request) {
                    return $request->rider_type === 'tourist';
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
            'eid_back',
            'cdl_front',
            'cdl_back'
        ]);

        // Check for errors in uploaded files
        if ($uploadedFiles['errors']) {
            return response()->json(['status' => '400', 'message' => $uploadedFiles['errors']], 400);
        }

        // Add user ID to the uploaded files data
        $uploadedFiles['id'] = $request->session()->get('userId');

        // Save uploaded documents
        $res = $site->saveUploadedDocuments($uploadedFiles,$credentials['rider_type']);

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
        $admin = new Admin();
        $res = [];
        $rentDays = $monthlyRate = $weeklyRate = $deposit = $rate = $emirateCharges = $babySeatCharges = $total = 0;
        $data = $admin->getAdditionalSettingsData();
        
        $daysInWeek = config('constants.DAYS_IN_WEEK');
        $daysInMonth = config('constants.DAYS_IN_MONTH');
        $vatRate = $data[0]->vat_rate/100;
        $bsCharges = $data[0]->baby_seat_charge;
        $carlineName = config('constants.CAR_LINE_NAME');
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
            $weeklyRate = (float) str_replace(',', '', $carRes[0]->offer_flag_weekly == 1 ? $carRes[0]->offer_price_weekly : $carRes[0]->per_week);
            $monthlyRate = (float) str_replace(',', '', $carRes[0]->offer_flag_monthly == 1 ? $carRes[0]->offer_price_monthly : $carRes[0]->per_month);
            $deposit = !empty($carRes[0]->deposit) ? (float) str_replace(',', '', $carRes[0]->deposit) : 0;
        }

        $months = floor($days / $daysInMonth);
        $weeks = floor($days / $daysInWeek);
        if($months>0){
            $remainingDays = $days % $daysInMonth;
            $remainingWeeks = floor($remainingDays / $daysInWeek);
            if($remainingWeeks>0){
                $remainingDays = $remainingDays % $daysInWeek;
                $rentDays = $months*$monthlyRate + $remainingWeeks*$weeklyRate + $remainingDays*$rate;
            }else{
                $rentDays = $months*$monthlyRate + $remainingDays*$rate;
            }
        }else if($weeks>0){
            $remainingDays = $days % $daysInWeek;
            $rentDays = $weeks*$weeklyRate + $remainingDays*$rate;
        }else{
            $rentDays = $days*$rate;
        }
        
        // Additional charge if pickup and destination emirates differ
        // if($credentials['destinationData'][0]['placeName'] == '')
        if($credentials['sourceData']['placeName'] == $carlineName && $credentials['destinationData']['placeName'] == $carlineName){
            $resEmirate = $site->getCarlineEmiratesForRate($credentials);
            $emirateCharges = !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
        }else if($credentials['sourceData']['placeName'] == $carlineName || $credentials['destinationData']['placeName'] == $carlineName){
            $resEmirate = $site->getEmiratesForRate($credentials);
            
            $emirateCharges = !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
            $emirateCharges = $emirateCharges / 2;
        }else {
            $resEmirate = $site->getEmiratesForRate($credentials);
            
            $emirateCharges = !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
        }
        
        if($months>0){
            $emirateCharges = 0;
        }

        if($credentials['babySeat']=='on'){
            $babySeatCharges = $bsCharges;
        }

        // Calculate the total amount and VAT
        $total = $rentDays + $deposit + $emirateCharges + $babySeatCharges;
        $vat = $vatRate * $rentDays;
    
        // Prepare result data
        $res['days'] = $days;
        $res['vat'] = number_format($vat, 2, '.', '');
        $res['emirate'] = number_format($emirateCharges, 2, '.', '');
        $res['rate'] = number_format($rentDays, 2, '.', '');
        $res['deposit'] = number_format($deposit, 2, '.', '');
        $res['babySeat'] = number_format($babySeatCharges, 2, '.', '');
        $res['total'] = number_format($total + $vat, 2, '.', '');
    
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
            
            Mail::to('info@carline.com')->send(new ContactUs((object)$filterData));
            session()->flash('success', 'Your message has been sent! Thank you.');
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
                Mail::to($userData[0]->email)->send(new BookingConfirmation((object)$credentials,'user'));
                Mail::to(config('constants.ADMIN_EMAIL'))->send(new BookingConfirmation((object)$credentials,'admin'));
            }
            $response['status'] = '200';
            $response['message'] = 'Booked succesfully.';
            $response['bookingId'] = $res;
            $response['bookingData'] = $credentials;
        }else{
            $response['status'] = '401';
            $response['message'] = 'Booking failed.';
        }
        return json_encode($response);
    }

    public function cancelBooking(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'id' => ['required']
        ]);
        $res = $site->upateBookingStatus($credentials);
        if($res){
            $bookingDetails = $site->getBookingDetails($credentials);
            if($bookingDetails){
                Mail::to($bookingDetails[0]->email)->send(new BookingCancellation($bookingDetails[0],'user'));
                Mail::to(config('constants.ADMIN_EMAIL'))->send(new BookingCancellation($bookingDetails[0],'admin'));
            }
            $response['status'] = '200';
            $response['message'] = 'Booking Caanceled.';
        }else{
            $response['status'] = '401';
            $response['message'] = 'Failed.';
        }
        return json_encode($response);
    }

    public function myAccount(){
        $site = new Site();
        $data = [];
        $input['id'] = Session::get('userId');
        $data['userAccount'] = $site->getMyDetails($input);
        $data['bookingHistory'] = $site->getBookingHistory($input);
        if(empty($data['userAccount'])){
            Session::flush();
            return Redirect::to('/home');
        }
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
    
    public function myDocumentDetails(){
        $site = new Site();
        $data = [];
        $input['id'] = Session::get('userId');
        $data['userAccount'] = $site->getMyDetails($input);
        $data['userDocument'] = $site->getMyDocumentDetails($input);
        // echo '<pre>';print_r($data);exit;
        if(empty($data['userAccount'])){
            Session::flush();
            return Redirect::to('/home');
        }
        return view('site/my-document',$data);
    }

    public function editUploadDocuments(Request $request)
    {
        $site = new Site();
        $response = [];

        // Validation
        $credentials = $request->validate([
            'edit_pass_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_pass_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_dl_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_dl_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_eid_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_eid_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_cdl_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'edit_cdl_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
        ]);

        // Handle file uploads using the helper function
        $uploadedFiles = $this->handleFileUploads($request, [
            'edit_pass_front', 
            'edit_pass_back', 
            'edit_dl_front', 
            'edit_dl_back', 
            'edit_eid_front', 
            'edit_eid_back',
            'edit_cdl_front',
            'edit_cdl_back'
        ]);
        // print_r($uploadedFiles);exit;

        $credentials['id'] = Session::get('userId');
        $currentFiles = $site->getMyDocumentDetails($credentials);
        // print_r($currentFiles);exit;
        
        // Check for errors in uploaded files
        if ($uploadedFiles['errors']) {
            return response()->json(['status' => '400', 'message' => $uploadedFiles['errors']], 400);
        }
        
        // Add user ID to the uploaded files data
        $uploadedFiles['id'] = $request->session()->get('userId');

        // Save uploaded documents
        $res = $site->updateUploadedDocuments($uploadedFiles);

        // Prepare response
        if ($res) {
            foreach ($uploadedFiles['uploadedFiles'] as $key => $field) {
                $currentFilePath = $currentFiles[0]->{str_replace('edit_', '', $key)} ?? null;
                if ($currentFilePath && File::exists($currentFilePath)) {
                    File::delete($currentFilePath);
                }
            }
            return response()->json(['status' => '200', 'message' => 'Document uploaded successfully.']);
        } else {
            return response()->json(['status' => '500', 'message' => 'Something went wrong.'], 500);
        }
    }

    public function missingUploadDocuments(Request $request)
    {
        $site = new Site();
        $response = [];

        // Validation
        $credentials = $request->validate([
            'pass_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'pass_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'eid_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'eid_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'cdl_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'cdl_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
        ]);

        // Handle file uploads using the helper function
        $uploadedFiles = $this->handleFileUploads($request, [
            'pass_front', 
            'pass_back', 
            'dl_front', 
            'dl_back', 
            'eid_front', 
            'eid_back',
            'cdl_front',
            'cdl_back'
        ]);
        // print_r($uploadedFiles);exit;

        $credentials['id'] = Session::get('userId');
        $currentFiles = $site->getMyDocumentDetails($credentials);
        // print_r($currentFiles);exit;
        
        // Check for errors in uploaded files
        if ($uploadedFiles['errors']) {
            return response()->json(['status' => '400', 'message' => $uploadedFiles['errors']], 400);
        }
        
        // Add user ID to the uploaded files data
        $uploadedFiles['id'] = $request->session()->get('userId');

        // print_r($uploadedFiles);exit;
        // Save uploaded documents
        $res = $site->updateMissingUploadedDocuments($uploadedFiles);

        // Prepare response
        if ($res) {
            foreach ($uploadedFiles['uploadedFiles'] as $key => $field) {
                $currentFilePath = $currentFiles[0]->{str_replace('edit_', '', $key)} ?? null;
                if ($currentFilePath && File::exists($currentFilePath)) {
                    File::delete($currentFilePath);
                }
            }
            return response()->json(['status' => '200', 'message' => 'Document uploaded successfully.']);
        } else {
            return response()->json(['status' => '500', 'message' => 'Something went wrong.'], 500);
        }
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
            'country' => ['required'],
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

    public function getWhatsappMsg(Request $request){
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
        ]);
        $rateData = $this->calculateRate($credentials);
        $credentials['id'] = $credentials['carId'];
        $credentials['format'] = 'default';
        $carData = $site->getCars($credentials);
        $message = $this->generateWhatsappMsg($credentials,$carData,$rateData);
        
        if($message){
            $response['status'] = '200';
            $response['message'] = $message;

        }else{
            $response['status'] = '401';
            $response['message'] = 'Something went wrong.';
        }
        return json_encode($response);
    }
    
    private function generateWhatsappMsg($credentials,$carData,$rateData){
        $destinationData = $credentials['destinationData'];
        $sourceData = $credentials['sourceData'];
        $pickupdate = $credentials['pickupdate'];
        $returndate = $credentials['returndate'];
        $pickuptime = $credentials['pickuptime'];
        $returntime = $credentials['returntime'];
        $babySeat = $credentials['babySeat'] === 'on' ? 'Included' : 'Not included';
        $carData = $carData[0];
        
        return "*Pickup Details:*\n" .
               "- Place Name: " . ($sourceData['placeName'] ?? '') . "\n" .
               "- Emirate: " . ($sourceData['Emirates'] ?? '') . "\n" .
               "- Map: http://maps.google.co.in/maps?q=".urlencode($sourceData['placeName'])."&ll=$sourceData[Latitude],$sourceData[Longitude]&region=ae\n\n" .
               "*Dropoff Details:*\n" .
               "- Place Name: " . ($destinationData['placeName'] ?? '') . "\n" .
               "- Emirate: " . ($destinationData['Emirates'] ?? '') . "\n" .
               "- Map: https://maps.google.com/?q=".urlencode($destinationData['placeName'])."&ll=$destinationData[Latitude],$destinationData[Longitude]&region=ae\n\n" .
               "*Booking Details:*\n" .
               "- Pickup Date: ".date("d/m/Y", strtotime($pickupdate))."\n" .
               "- Pickup Time: $pickuptime\n" .
               "- Dropoff Date: ".date("d/m/Y", strtotime($returndate))."\n" .
               "- Dropoff Time: $returntime\n" .
               "- Baby Seat: $babySeat\n\n" .
               "*Car Details:*\n" .
               "- Car Name: $carData->brand_name $carData->name $carData->model\n" .
               "- Car Type: $carData->car_type\n\n".
               "*Rent Details:*\n" .
               "- Rent: $rateData[rate]\n" .
               "- Deposit: $rateData[deposit]\n".
               "- Pick & Drop Charges: $rateData[emirate]\n".
               "- VAT: $rateData[vat]\n".
               "- Baby seat charges: $rateData[babySeat]\n".
               "- Total: $rateData[total]\n" ;

    }

    public function termsConditions(){
        $site = new Site();
        $data = [];
        $data['policy'] = $site->getPolicyAgreement();
        return view('site/terms-conditions',$data);
    }
    
    public function privacyPolicy(){
        $site = new Site();
        $data = [];
        return view('site/privacy-policy',$data);
    }
    
    public function refundPolicy(){
        $site = new Site();
        $data = [];
        return view('site/refund-policy',$data);
    }
    
    public function cancelationPolicy(){
        $site = new Site();
        $data = [];
        return view('site/cancelation-policy',$data);
    }

    public function resetPassword($token)
    {
        Session::put('reset-token', $token);
        return view('site/reset-password');
    }
    
    public function resetPasswordUpdate(Request $request)
    {
        $site = new Site();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'password' => ['required', 'min:8'],
                'confirmPassword' => ['required', 'same:password']
            ]);
            $filterData['token'] = Session::get('reset-token');
            $res = $site->updateUserPassword($filterData);
            // echo $res;exit;
            if ($res === true) {
                return back()->with('success', 'Password reset successfully. You can now log in.<a style="color: blue;" class="login-popup">Click here</a>');
            } elseif ($res == 'token_expired') {
                return back()->with('error', 'The reset password link is expired or invalid. Please request a new password reset.<a style="color: blue;" class="reset-popup">Click here</a>');
            } else {
                return back()->with('error', 'Failed to reset password. Please try again.');
            }
            
        }
        return view('site/reset-password');
    }



    public function sendResetLink(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'email' => ['required']
        ]);
        $credentials['phone'] = '';
        $res = $site->getUserExist($credentials);
        if($res[0]->cnt > 0){
            $credentials['token'] = Str::random(64);
            $res = $site->saveToken($credentials);
            $credentials['url'] = url('/reset-password/' . $credentials['token']);
            Mail::to($credentials['email'])->send(new ResetPaswordLink((object)$credentials));
            $response['status'] = '200';
            $response['message'] = 'A password reset link has been sent to your email.';
        }else{
            $response['status'] = '401';
            $response['message'] = 'Email address not registered.';
        }
        return json_encode($response);
    }
}
