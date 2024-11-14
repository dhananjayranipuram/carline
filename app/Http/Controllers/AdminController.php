<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Session;
use Redirect;
use Storage;
use File;
use \Illuminate\Http\UploadedFile;
use URL;

class AdminController extends Controller
{
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
        $response['booking_stat'] = $temp;

        $response['latest_bookings'] = $admin->getLatestBooking($input);
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
        // print_r($filterData);exit;
        switch ($filterData['card']) {
            case 'booking-stat':
                $data = $admin->getChartData($filterData);
                // print_r($data);exit;
                foreach ($data as $key => $value) {
                    if (!isset($response['label'])) {
                        $response['label'] = [];
                    }
                    
                    if (!isset($response['data'])) {
                        $response['data'] = [];
                    }
                    array_push($response['label'],$value->label);
                    array_push($response['data'],$value->booking_count);
                }
                break;
            /*case 'customer-count':
                $customerRes = $admin->getCustomerData($input);
                $data['customer'] = (object)['today_cnt'=>$customerRes[0]->cnt,'increase'=>$this->increasePercentage($customerRes[1]->cnt,$customerRes[0]->cnt)];
                break;
            case 'pie-chart':
                $data['doc_appt'] = $admin->getDocWiseAppointmentData($input);
                break;
            case 'recent-appt':
                $data['list'] = $admin->getLatestAppointmentData($input);
                break;*/
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
        // echo '<pre>';print_r($data);exit;
        return view('admin/users',$data);
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

    public function bookingList(Request $request){
        $request->flash();
        $admin = new Admin();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'from' => [''],
                'to' => [''],
            ]);
        }else{
            date_default_timezone_set('Asia/Calcutta');
            $filterData = [
                'from' => date('Y-m-d', time()),
                'to' => date('Y-m-d', time()),
            ];
        }
        // echo '<pre>';print_r($filterData);exit;
        $data['bookings'] = $admin->getBookingHistory($filterData);
        // echo '<pre>';print_r($data);exit;
        return view('admin/bookings',$data);
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
                'rent' => ['required'],
                'general_info' => ['nullable'],
                'rental_condition' => ['nullable', ],
                'carImages' => ['required'],
                'carImages.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'specialOffer' => ['nullable'],
                'offerFlag' => ['nullable'],
                'deposit' => ['required'],
                'qty' => ['required','numeric'],
            ]);

            // Handle checkbox inputs
            $filterData['general_info'] = !empty($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = !empty($filterData['rental_condition']) ? 1 : 0;
            $filterData['offerFlag'] = !empty($filterData['offerFlag']) ? 1 : 0;

            // Handle file uploads
            $uploadedImages = [];
            if ($request->hasFile('carImages')) {
                foreach ($request->file('carImages') as $file) {
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
                'rent' => ['required'],
                'deposit' => ['required'],
                'general_info' => ['nullable'],
                'rental_condition' => ['nullable'],
                'carImages' => ['nullable'],
                'carImages.*' => ['image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
                'specialOffer' => ['nullable'],
                'offerFlag' => ['nullable'],
                'qty' => ['required','numeric'],
            ]);

            // Set flags for general info and rental conditions
            $filterData['general_info'] = isset($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = isset($filterData['rental_condition']) ? 1 : 0;
            $filterData['offerFlag'] = isset($filterData['offerFlag']) ? 1 : 0;

            // Handle image uploads
            if (!empty($filterData['carImages'])) {
                $temp = [];
                foreach ($filterData['carImages'] as $file) {
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
                $res['data'] = "Brand deleted.";
            }
            return json_encode($res);
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
            return json_encode($data);
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

    public function logout(){
        Session::flush();
        return Redirect::to('/admin/login');
    }
    /**Policies and agreements of car End */
}
