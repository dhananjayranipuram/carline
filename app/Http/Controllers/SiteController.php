<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
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
        $country = [
            "AE" => "United Arab Emirates",
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BR" => "Brazil",
            "BN" => "Brunei",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo - Brazzaville",
            "CD" => "Congo - Kinshasa",
            "CR" => "Costa Rica",
            "CI" => "Côte d’Ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czechia",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "SZ" => "Eswatini",
            "ET" => "Ethiopia",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GR" => "Greece",
            "GD" => "Grenada",
            "GT" => "Guatemala",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HN" => "Honduras",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Laos",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "MX" => "Mexico",
            "FM" => "Micronesia",
            "MD" => "Moldova",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar (Burma)",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestine",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PL" => "Poland",
            "PT" => "Portugal",
            "QA" => "Qatar",
            "RO" => "Romania",
            "RU" => "Russia",
            "RW" => "Rwanda",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "São Tomé & Príncipe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "KR" => "South Korea",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syria",
            "TW" => "Taiwan",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TO" => "Tonga",
            "TT" => "Trinidad & Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VA" => "Vatican City",
            "VE" => "Venezuela",
            "VN" => "Vietnam",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe"
        ];
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
                }else if($credentials['pickupdate'] ){
                    if($credentials['pickupdate'] == date('Y-m-d')){
                        $time = strtotime(date('h:i a', time()));
                        $round = 30*60;
                        $rounded = round($time / $round) * $round;
                        $date = date("H:i", $rounded);
                        
                        $timeSlots = $this->generateStartTimeslot($date,'');
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

    public function generateStartTimeslot($pickupTime,$dropoffTime){
        // echo $pickupTime;
        $timeSlots = [];
        $startTime = $pickupTime ? strtotime($pickupTime) : strtotime("12:00 AM");
        
        $endTime = $dropoffTime ? strtotime($dropoffTime) : strtotime("11:59 PM");
        $startTime += 120*60;

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
        $uploadCnt = 0;
        if($res->user_type == 'R'){
            $uploadCnt = $res->passf_flag * $res->passb_flag * $res->dlf_flag * $res->dlb_flag * $res->eidf_flag * $res->eidb_flag;
        }else{
            $uploadCnt = $res->passf_flag * $res->passb_flag * $res->dlf_flag * $res->dlb_flag;
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
            'pass_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'pass_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'dl_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'eid_front' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            'eid_back' => ['nullable', 'file', 'mimes:jpg,png,pdf', 'max:2048'],
            // 'eid_front' => [
            //     'nullable',
            //     'max:2048',
            //     Rule::requiredIf(function () use ($request) {
            //         return $request->rider_type === 'resident'; // Only required if rider_type is 'resident'
            //     }),
            // ],
            // 'eid_back' => [
            //     'nullable',
            //     'max:2048',
            //     Rule::requiredIf(function () use ($request) {
            //         return $request->rider_type === 'resident'; // Only required if rider_type is 'resident'
            //     }),
            // ],
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
        $res = [];
        $rentDays = $monthlyRate = $weeklyRate = $deposit = $rate = $emirateCharges = $babySeatCharges = $total = 0;
        $daysInWeek = config('constants.DAYS_IN_WEEK');
        $daysInMonth = config('constants.DAYS_IN_MONTH');
        $vatRate = config('constants.VAT_RATE');
        $bsCharges = config('constants.BABY_SEAT_CHARGE');
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
        if($credentials['sourceData']['placeName'] == $carlineName || $credentials['destinationData']['placeName'] == $carlineName){
            $emirateCharges = 0;
        }else {
            $resEmirate = $site->getEmiratesForRate($credentials);
            
            $emirateCharges = !empty($resEmirate) ? (float) str_replace(',', '', $resEmirate[0]->rate) : 0;
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
            $response['bookingData'] = $credentials;
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
        if(empty($data['userAccount'])){
            Session::flush();
            return Redirect::to('/home');
        }
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
        ]);

        // Handle file uploads using the helper function
        $uploadedFiles = $this->handleFileUploads($request, [
            'edit_pass_front', 
            'edit_pass_back', 
            'edit_dl_front', 
            'edit_dl_back', 
            'edit_eid_front', 
            'edit_eid_back'
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
}
