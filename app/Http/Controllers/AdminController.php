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

    public function dashboard(){
        return view('admin/dashboard');
    }

    public function cars(){
        $admin = new Admin();
        $data['cars'] = $admin->getCars();
        return view('admin/cars',$data);
    }

    public function addCar(Request $request){
        $admin = new Admin();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'name' => ['required'],
                'brand' => ['required'],
                'model' => ['required'],
                'cartype' => ['required'],
                'features' => ['required'],
                'specifications' => ['required'],
                'rent' => ['required'],
                'general_info' => [''],
                'rental_condition' => [''],
                'carImages' => [''],
            ]);
            // echo '<pre>';print_r($filterData);exit;
            $filterData['general_info'] = isset($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = isset($filterData['rental_condition']) ? 1 : 0;
            $temp = [];
            if(!empty($_FILES['carImages'])){
                $file = $request->file('carImages');
                
                foreach ($file as $key => $value) {
                    $fileName = 'storage/'.$value->store('uploads/cars', 'public');
                    array_push($temp,$fileName);
                }
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            $filterData['carImages'] = $temp;
            if($validator->fails()) {
                return Redirect::back()->withErrors($validator);
            }
            // print_r($filterData);exit;
            $res = $admin->saveCarData($filterData);
            return Redirect::to('/admin/add-car');
        }else{
            
            $data['brands'] = $admin->getBrands();
            $data['features'] = $admin->getFeatures();
            $data['type'] = $admin->getCarType();
            $data['specification'] = $admin->getSpecifications();
            return view('admin/add-cars',$data);
        }
    }

    public function editCar(Request $request){
        $admin = new Admin();
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'carId'=> [''],
                'name' => ['required'],
                'brand' => ['required'],
                'model' => ['required'],
                'cartype' => ['required'],
                'features' => ['required'],
                'specifications' => ['required'],
                'rent' => ['required'],
                'deposit' => ['required'],
                'general_info' => [''],
                'rental_condition' => [''],
                'carImages' => [''],
                'specialOffer' => [''],
                'offerFlag' => [''],
            ]);
            $filterData['general_info'] = isset($filterData['general_info']) ? 1 : 0;
            $filterData['rental_condition'] = isset($filterData['rental_condition']) ? 1 : 0;
            $filterData['offerFlag'] = isset($filterData['offerFlag']) ? 1 : 0;
            // echo '<pre>';print_r($filterData);exit;
            $temp = [];
            if(!empty($_FILES['carImages'])){
                $file = $request->file('carImages');
                if(!empty($file)){
                    foreach ($file as $key => $value) {
                        $fileName = 'storage/'.$value->store('uploads/cars', 'public');
                        array_push($temp,$fileName);
                    }
                }
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            $filterData['carImages'] = $temp;
            // if($validator->fails()) {
            //     return Redirect::back()->withErrors($validator);
            // }
            // echo '<pre>';print_r($filterData);exit;
            $res = $admin->updateCarData($filterData);
            return Redirect::to('/admin/edit-car?id='.base64_encode($res));
        }else{
            $queries = [];
            parse_str($_SERVER['QUERY_STRING'], $queries);
            $input['id'] = base64_decode($queries['id']);
            $input['format'] = 'edit';
            $data['cars'] = $admin->getCars($input);
            $data['carFeatures'] = $this->getArray($admin->getCarFeatures($input),'id');
            $data['carSpecification'] = $admin->getCarSpecifications($input);

            $data['brands'] = $admin->getBrands();
            $data['features'] = $admin->getFeatures();
            $data['type'] = $admin->getCarType();
            // echo '<pre>';print_r($data);exit;
            return view('admin/edit-cars',$data);
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
                'active' => [''],
            ]);
            
            $filterData['active'] = isset($filterData['active']) ? 1 : 0;
            
            $data = $admin->saveEmiratesData($filterData);
            return Redirect::to('/admin/add-emirates');
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
            return Redirect::to('/admin/add-emirates');
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
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'specName' => ['required'],
                'specActive' => [''],
                'options' => [''],
                'image' => [''],
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
            // echo '<pre>';print_r($filterData);exit;
            if(!empty($_FILES['image']['name'])){
                $file = $request->file('image');
                $filterData['image'] = 'storage/'.$file->store('uploads/specifications', 'public');
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            
            $data = $admin->saveSpecData($filterData);
            return Redirect::to('/admin/add-specifications');
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
                'specActive' => [''],
                'options' => [''],
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
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            
            $data = $admin->updateSpecData($filterData);
            return Redirect::to('/admin/add-specifications');
        }
    }

    public function deleteSpec(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'id' => ['required'],
            ]);
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
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'brName' => ['required'],
                'brActive' => [''],
            ]);
            
            $filterData['brActive'] = isset($filterData['brActive']) ? 1 : 0;
            if(!empty($_FILES['brImage']['name'])){
                $file = $request->file('brImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            $data = $admin->saveBrandData($filterData);
            return Redirect::to('/admin/add-brand');
        }
    }

    public function updateBrand(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'brandId' => ['required'],
                'brandName' => ['required'],
                'brandActive' => [''],
            ]);
            
            $filterData['brandActive'] = isset($filterData['brandActive']) ? 1 : 0;
            if(!empty($_FILES['brandImage']['name'])){
                $file = $request->file('brandImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select brand image."]);
            }
            if(!empty($filterData['image'])){
                $data = $admin->getBrands(['id'=>$filterData['brandId']]);
                $filename = $data[0]->image;
                File::delete($filename);
            }
            $data = $admin->updateBrandData($filterData);
            return Redirect::to('/admin/add-brand');
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
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'tyName' => ['required'],
                'tyActive' => [''],
            ]);
            
            $filterData['tyActive'] = isset($filterData['tyActive']) ? 1 : 0;
            if(!empty($_FILES['tyImage']['name'])){
                $file = $request->file('tyImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select car type image."]);
            }
            $data = $admin->saveTypeData($filterData);
            return Redirect::to('/admin/add-type');
        }
    }

    public function updateType(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'typeId' => ['required'],
                'typeName' => ['required'],
                'typeActive' => [''],
            ]);
            
            $filterData['typeActive'] = isset($filterData['typeActive']) ? 1 : 0;
            if(!empty($_FILES['typeImage']['name'])){
                $file = $request->file('typeImage');
                $filterData['image'] = 'storage/'.$file->store('uploads', 'public');
            }else{
                return back()->withErrors(["error" => "Please select car type image."]);
            }
            if(!empty($filterData['image'])){
                $data = $admin->getCarType(['id'=>$filterData['typeId']]);
                $filename = $data[0]->image;
                File::delete($filename);
            }
            $data = $admin->updateTypedData($filterData);
            return Redirect::to('/admin/add-type');
        }
    }
    /**Car type Related proceses End*/

    /**General information about car Start */
    public function generalInfo(){
        $admin = new Admin();
        $data['content'] = $admin->getGeneralInfo();
        // print_r($data);exit;
        return view('admin/general-info',$data);
    }

    public function saveGeneralInfo(Request $request){
        $admin = new Admin();
        $res = [];
        if($request->method() == 'POST'){
            $filterData = $request->validate([
                'content' => ['required'],
            ]);
            $data = $admin->saveGeneralInfoData($filterData);
            if($data > 0){
                $res['status'] = 200;
                $res['data'] = "Saved content successfully.";
            }else{
                $res['status'] = 200;
                $res['data'] = "Something went wrong.";
            }
            return json_encode($res);
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
                'active' => [''],
            ]);
            $filterData['active'] = ($filterData['active']=='true') ? 1 : 0;
            $data = $admin->updatePolicyAgreementData($filterData);
            return json_encode($data);
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
    /**Policies and agreements of car End */
}
