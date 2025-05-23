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
use Exception;
use Illuminate\Support\Facades\Crypt;

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
    
    public function destinations(){
        $queries = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $queries['place'];
        switch ($queries['place']) {
            case 'dubai':
                return view('destinations/dubai');
                break;
            case 'sharjah':
                return view('destinations/sharjah');
                break;
            case 'abu-dhabi':
                return view('destinations/abu-dhabi');
                break;
            case 'ajman':
                return view('destinations/ajman');
                break;
            case 'ummalquwain':
                return view('destinations/ummalquwain');
                break;
            case 'rasalkhaimah':
                return view('destinations/rasalkhaimah');
                break;
            case 'fujairah':
                return view('destinations/fujairah');
                break;
            case 'alain':
                return view('destinations/alain');
                break;
            
            default:
                return view('destinations/dubai');
                break;
        }
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
            'destinationData' => ['required'],
            'sourceData' => ['required'],
            'sourceEmirates' => ['required'],
            'destinationEmirate' => ['required'],
            'babySeat' => ['required'],
            'userId' => ['required'],
        ]);

        $selectedTime = Carbon::parse("$credentials[pickupdate] $credentials[pickuptime]");

        if ($selectedTime->isPast()) {
            $response['status'] = '400';
            $response['message'] = 'Booking not available';
            return response()->json($response);
        }
        
        $res = $site->checkCarBooking($credentials);
        $carCount = $site->getCarQty($credentials);
        // print_r($res[0]->cnt);exit;
        // print_r($carCount);exit;
        if($res){
            if($res[0]->cnt >= $carCount){
                $response['status'] = '400';
                $response['message'] = 'Booking not available';
            }else{
                Session::put('bookingDetails', $credentials);
                $response['status'] = '200';
                $response['message'] = 'Booking available';
            }
        }else{
            Session::put('bookingDetails', $credentials);
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
        $uploadedFiles = $this->handleFileUploadsAndEncrypt($request, [
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

    private function handleFileUploadsAndEncrypt(Request $request, array $fileFields)
    {
        $uploadedFiles = [];
        $errors = [];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileContents = file_get_contents($file->getRealPath());

                try {
                    $encryptedContents = Crypt::encrypt($fileContents);
                    $fileName = 'private_documents/' . uniqid() . '_' . $file->getClientOriginalName() . '.enc';
                    
                    // Store encrypted file securely
                    Storage::disk('local')->put($fileName, $encryptedContents);
                    
                    // Save the file path instead of raw file data
                    $uploadedFiles[$field] = $fileName;
                } catch (\Exception $e) {
                    $uploadedFiles['errors'][] = "Error encrypting file: " . $file->getClientOriginalName();
                }
            }
        }

        return ['uploadedFiles' => $uploadedFiles, 'errors' => $errors];
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

        try{
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
                $input = [];
                $input['sourceEmirate'] = $credentials['sourceEmirates'];
                $resEmirate = $site->getEmiratesForRateSingle($input);
                $emirateCharges += !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;

                $input = [];
                $input['destinationEmirate'] = $credentials['destinationEmirate'];
                $resEmirate = $site->getEmiratesForRateSingle($input);
                $emirateCharges += !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
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
        } catch (Exception $e) {
            return $e->getMessage();
        }
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
            
            Mail::to('info@carlinerental.com')->send(new ContactUs((object)$filterData));
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
            $input['id'] = $credentials['carId'];
            $carData = $site->getCars($input);
            if($userData){
                $credentials['user_data'] = $userData;
                $credentials['car_data'] = $carData;
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

        if (!empty($data['userDocument'])) {
            foreach ($data['userDocument'] as $doc) {
                $decryptedFiles = [];
    
                foreach ($doc as $key => $filePath) {
                    if (!in_array($key, ['id', 'user_type']) && !empty($filePath)) {
    
                        if (strpos($filePath, '.enc') !== false) {
                            if (Storage::exists($filePath)) {
                                try {
                                    $encryptedContents = Storage::get($filePath);

                                    $decryptedContents = Crypt::decrypt($encryptedContents);
    
                                    $fileExtension = pathinfo(str_replace('.enc', '', $filePath), PATHINFO_EXTENSION);
    
                                    $mimeType = $this->getMimeTypeFromExtension($fileExtension);
    
                                    $base64Content = base64_encode($decryptedContents);
    
                                    $dataUrl = "data:{$mimeType};base64,{$base64Content}";
    
                                    $decryptedFiles[$key] = $dataUrl;
                                } catch (\Exception $e) {
                                    $decryptedFiles[$key] = 'Error decrypting file';
                                }
                            } else {
                                $decryptedFiles[$key] = 'File not found';
                            }
                        } else {
                            $decryptedFiles[$key] = asset('storage/' . $filePath);
                        }
                    }
                }
                $doc->decrypted_files = $decryptedFiles;
            }
        }
        return view('site/my-document',$data);
    }

    private function getMimeTypeFromExtension($extension)
    {
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'txt' => 'text/plain',
            'html' => 'text/html',
        ];

        return $mimeTypes[$extension] ?? 'application/octet-stream';
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
        $uploadedFiles = $this->handleFileUploadsAndEncrypt($request, [
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
        $uploadedFiles = $this->handleFileUploadsAndEncrypt($request, [
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
            'destinationData' => ['nullable'],
            'sourceData' => ['nullable'],
            'sourceEmirates' => ['nullable'],
            'destinationEmirate' => ['nullable'],
            'pickupdate' => ['nullable'],
            'returndate' => ['nullable'],
            'pickuptime' => ['nullable'],
            'returntime' => ['nullable'],
            'babySeat' => ['nullable'],
            'carId' => ['nullable'],
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
    
    private function generateWhatsappMsg($credentials, $carData, $rateData)
    {
        // Extract and apply null-safe checks for input data
        $destinationData = $credentials['destinationData'] ?? [];
        $sourceData = $credentials['sourceData'] ?? [];
        $pickupdate = $credentials['pickupdate'] ?? '';
        $returndate = $credentials['returndate'] ?? '';
        $pickuptime = $credentials['pickuptime'] ?? '';
        $returntime = $credentials['returntime'] ?? '';
        $babySeat = ($credentials['babySeat'] ?? '') === 'on' ? 'Included' : 'Not included';
        $carData = $carData[0] ?? (object) ['brand_name' => '', 'name' => '', 'model' => '', 'car_type' => ''];

        // Formatting source and destination data with null-safe checks
        $sourcePlaceName = $sourceData['placeName'] ?? null;
        $sourceEmirate = $sourceData['Emirates'] ?? null;
        $sourceLatitude = $sourceData['Latitude'] ?? null;
        $sourceLongitude = $sourceData['Longitude'] ?? null;

        $destinationPlaceName = $destinationData['placeName'] ?? null;
        $destinationEmirate = $destinationData['Emirates'] ?? null;
        $destinationLatitude = $destinationData['Latitude'] ?? null;
        $destinationLongitude = $destinationData['Longitude'] ?? null;

        // Formatting dates with null-safe checks
        $formattedPickupDate = !empty($pickupdate) ? date("d/m/Y", strtotime($pickupdate)) : null;
        $formattedReturnDate = !empty($returndate) ? date("d/m/Y", strtotime($returndate)) : null;

        // Formatting rate details with null-safe checks
        $rate = $rateData['rate'] ?? '0.00';
        $deposit = $rateData['deposit'] ?? '0.00';
        $emirateCharges = $rateData['emirate'] ?? '0.00';
        $vat = $rateData['vat'] ?? '0.00';
        $babySeatCharges = $rateData['babySeat'] ?? '0.00';
        $total = $rateData['total'] ?? '0.00';

        // Generate pickup details only if relevant data exists
        $pickupDetails = "";
        if ($sourcePlaceName || $sourceEmirate || (!is_null($sourceLatitude) && !is_null($sourceLongitude))) {
            $pickupDetails .= "*Pickup Details:*\n";
            if ($sourcePlaceName) $pickupDetails .= "- Place Name: $sourcePlaceName\n";
            if ($sourceEmirate) $pickupDetails .= "- Emirate: $sourceEmirate\n";
            if (!is_null($sourceLatitude) && !is_null($sourceLongitude)) {
                $pickupDetails .= "- Map: http://maps.google.co.in/maps?q=" . urlencode($sourcePlaceName) . "&ll=$sourceLatitude,$sourceLongitude&region=ae\n";
            }
            $pickupDetails .= "\n";
        }

        // Generate dropoff details only if relevant data exists
        $dropoffDetails = "";
        if ($destinationPlaceName || $destinationEmirate || (!is_null($destinationLatitude) && !is_null($destinationLongitude))) {
            $dropoffDetails .= "*Dropoff Details:*\n";
            if ($destinationPlaceName) $dropoffDetails .= "- Place Name: $destinationPlaceName\n";
            if ($destinationEmirate) $dropoffDetails .= "- Emirate: $destinationEmirate\n";
            if (!is_null($destinationLatitude) && !is_null($destinationLongitude)) {
                $dropoffDetails .= "- Map: https://maps.google.com/?q=" . urlencode($destinationPlaceName) . "&ll=$destinationLatitude,$destinationLongitude&region=ae\n";
            }
            $dropoffDetails .= "\n";
        }

        // Generate booking details only if relevant data exists
        $bookingDetails = "";
        if ($formattedPickupDate || $pickuptime || $formattedReturnDate || $returntime) {
            $bookingDetails .= "*Booking Details:*\n";
            if ($formattedPickupDate) $bookingDetails .= "- Pickup Date: $formattedPickupDate\n";
            if ($pickuptime) $bookingDetails .= "- Pickup Time: $pickuptime\n";
            if ($formattedReturnDate) $bookingDetails .= "- Dropoff Date: $formattedReturnDate\n";
            if ($returntime) $bookingDetails .= "- Dropoff Time: $returntime\n";
            if ($babySeat === 'Included') $bookingDetails .= "- Baby Seat: $babySeat\n";
            $bookingDetails .= "\n";
        }

        // Generate car details
        if (empty($pickupDetails) && empty($dropoffDetails) && empty($bookingDetails)) {
            $carDetails = "Hi, I would like to book\n\n" .
            "- Car Name: {$carData->brand_name} {$carData->name} {$carData->model}\n" .
            "- Car Type: {$carData->car_type}\n\n";
        }else{
            $carDetails = "*Car Details:*\n" .
            "- Car Name: {$carData->brand_name} {$carData->name} {$carData->model}\n" .
            "- Car Type: {$carData->car_type}\n\n";
        }
        
        // Generate rent details only if they are non-zero
        $rentDetails = "";
        if (floatval($rate) > 0) $rentDetails .= "*Rent Details:*\n";
        if (floatval($rate) > 0) $rentDetails .= "- Rent: $rate\n";
        if (floatval($deposit) > 0) $rentDetails .= "- Deposit: $deposit\n";
        if (floatval($emirateCharges) > 0) $rentDetails .= "- Pick & Drop Charges: $emirateCharges\n";
        if (floatval($vat) > 0) $rentDetails .= "- VAT: $vat\n";
        if (floatval($babySeatCharges) > 0) $rentDetails .= "- Baby seat charges: $babySeatCharges\n";
        if (floatval($total) > 0) $rentDetails .= "- Total: $total\n";

        // Combine all sections
        return $pickupDetails . $dropoffDetails . $bookingDetails . $carDetails . $rentDetails;
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

    public function availableDates(Request $request){
        $site = new Site();
        $response = [];
        $credentials = $request->validate([
            'carId' => ['required']
        ]);
        $credentials['phone'] = '';
        $response = $site->getAvailableDates($credentials);
        return response()->json($response);
    }

    public function getFilters(Request $request){
        $site = new Site();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'type' => [''],
                'brand' => [''],
                'carTransmission' => [''],
                'carSeats' => [''],
                'transId' => [''],
                'seatId' => [''],
                'carFuel' => [''],
            ]);
            
            $data['types'] = $site->getFilters($filterData,'type');
            $data['brand'] = $site->getFilters($filterData,'brand');
            $data['transmission'] = $site->getFilters($filterData,'transmission');
            $data['seat'] = $site->getFilters($filterData,'seat');
            $data['fuel'] = $site->getFilters($filterData,'fuel');

            return json_encode($data);
        }
    }
    
    public function getOfferFilters(Request $request){
        $site = new Site();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'type' => [''],
                'brand' => [''],
                'carTransmission' => [''],
                'carSeats' => [''],
                'transId' => [''],
                'seatId' => [''],
                'carFuel' => [''],
            ]);
            
            $data['types'] = $site->getOfferFilters($filterData,'type');
            $data['brand'] = $site->getOfferFilters($filterData,'brand');
            $data['transmission'] = $site->getOfferFilters($filterData,'transmission');
            $data['seat'] = $site->getOfferFilters($filterData,'seat');
            $data['fuel'] = $site->getOfferFilters($filterData,'fuel');

            return json_encode($data);
        }
    }

    function encryptAndStoreFile($file)
    {
        $fileContents = file_get_contents($file);
        $encryptedContents = Crypt::encrypt($fileContents);
        
        // Store in storage/app/encrypted_files
        $fileName = 'encrypted_files/' . $file->getClientOriginalName() . '.enc';
        Storage::put($fileName, $encryptedContents);

        return $fileName;
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
