<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Site;
use App\Exports\UserExport;
use App\Exports\BookingsExport;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use Session;
use Redirect;
use Storage;
use File;
use \Illuminate\Http\UploadedFile;
use URL;

class AdminController extends Controller
{

    public function __construct(Request $request)
    {
        $route = Route::current()->getActionName();
        if($route != 'App\Http\Controllers\AdminController@editCar' || $route != 'App\Http\Controllers\AdminController@deleteCarImage'){
            Session::forget('deleteCarImageData');
        }

        date_default_timezone_set('Asia/Calcutta');
        $site = new Site();
        $emirates = $site->getEmirates();
        $layoutCarTypes = $site->getCarType();
        $country = $site->getCountry();
    
        view()->share('emirates', $emirates);
        view()->share('country', $country);
        view()->share('layoutCarTypes', $layoutCarTypes);
    }
    public function login(Request $request){
        $admin = new Admin();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'email' => ['required'],
                'password' => ['required']
            ]);
            $data = $admin->authenticateAdmin($filterData);    
             
            if(!empty($data)){
                Session::put('userAdminData', $data[0]);
                return Redirect::to('/admin/dashboard');
            }else{
                return back()->withErrors(["error" => "Invalid email or password."]);
            }
        }else{
            return view('admin/login');
        }
    }

    public function dashboard(Request $request){
        $admin = new Admin();
        $response = [];
        $input = ['from' => date('Y-m-d'),'to' => date('Y-m-d'),'period'=>'today']; //Today's data

        $data = $admin->getChartData($input);
        $response['booking_stat'] = $this->generateChartData($data);

        $data = $admin->getChartData2($input);
        $response['booking_stat2'] = $this->generateChartData($data);

        $response['latest_bookings'] = $admin->getLatestBooking($input);

        $data = $admin->carWiseBooking($input);
        $response['carwise_bookings'] = $this->generateCarWiseBookingData($data);

        $response['sales'] = $admin->getSales($input);

        $response['customers'] = $admin->getCustomers($input);
// echo '<pre>';print_r($response);exit;
        return view('admin/dashboard',$response);
    }

    public function dashboardAjax(Request $request){
        $admin = new Admin();
        $response = [];
        $filterData = $request->validate([
            'period' => ['required'],
            'card' => ['required']
        ]);

        switch ($filterData['period']) {
            case 'today':
                $filterData['from'] = date('Y-m-d');
                $filterData['to'] = date('Y-m-d');
                break;
            case 'yesterday':
                $filterData['from'] =  date('Y-m-d',strtotime("-1 days"));
                $filterData['to'] = date('Y-m-d',strtotime("-1 days"));
                break;
            case 'thismonth':
                $filterData['from'] = date('Y-m-01');
                $filterData['to'] = date('Y-m-t');
                break;
            case 'thisyear':
                $filterData['from'] = date('Y-01-01');
                $filterData['to'] = date('Y-12-31');
                break;
            default:
                $filterData['from'] = date('Y-m-d');
                $filterData['to'] = date('Y-m-d');
                break;
        }
        
        switch ($filterData['card']) {
            case 'booking-stat':
                $data = $admin->getChartData($filterData);
                $response['data'] = $this->generateChartData($data);

                $data = $admin->getChartData2($filterData);
                $response['data2'] = $this->generateChartData($data);
                break;
            case 'carwise-booking':
                $data = $admin->carWiseBooking($filterData);
                $response = $this->generateCarWiseBookingData($data);
                break;
            case 'customer-count':
                $response = $admin->getCustomers($filterData);
                break;
            case 'sales-count':
                $response = $admin->getSales($filterData);
                break;
            
            default:
                # code...
                break;
        }

        return response()->json($response);
        
        return view('admin/dashboard');
    }

    public function userList(){
        $admin = new Admin();
        $data['users'] = $admin->getUserList();
        return view('admin/users',$data);
    }

    public function deleteUsers(Request $request)
    {
        $admin = new Admin();
        
        $filterData = $request->validate([
            'id' => [''],
        ]);
        $data = $admin->deleteUserData($filterData);
        if($data){
            $res['status'] = 200;
            $res['data'] = "User deleted.";
        }
        return json_encode($res);
    }

    public function viewUsers(Request $request)
    {
        $admin = new Admin();
        
        $queries = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $input['id'] = base64_decode($queries['id']);

        $data['user'] = $admin->getUsersDetails($input);
        
        return view('admin/view-user', $data);
    }
    
    public function downloadDocument(Request $request)
    {
        $admin = new Admin();
        
        $queries = $files = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $input['userId'] = base64_decode($queries['id']);
        $input['doc'] = $queries['doc'];
        
        $documents = $admin->getMyDocumentDetails($input);
        // echo '<pre>';print_r($documents);exit;
        switch ($input['doc']) {
            case 'pf':
                $file = public_path($documents[0]->pass_front);
                break;

            case 'pb':
                $file = public_path($documents[0]->pass_back);
                break;

            case 'df':
                $file = public_path($documents[0]->dl_front);
                break;
                    
            case 'db':
                $file = public_path($documents[0]->dl_back);
                break;

            case 'ef':
                $file = public_path($documents[0]->eid_front);
                break;

            case 'eb':
                $file = public_path($documents[0]->eid_back);
                break;
            
            default:
                $files = $documents[0];
                break;
        }

        if($input['doc'] == 'all'){
            $zipFileName = 'files.zip';

            $zip = new \ZipArchive;

            $zipPath = public_path($zipFileName);

            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
                foreach ($files as $file) {
                    if (file_exists($file)) {
                        $zip->addFile($file, basename($file));
                    }
                }
                $zip->close();
            } else {
                return response()->json(['error' => 'Unable to create ZIP file'], 500);
            }
        
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }else{
            if (file_exists($file)) {
                return response()->download($file);
            } else {
                return response()->json(['error' => 'File not found'], 404);
            }
        }
    }
    
    public function editUsers(Request $request)
    {
        $admin = new Admin();
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'userId' => ['required'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required'],
                'phone' => ['required'],
                'flat' => ['required'],
                'building' => ['required'],
                'landmark' => ['required'],
                'city' => ['required'],
                'country' => ['required'],
                'user_type' => ['required'],

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
            
            $currentFiles = $admin->getMyDocumentDetails($credentials);

            // Check for errors in uploaded files
            if ($uploadedFiles['errors']) {
                return response()->json(['status' => '400', 'message' => $uploadedFiles['errors']], 400);
            }

            // Add user ID to the uploaded files data
            $uploadedFiles['id'] = $credentials['userId'];

            // Save uploaded documents
            $res = $admin->updateUploadedDocuments($uploadedFiles);

            $res = $admin->updateUserData($credentials);

            if($res){
                foreach ($uploadedFiles['uploadedFiles'] as $key => $field) {
                    $currentFilePath = $currentFiles[0]->{str_replace('edit_', '', $key)} ?? null;
                    if ($currentFilePath && File::exists($currentFilePath)) {
                        File::delete($currentFilePath);
                    }
                }
            }
            return redirect()->to('/admin/edit-users?id=' . base64_encode($credentials['userId']))
                         ->with('success', 'User details updated successfully!');
        }else{
            $queries = [];
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $input['id'] = base64_decode($queries['id']);
    
            $data['user'] = $admin->getUsersDetails($input);
            $data['country'] = $admin->getContry();
            // echo '<pre>';print_r($data);exit;
            return view('admin/edit-user', $data);
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

    public function bookingList(Request $request){
        
        $admin = new Admin();
        if($request->method() == 'POST'){
            $request->flash();
            $filterData = $request->validate([
                'brand' => [''],
                'type' => [''],
                'from' => [''],
                'to' => [''],
            ]);
            $data['bookings'] = $admin->getBookingHistory($filterData);
            Session::put('bookingFilter', $filterData);
            return response()->json($data);
        }else{
            if(Session::get('bookingFilter')){
                $filterData = Session::get('bookingFilter');
            }else{
                date_default_timezone_set('Asia/Calcutta');
                $filterData = [
                    'brand' => '',
                    'type' => '',
                    'from' => date('Y-m-d', time()),
                    'to' => date('Y-m-d', time()),
                ];
            }
            $data['brands'] = $admin->getBrands();
            $data['type'] = $admin->getCarType();
            $data['bookings'] = $admin->getBookingHistory($filterData);
            Session::put('bookingFilter', $filterData);
            return view('admin/bookings',$data);
        }
        
    }

    public function bookingDetails(){
        $admin = new Admin();
        $queries = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $input['id'] = base64_decode($queries['id']);
        $data['details'] = $admin->getBookingDetails($input);
        return view('admin/booking-details',$data);
        // echo '<pre>';print_r($data);exit;
    }

    public function updateDocumentStatus(Request $request){
        $admin = new Admin();
        $res = $data = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'userId' => ['required'],
                'docType' => ['required'],
                'status' => ['required'],
            ]);
            if($filterData['status']=='delete'){
                $data = $admin->updateDocStatus($filterData);                
            }
            
            if($data){
                $img = $admin->getImage($filterData);
                if (File::exists($img->image)) {
                    File::delete($img->image);
                    $admin->updateDocImage($filterData,$img); 
                }
                $res['status'] = 200;
                $res['data'] = "Document deleted.";
            }else{
                $res['status'] = 500;
                $res['data'] = "Car not deleted."; 
            }
            return json_encode($res);
        }
    }

    public function cars(){
        $admin = new Admin();
        $data['cars'] = $admin->getCars();
        return view('admin/cars',$data);
    }

    public function addCar(Request $request)
    {
        $admin = new Admin();

        if ($request->isMethod('POST')) {
            
            $request->flash();
            
            
            // Validation
            $filterData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'brand' => ['required'],
                'model' => ['required'],
                'cartype' => ['required'],
                'features' => ['required'],
                'specifications' => ['required'],
                'general_info' => ['nullable'],
                'rental_condition' => ['nullable', ],
                'carImages' => ['required', 'array'],
                'carImages.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

                'rent' => ['required'],
                'daily_mileage' => ['required'],
                'specialOffer' => ['nullable'],
                'offerFlag' => ['nullable'],

                'weekly_rent' => ['required'],
                'weekly_mileage' => ['required'],
                'offerFlagWeekly' => ['nullable'],
                'specialOfferWeekly' => ['nullable'],

                'monthly_rent' => ['required'],
                'monthly_mileage' => ['required'],
                'offerFlagMonthly' => ['nullable'],
                'specialOfferMonthly' => ['nullable'],

                'deposit' => ['required'],
                'qty' => ['nullable','numeric'],
                'kmeter' => ['required','numeric'],
                'toll' => ['required','numeric'],
                'additionalCharge' => ['required','numeric'],
            ],[
                'carImages.*.max' => 'Each image must not exceed 2 MB in size.',
            ]);
            
            // Handle checkbox inputs
            $filterData['general_info'] = !empty($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = !empty($filterData['rental_condition']) ? 1 : 0;
            $filterData['offerFlag'] = !empty($filterData['offerFlag']) ? 1 : 0;
            $filterData['offerFlagWeekly'] = isset($filterData['offerFlagWeekly']) ? 1 : 0;
            $filterData['offerFlagMonthly'] = isset($filterData['offerFlagMonthly']) ? 1 : 0;

            $filterData['qty'] = 1;
            
            // Handle file uploads
            $uploadedImages = [];
            if ($request->hasFile('carImages')) {
                foreach ($request->file('carImages') as $file) {
                    if (!$file->isValid()) {
                        return back()->withErrors(["error" => "Upload error: " . $file->getErrorMessage()]);
                    }

                    list($width, $height) = getimagesize($file);
                    if ($width < 800 || $height < 600) {
                        return back()->withErrors(['carImages' => 'Image dimensions must be at least 800x600 pixels.']);
                    }

                    $fileName = 'storage/' . $file->store('uploads/cars', 'public');
                    $uploadedImages[] = $fileName;
                }
            } else {
                return back()->withErrors(["error" => "Please select car images."]);
            }
            
            // Assign uploaded file paths to filterData
            $filterData['carImages'] = $uploadedImages;
            
            // Save car data
            $res = $admin->saveCarData($filterData);

            // Check if save was successful
            if ($res) {
                return redirect()->to('/admin/cars')->with('success', 'Car added successfully!');
            } else {
                return back()->withErrors(["error" => "An error occurred while adding the car."]);
            }
        } else {
            // Prepare data for the view
            $data['brands'] = $admin->getBrands();
            $data['features'] = $admin->getFeatures();
            $data['type'] = $admin->getCarType();
            $data['specification'] = $admin->getSpecifications();

            return view('admin/add-cars', $data);
        }
    }

    public function previewCar(Request $request){
        $queries = [];
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $input['id'] = base64_decode($queries['id']);
        $input['format'] = 'normal';
        $site = new Site();
        $data['carDet'] = $site->getCars($input);
        $data['features'] = $site->getCarFeatures($input);
        $data['specs'] = $site->getCarSpecifications($input);
        $data['emirates'] = $site->getEmirates();
        $data['generalInfo'] = $site->getCarGeneralInfo();
        $data['policy'] = $site->getPolicyAgreement();
        return view('admin/car-preview',$data);
    }

    public function editCar(Request $request)
    {
        $admin = new Admin();

        if ($request->isMethod('post')) {
            // Validate the incoming request data
            $filterData = $request->validate([
                'carId' => ['required'],
                'name' => ['required'],
                'brand' => ['required'],
                'model' => ['required'],
                'cartype' => ['required'],
                'features' => ['required'],
                'specifications' => ['required'],
                
                'deposit' => ['required'],
                'general_info' => ['nullable'],
                'rental_condition' => ['nullable'],
                'carImages' => ['nullable'],
                'carImages.*' => ['image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],

                'rent' => ['required'],
                'daily_mileage' => ['required'],
                'specialOffer' => ['nullable'],
                'offerFlag' => ['nullable'],

                'weekly_rent' => ['required'],
                'weekly_mileage' => ['required'],
                'offerFlagWeekly' => ['nullable'],
                'specialOfferWeekly' => ['nullable'],

                'monthly_rent' => ['required'],
                'monthly_mileage' => ['required'],
                'offerFlagMonthly' => ['nullable'],
                'specialOfferMonthly' => ['nullable'],

                'qty' => ['nullable','numeric'],
                'kmeter' => ['required','numeric'],
                'toll' => ['required','numeric'],
                'additionalCharge' => ['required','numeric'],
            ]);

            // Set flags for general info and rental conditions
            $filterData['general_info'] = isset($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = isset($filterData['rental_condition']) ? 1 : 0;
            $filterData['offerFlag'] = isset($filterData['offerFlag']) ? 1 : 0;
            $filterData['offerFlagWeekly'] = isset($filterData['offerFlagWeekly']) ? 1 : 0;
            $filterData['offerFlagMonthly'] = isset($filterData['offerFlagMonthly']) ? 1 : 0;

            $filterData['qty'] = 1;
            // echo '<pre>';print_r($filterData);exit;
            if(Session::get('deleteCarImageData')){
                $CarImageData = Session::get('deleteCarImageData');
                // echo '<pre>';print_r($CarImageData);exit;
                foreach ($CarImageData as $carKey => $carValue) {
                    $img = $admin->deleteCarImageData($carValue);
                    if($img){
                        if (File::exists($carValue['image'])) {
                            File::delete($carValue['image']);
                        }
                    }
                }
                Session::forget('deleteCarImageData');
            }

            

            // Handle image uploads
            if (!empty($filterData['carImages'])) {
                $temp = [];
                foreach ($filterData['carImages'] as $file) {

                    list($width, $height) = getimagesize($file);
                    if ($width < 800 || $height < 600) {
                        return back()->withErrors(['carImages' => 'Image dimensions must be at least 800x600 pixels.']);
                    }
                    
                    $fileName = 'storage/' . $file->store('uploads/cars', 'public');
                    $temp[] = $fileName;
                }
                $filterData['carImages'] = $temp;
            }

            // Update car data in the database
            $res = $admin->updateCarData($filterData);

            if(!$res){
                $res = $filterData['carId'];
            }
            
            // Redirect after successful update
            return redirect()->to('/admin/edit-car?id=' . base64_encode($filterData['carId']))
                         ->with('success', 'Car details updated successfully!');
        } else {
            // Handle GET request to display the edit form
            $queries = [];
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $input['id'] = base64_decode($queries['id']);
            $input['format'] = 'edit';

            $data['cars'] = $admin->getCars($input);
            $data['carFeatures'] = $this->getArray($admin->getCarFeatures($input), 'id');
            $data['carSpecification'] = $admin->getCarSpecifications($input);
            $data['brands'] = $admin->getBrands();
            $data['features'] = $admin->getFeatures();
            $data['type'] = $admin->getCarType();

            return view('admin/edit-cars', $data);
        }
    }

    public function deleteCar(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);

            $filterData['format'] = 'edit';
            $carData = $admin->getCars($filterData);
            foreach ($carData as $key => $value) {
                if (isset($value->image) && File::exists($value->image)) {
                    File::delete($value->image);
                }
            }
            
            $data = $admin->deleteCarData($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = "Car deleted.";
            }
            return json_encode($res);
        }
    }

    public function deleteCarImage(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'image' => ['required'],
                'carId' => ['required'],
            ]);

            $carImageData = Session::get('deleteCarImageData', []);
            $carImageData[] = $filterData;
            Session::put('deleteCarImageData', $carImageData);
            
            return json_encode(1);
        }
    }

    public function getArray($array,$filter){
        $temp = [];
        foreach ($array as $key => $value) {
            array_push($temp,$value->$filter);
        }
        return $temp;
    }

    public function addFeatures(){
        $admin = new Admin();
        $data['features'] = $admin->getFeatures();
        return view('admin/add-features',$data);
    }

    public function saveFeatures(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'name' => ['required'],
            ]);
            $data = $admin->saveFeatureData($filterData);
            if($data > 0){
                $res['status'] = 200;
                $res['data'] = $admin->getFeatures(['id'=>$data]);
            }else{
                $res['status'] = 200;
                $res['data'] = $data;
            }
            return json_encode($res);
        }
    }

    public function deleteFeatures(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->deleteFeatureData($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = "Feature deleted.";
            }
            return json_encode($res);
        }
    }
    
    public function updateFeatures(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
                'name' => ['required'],
            ]);
            $data = $admin->updateFeatureData($filterData);
            
            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Feature updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    /**Emirates section starts */
    public function addEmirates(){
        $admin = new Admin();
        $data['emirates'] = $admin->getEmirates();
        return view('admin/add-emirtates',$data);
    }

    public function addNewEmirates(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'name' => ['required'],
                'rate' => ['required'],
                'active' => ['nullable'],
            ]);
            
            $filterData['active'] = isset($filterData['active']) ? 1 : 0;
            
            $data = $admin->saveEmiratesData($filterData);
            if ($data > 0) {
                $response['status'] = 200;
                $response['message'] = "Emirate created successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function editEmirates(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->getEmirates($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
            }
            return json_encode($res);
        }
    }

    public function updateEmirates(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'emId' => ['required'],
                'emName' => ['required'],
                'emRate' => ['required'],
                'emActive' => [''],
            ]);
            
            $filterData['emActive'] = isset($filterData['emActive']) ? 1 : 0;
            
            $data = $admin->updateEmiratesData($filterData);
            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Emirate updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }
    /**Emirates section ends */
    
    /**Specification Related proceses */
    public function addSpecifications(){
        $admin = new Admin();
        $data['specification'] = $admin->getSpecifications();
        return view('admin/add-specifications',$data);
    }

    public function addSpec(Request $request){
        $admin = new Admin();
        $response = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'specName' => ['required'],
                'specActive' => ['nullable'],
                'options' => ['nullable'],
                'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);
            
            $str = '';
            foreach ($filterData['options'] as $value) {
                if (str_contains($value, '"')) { 
                    $str .= str_replace('"', '', $value)."~";
                }else if (str_contains($value, "'")) {
                    $str .= str_replace("'", "", $value)."~";
                }else{
                    $str .= $value."~";
                }
            }
            
            $filterData['options'] = rtrim($str,'~');
            $filterData['specActive'] = isset($filterData['specActive']) ? 1 : 0;
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filterData['image'] = 'storage/'.$file->store('uploads/specifications', 'public');
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'Please select a valid image.'
                ], 422);
            }
            
            $data = $admin->saveSpecData($filterData);
            
            if ($data > 0) {
                $response['status'] = 200;
                $response['message'] = "Specification created successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function editSpec(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->getSpecifications($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
            }
            return json_encode($res);
        }
    }

    public function updateSpec(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'specId' => ['required'],
                'specName' => ['required'],
                'specActive' => ['nullable'],
                'options' => ['nullable'],
                'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);
            $str = '';
            foreach ($filterData['options'] as $value) {
                if (str_contains($value, '"')) { 
                    $str .= str_replace('"', '', $value)."~";
                }else if (str_contains($value, "'")) {
                    $str .= str_replace("'", "", $value)."~";
                }else{
                    $str .= $value."~";
                }
            }
            $filterData['options'] = rtrim($str,'~');
            $filterData['specActive'] = isset($filterData['specActive']) ? 1 : 0;
            if(!empty($_FILES['image']['name'])){
                $file = $request->file('image');
                $filterData['image'] = 'storage/'.$file->store('uploads/specifications', 'public');
            }
            
            $data = $admin->updateSpecData($filterData);
            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Specification updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function deleteSpec(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);

            $imageData = $admin->getSpecifications($filterData);
            if (isset($specData[0]->image) && File::exists($specData[0]->image)) {
                File::delete($specData[0]->image);
            }
            $data = $admin->deleteSpecData($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = "Brand deleted.";
            }
            return json_encode($res);
        }
    }
    /**Specification Related proceses End */

    /**Brand Related proceses */
    public function addBrands(){
        $admin = new Admin();
        $data['brands'] = $admin->getBrands();
        return view('admin/add-brands',$data);
    }

    public function deleteBrand(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);

            $brandData = $admin->getBrands($filterData);
            if (isset($brandData[0]->image) && File::exists($brandData[0]->image)) {
                File::delete($brandData[0]->image);
            }

            $data = $admin->deleteBrandData($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = "Brand deleted.";
            }
            return json_encode($res);
        }
    }

    public function editBrand(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->getBrands($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
            }
            return json_encode($res);
        }
    }

    public function addBrand(Request $request){
        $admin = new Admin();
        $response = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'brName' => ['required'],
                'brActive' => ['nullable'],
                'brImage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            
            $filterData['brActive'] = isset($filterData['brActive']) ? 1 : 0;

            if(!empty($_FILES['brImage']['name'])){
                $file = $request->file('brImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            
            $data = $admin->saveBrandData($filterData);
            
            if ($data > 0) {
                $response['status'] = 200;
                $response['message'] = "Brand created successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function updateBrand(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'brandId' => ['required'],
                'brandName' => ['required'],
                'brandActive' => ['nullable'],
                'brandImage' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            
            $filterData['brandActive'] = isset($filterData['brandActive']) ? 1 : 0;
            if(!empty($_FILES['brandImage']['name'])){
                $file = $request->file('brandImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }
            
            if(!empty($filterData['image'])){
                $data = $admin->getBrands(['id'=>$filterData['brandId']]);
                $filename = $data[0]->image;
                File::delete($filename);
            }
            $data = $admin->updateBrandData($filterData);

            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Brand updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }
    /**Brand Related proceses End*/

    /**Car type Related proceses */
    public function addTypes(){
        $admin = new Admin();
        $data['type'] = $admin->getCarType();
        return view('admin/add-types',$data);
    }

    public function deleteType(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            
            $data = $admin->deleteTypeData($filterData);
            if($data){
                $typeData = $admin->getCarType($filterData);
                if (isset($typeData[0]->image) && File::exists($typeData[0]->image)) {
                    File::delete($typeData[0]->image);
                }

                $res['status'] = 200;
                $res['data'] = "Car type deleted.";
            }
            return json_encode($res);
        }
    }

    public function editType(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->getCarType($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = $data;
            }
            return json_encode($res);
        }
    }

    public function addType(Request $request){
        $admin = new Admin();
        $response = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'tyName' => ['required'],
                'tyActive' => ['nullable'],
                'tyImage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            
            $filterData['tyActive'] = isset($filterData['tyActive']) ? 1 : 0;
            if(!empty($_FILES['tyImage']['name'])){
                $file = $request->file('tyImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select car type image."]);
            }
            
            $data = $admin->saveTypeData($filterData);

            if ($data > 0) {
                $response['status'] = 200;
                $response['message'] = "Car type created successfully.";
            }else if ($data == -1) {
                $response['status'] = 500;
                $response['message'] = "Car type already exist.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function updateType(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'typeId' => ['required'],
                'typeName' => ['required'],
                'typeActive' => ['nullable'],
                'tyImage' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            
            $filterData['typeActive'] = isset($filterData['typeActive']) ? 1 : 0;
            if(!empty($_FILES['typeImage']['name'])){
                $file = $request->file('typeImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }

            if(!empty($filterData['image'])){
                $data = $admin->getCarType(['id'=>$filterData['typeId']]);
                $filename = $data[0]->image;
                File::delete($filename);
            }

            $data = $admin->updateTypedData($filterData);

            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Brand updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }
    /**Car type Related proceses End*/

    /**General information about car Start */
    public function generalInfo(Request $request){
        $admin = new Admin();
        if ($request->isMethod('POST')) {
            $filterData = $request->validate([
                'id' => ['required'],
                'heading' => ['required'],
                'content' => ['required'],
                'options' => ['nullable'],
            ]);
            
            $data = $admin->saveGeneralInfoData($filterData);
            if ($data) {
                return redirect()->to('/admin/general-info')->with('success', 'General informations added successfully!');
            } else {
                return back()->withErrors(["error" => "An error occurred while adding the General informations."]);
            }
        }else{
            $data['content'] = $admin->getGeneralInfo();
            return view('admin/general-info',$data);
        }
    }
    /**General information about car End */

    /**Policies and agreements of car Start */
    public function policyAgreement(){
        $admin = new Admin();
        $data['policy'] = $admin->getPolicyAgreement();
        return view('admin/policy-agreement',$data);
    }

    public function savePolicyAgreement(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'name' => ['required'],
                'content' => ['required'],
                'active' => [''],
            ]);
            $filterData['active'] = ($filterData['active']=='true') ? 1 : 0;
            $data = $admin->savePolicyAgreementData($filterData);
            if ($data == -1) {
                $response['status'] = 500;
                $response['message'] = "Something went wrong.";
            }else {
                $response['status'] = 200;
                $response['message'] = "Policies and Agreements added successfully.";
            }
            return json_encode($response);
        }
    }

    public function editPolicyAgreement(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->getPolicyAgreement($filterData);
            return json_encode($data);
        }
    }

    public function updatePolicyAgreement(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
                'name' => ['required'],
                'content' => ['required'],
                'active' => ['nullable'],
            ]);
            $filterData['active'] = ($filterData['active']=='true') ? 1 : 0;
            $data = $admin->updatePolicyAgreementData($filterData);
            if ($data == 0) {
                $response['status'] = 200;
                $response['message'] = "Nothing to update.";
            }else if ($data == 1) {
                $response['status'] = 200;
                $response['message'] = "Policies and Agreements updated successfully.";
            } else {
                $response['status'] = 500;
                $response['message'] = "Something went wrong. Please try again.";
            }
            
            return response()->json($response);
        }
    }

    public function deletePolicyAgreement(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
            $data = $admin->deletePolicyAgreementData($filterData);
            if($data){
                $res['status'] = 200;
                $res['data'] = "Agreement deleted.";
            }
            return json_encode($res);
        }
    }

    public function exportUsers(){

        $admin = new Admin();
        $data = $admin->getUserList();
        return Excel::download(new UserExport($data), 'Users.xlsx');
    }
    
    public function exportBookings(){

        $admin = new Admin();
        $filterData = Session::get('bookingFilter');
        $data = $admin->getBookingHistory($filterData);
        return Excel::download(new BookingsExport((object)$data), 'Bookings.xlsx');
    }

    public function logout(){
        Session::flush();
        return Redirect::to('/admin/login');
    }
    /**Policies and agreements of car End */

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    
    function random_color() {
        return '#' . $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function generateChartData($data){
        $temp = [];
        foreach ($data as $key => $value) {
            if (!isset($temp['label'])) {
                $temp['label'] = [];
            }
            
            if (!isset($temp['data'])) {
                $temp['data'] = [];
            }
            array_push($temp['label'],$value->label);
            array_push($temp['data'],$value->booking_count);
        }
        return $temp;
    }

    public function generateCarWiseBookingData($data){
        $temp = [];
        foreach ($data as $key => $value) {
            if (!isset($temp['label'])) {
                $temp['label'] = [];
            }
            if (!isset($temp['data'])) {
                $temp['data'] = [];
            }
            if (!isset($temp['color'])) {
                $temp['color'] = [];
            }
            array_push($temp['label'],$value->label);
            array_push($temp['data'],$value->booking_total);
            array_push($temp['color'], $this->random_color());
        }
        return $temp;
    }

    public function reports(Request $request){
        $request->flash();
        $admin = new Admin();
        $response = [];

        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'from' => [''],
                'to' => [''],
            ]);
            
            
            $data = $admin->getBookingHistoryReports($filterData);
            // echo '<pre>';print_r($data);exit;
            $response = $this->generateReportData($data);
        }else{
            $filterData['from'] = date('Y-m-d');
            $filterData['to'] = date('Y-m-d');
            $data = $admin->getBookingHistoryReports($filterData);
            // echo '<pre>';print_r($data);exit;
            $response = $this->generateReportData($data);
            // echo '<pre>';print_r($response);exit;
        }
        
        return view('admin/reports',$response);
    }

    private function generateReportData($data){
        $collection = collect($data);

        // Calculate metrics
        $carWiseSales = $collection->groupBy('carname')->map(function ($group,$carname) {
            return [
                'car_name' => $carname,
                'total_sales' => $group->sum('rate'),
                'sales_count' => $group->count(),
            ];
        });

        $brandWiseSales = $collection->groupBy('carbrand')->map(function ($group,$carbrand) {
            return [
                'brand_name' => $carbrand,
                'total_sales' => $group->sum('rate'),
                'sales_count' => $group->count(),
            ];
        });

        $carTypeWiseSales = $collection->groupBy('cartypename')->map(function ($group,$cartypename) {
            return [
                'type_name' => $cartypename,
                'total_sales' => $group->sum('rate'),
                'sales_count' => $group->count(),
            ];
        });

        // Calculate total sales and sales count
        $totalSales = $collection->sum('rate');
        $totalSalesCount = $collection->count();

        // Output the results
        $response = [
            'car_wise_sales' => $carWiseSales,
            'brand_wise_sales' => $brandWiseSales,
            'car_type_wise_sales' => $carTypeWiseSales,
            'total_sales' => $totalSales,
            'total_sales_count' => $totalSalesCount,
        ];
        return $response;
    }
}
