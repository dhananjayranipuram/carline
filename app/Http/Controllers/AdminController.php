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

    public function addCar(){
        $admin = new Admin();
        $data['brands'] = $admin->getBrands();
        $data['features'] = $admin->getFeatures();
        $data['type'] = $admin->getCarType();
        $data['specification'] = $admin->getSpecifications();
        return view('admin/add-cars',$data);
    }
}
