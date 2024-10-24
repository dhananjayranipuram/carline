<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public function getUserExist($data){
        return DB::select("SELECT COUNT(*) cnt,id FROM enduser WHERE email='$data[email]' OR phone='$data[phone]';");
    }

    public function saveOtp($data){
        // DB::UPDATE("UPDATE enduser SET update_token='$data[token]' WHERE email='$data[emailAddress]';");
        return DB::INSERT("INSERT INTO otp (otp) VALUES ('$data[otp]');");
    }

    public function getBrands(){
        return DB::select("SELECT cb.id,cb.name,cb.image FROM car_brand cb 
                            WHERE cb.deleted=0 AND cb.active=1
                            ORDER BY cb.name;");
    }

    public function getCars($data=[]){
        switch ($data['format']) {
            case 'filter':
                $condition = '';
                if(!empty($data['type'])){
                    $condition .= " AND ct.id IN(".implode(',', $data['type']).")";
                }
                if(!empty($data['brand'])){
                    $condition .= " AND cb.id IN(".implode(',', $data['brand']).")";
                }
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    WHERE c.active=1 AND c.deleted=0 $condition GROUP BY c.id;");
                break;
            case 'offer':
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    WHERE c.active=1 AND c.deleted=0 AND c.offer_flag=1 GROUP BY c.id;");
                break;
            default:
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND c.id = $data[id]";
                }
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price FROM cars c
                                LEFT JOIN car_brand cb ON cb.id=c.brand_id
                                LEFT JOIN car_type ct ON ct.id=c.type_id
                                LEFT JOIN car_images ci ON ci.car_id=c.id
                                WHERE c.active=1 AND c.deleted=0 $condition GROUP BY c.id;");
                break;
        }
    }

    public function getCarFeatures($data=[]){
        return DB::select("SELECT f.feature FROM car_features cf
                            LEFT JOIN features f ON f.id=cf.feature_id
                            WHERE cf.car_id='$data[id]';");
    }

    public function getCarSpecifications($data=[]){
        switch ($data['format']) {
            case 'filter':
                // $condition = '';
                // if(!empty($data['type'])){
                //     $condition .= " AND ct.id IN(".implode(',', $data['type']).")";
                // }
                // if(!empty($data['brand'])){
                //     $condition .= " AND cb.id IN(".implode(',', $data['brand']).")";
                // }
                // return DB::select("SELECT cs.car_id,s.name,cs.details,s.image FROM cars c
                //                     LEFT JOIN car_specification cs ON cs.car_id=c.id
                //                     LEFT JOIN specification s ON cs.spec_id = s.id
                //                     LEFT JOIN car_brand cb ON cb.id=c.brand_id
                //                     LEFT JOIN car_type ct ON ct.id=c.type_id
                //                     WHERE s.deleted=0 $condition;");
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                }
                return DB::select("SELECT cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
            
            default:
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                }
                return DB::select("SELECT cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
        }
    }

    public function getCarType(){
        return DB::select("SELECT ct.id,ct.name,ct.image FROM car_type ct
                            WHERE ct.active=1 AND ct.deleted=0 LIMIT 4;");
    }

    public function getCarGeneralInfo(){
        return DB::select("SELECT content FROM general_informations WHERE active=1;");
    }

    public function getPolicyAgreement($data=[]){
        return DB::select("SELECT pa.id,pa.name,pa.content FROM policy_agreement pa 
                            WHERE pa.deleted=0 AND pa.active=1
                            ORDER BY pa.name ASC;");
    }

    public function verifyOtp($data){
        $res = DB::select("SELECT otp FROM otp WHERE status = '0' AND otp=$data[otp] AND created_on > NOW() - INTERVAL 15 MINUTE ;");
        DB::UPDATE("UPDATE otp SET status='1' WHERE otp='$data[otp]';");
        return $res;
    }

    public function registerUserData($data){
        $res = DB::select("SELECT id FROM enduser WHERE email='$data[email]';");
        if(!isset($res[0])){
            DB::INSERT("INSERT INTO enduser (first_name,last_name,email,password,phone,flat,building,landmark,city,emirates) VALUES ('$data[firstName]','$data[lastName]','$data[email]','$data[password]','$data[phone]','$data[flat]','$data[building]','$data[landmark]','$data[city]','$data[emirates]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return $res[0]->id;
        }
    }

    public function getEmirates($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND e.id = $data[id]";
        }
        return DB::select("SELECT e.id,e.name,e.rate FROM emirates e
                            WHERE e.deleted=0 AND e.active=1 ORDER BY e.name;");
    }
}
