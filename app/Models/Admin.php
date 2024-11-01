<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function authenticateAdmin($data){
        return DB::select("SELECT id,first_name,last_name FROM admin_user WHERE email='$data[email]' AND password='$data[password]';");
    }

    public function getCars($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND c.id = $data[id]";
        }
        return DB::select("SELECT c.id,c.name,c.model,cb.id brand_id,cb.name brand_name,ct.id type_id,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',c.rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,c.offer_price,c.deposit FROM cars c
                            LEFT JOIN car_brand cb ON cb.id=c.brand_id
                            LEFT JOIN car_type ct ON ct.id=c.type_id
                            LEFT JOIN car_images ci ON ci.car_id=c.id
                            WHERE c.deleted=0 $condition GROUP BY c.id;");
    }

    public function getCarFeatures($data=[]){
        return DB::select("SELECT f.id,f.feature FROM car_features cf
                            LEFT JOIN features f ON f.id=cf.feature_id
                            WHERE cf.car_id='$data[id]';");
    }

    public function getCarSpecifications($data=[]){
        switch ($data['format']) {
            case 'filter':
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                }
                return DB::select("SELECT s.id,cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
            case 'edit':
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                }
                return DB::select("SELECT s.id,s.name,s.options,cs.details FROM specification s
                                    LEFT JOIN car_specification cs ON s.id=cs.spec_id $condition
                                    WHERE s.deleted=0 ORDER BY s.name;");
                break;
            
            default:
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                }
                return DB::select("SELECT s.id,cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
        }
    }

    public function saveCarData($data=[]){
        DB::beginTransaction();
        try {
            DB::INSERT("INSERT INTO cars (name,model,brand_id,type_id,general_info_flag,rental_condition_flag,rent) VALUES ('$data[name]','$data[model]','$data[brand]','$data[cartype]','$data[general_info]','$data[rental_condition]','$data[rent]');");
            $carId = DB::getPdo()->lastInsertId();

            //Insert Car Specifications
            foreach ($data['specifications'] as $key => $value) {
                $x = explode('~',$value);
                if(sizeof($x)>0){
                    DB::INSERT("INSERT INTO car_specification (car_id,spec_id,details) VALUES ('$carId','$x[0]','$x[1]');");
                }
            }

            //Insert Car features
            foreach ($data['features'] as $key => $value) {
                if($value!=""){
                    DB::INSERT("INSERT INTO car_features (car_id,feature_id) VALUES ('$carId','$value');");
                }
            }

            //Insert Car images
            foreach ($data['carImages'] as $key => $value) {
                if($value!=""){
                    DB::INSERT("INSERT INTO car_images (car_id,image) VALUES ('$carId','$value');");
                }
            }
            DB::commit();
            return $carId;
        } catch (\Exception $e) {
            return DB::rollback();
        }
    }

    public function updateCarData($data=[]){
        DB::beginTransaction();
        try {
            $carId = $data['carId'];
            DB::UPDATE("UPDATE cars SET name='$data[name]',model='$data[model]',brand_id='$data[brand]',type_id='$data[cartype]',general_info_flag='$data[general_info]',rental_condition_flag='$data[rental_condition]',rent='$data[rent]',offer_price='$data[specialOffer]',offer_flag='$data[offerFlag]',deposit='$data[deposit]' WHERE id=$carId;");

            //Update Car Specifications
            DB::DELETE("DELETE FROM car_specification WHERE car_id='$carId';");
            foreach ($data['specifications'] as $key => $value) {
                $x = explode('~',$value);
                if(sizeof($x)>0){
                    DB::INSERT("INSERT INTO car_specification (car_id,spec_id,details) VALUES ('$carId','$x[0]','$x[1]');");
                }
            }

            //Update Car features
            DB::DELETE("DELETE FROM car_features WHERE car_id='$carId';");
            foreach ($data['features'] as $key => $value) {
                if($value!=""){
                    DB::INSERT("INSERT INTO car_features (car_id,feature_id) VALUES ('$carId','$value');");
                }
            }

            //Insert Car images
            foreach ($data['carImages'] as $key => $value) {
                if($value!=""){
                    DB::INSERT("INSERT INTO car_images (car_id,image) VALUES ('$carId','$value');");
                }
            }
            DB::commit();
            return $carId;
        } catch (\Exception $e) {
            // echo '<pre>';print_r($e);exit;
            return DB::rollback();
        }
    }

    public function getBrands($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND cb.id = $data[id]";
        }
        return DB::select("SELECT cb.id,cb.name,cb.image,CASE WHEN cb.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM car_brand cb 
                            WHERE cb.deleted=0 $condition 
                            ORDER BY cb.name ASC;");
    }

    public function getCarType($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND ct.id = $data[id]";
        }
        return DB::select("SELECT ct.id,ct.name,ct.image,CASE WHEN ct.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM car_type ct
                            WHERE ct.active=1 $condition ORDER BY ct.name;");
    }

    public function getFeatures($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND f.id = $data[id]";
        }
        return DB::select("SELECT f.id,f.feature,CASE WHEN f.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM features f
                            WHERE f.active=1 AND f.deleted=0 $condition ORDER BY f.feature ASC;");
    }

    public function getSpecifications($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND s.id = $data[id]";
        }
        return DB::select("SELECT s.id,s.name,CASE WHEN s.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status',s.options FROM specification s
                            WHERE s.active=1 AND s.deleted=0 $condition ORDER BY s.name;");
    }

    public function saveFeatureData($data){
        $res = DB::select("SELECT id FROM features WHERE feature LIKE '%$data[name]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO features (feature) VALUES ('$data[name]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function deleteFeatureData($data){
        return DB::UPDATE("UPDATE features SET deleted='1' WHERE id='$data[id]';");
    }

    public function deleteBrandData($data){
        return DB::UPDATE("UPDATE car_brand SET deleted='1' WHERE id='$data[id]';");
    }

    public function updateBrandData($data){
        return DB::UPDATE("UPDATE car_brand SET name='$data[brandName]',image='$data[image]',active='$data[brandActive]' WHERE id='$data[brandId]';");
    }

    public function saveBrandData($data){
        $res = DB::select("SELECT id FROM car_brand WHERE name LIKE '%$data[brName]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO car_brand (name,image,active) VALUES ('$data[brName]','$data[image]','$data[brActive]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function saveTypeData($data){
        $res = DB::select("SELECT id FROM car_type WHERE name LIKE '%$data[tyName]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO car_type (name,image,active) VALUES ('$data[tyName]','$data[image]','$data[tyActive]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updateTypedData($data){
        return DB::UPDATE("UPDATE car_type SET name='$data[typeName]',image='$data[image]',active='$data[typeActive]' WHERE id='$data[typeId]';");
    }

    public function saveSpecData($data){
        $res = DB::select("SELECT id FROM specification WHERE name LIKE '%$data[specName]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO specification (name,options,active,image) VALUES ('$data[specName]','$data[options]','$data[specActive]','$data[image]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updateSpecData($data){
        return DB::UPDATE("UPDATE specification SET name='$data[specName]',options='$data[options]',active='$data[specActive]',image='$data[image]' WHERE id='$data[specId]';");
    }

    public function deleteSpecData($data){
        return DB::UPDATE("UPDATE specification SET deleted='1' WHERE id='$data[id]';");
    }

    public function getGeneralInfo($data=[]){
        return DB::select("SELECT content FROM general_informations WHERE active=1;");
    }

    public function saveGeneralInfoData($data){
        return DB::UPDATE("UPDATE general_informations SET content='$data[content]' WHERE active='1';");
        
    }

    public function getPolicyAgreement($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND pa.id = $data[id]";
        }
        return DB::select("SELECT pa.id,pa.name,pa.content,CASE WHEN pa.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM policy_agreement pa 
                            WHERE pa.deleted=0 $condition 
                            ORDER BY pa.name ASC;");
    }

    public function savePolicyAgreementData($data){
        $res = DB::select("SELECT id FROM policy_agreement WHERE name LIKE '%$data[name]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO policy_agreement (name,content,active) VALUES ('$data[name]','$data[content]','$data[active]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updatePolicyAgreementData($data){
        return DB::UPDATE("UPDATE policy_agreement SET name='$data[name]',content='$data[content]',active='$data[active]' WHERE id='$data[id]';");
    }

    public function deletePolicyAgreementData($data){
        return DB::UPDATE("UPDATE policy_agreement SET deleted='1' WHERE id='$data[id]';");
    }

    public function getEmirates($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND e.id = $data[id]";
        }
        return DB::select("SELECT e.id,e.name,e.rate,CASE WHEN e.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM emirates e
                            WHERE e.deleted=0 $condition ORDER BY e.name;");
    }

    public function saveEmiratesData($data){
        $res = DB::select("SELECT id FROM emirates WHERE name LIKE '%$data[name]%';");
        if(empty($res)){
            DB::INSERT("INSERT INTO emirates (name,rate,active) VALUES ('$data[name]','$data[rate]','$data[active]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updateEmiratesData($data){
        return DB::UPDATE("UPDATE emirates SET name='$data[emName]',rate='$data[emRate]',active='$data[emActive]' WHERE id='$data[emId]';");
    }
}
