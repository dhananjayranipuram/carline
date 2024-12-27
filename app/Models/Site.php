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

        if(!isset($data['sortBy'])){
            $data['sortBy'] = 'asc';
        } 
        switch ($data['format']) {
            case 'filter':
                $condition = '';
                $transJoin = '';
                $seatJoin = '';
                if(!empty($data['type'])){
                    $condition .= " AND ct.id IN(".implode(',', $data['type']).")";
                }
                if(!empty($data['brand'])){
                    $condition .= " AND cb.id IN(".implode(',', $data['brand']).")";
                }
                if(!empty($data['carTransmission'])){
                    $str = '';
                    foreach ($data['carTransmission'] as $key => $value) {
                        $str .= "'".$value."',";
                    }
                    $condition .= " AND cst.details IN(".rtrim($str,',').")";
                    $transJoin = "AND cst.spec_id=$data[transId]";
                }
                if(!empty($data['carSeats'])){
                    $condition .= " AND css.details IN(".implode(',', $data['carSeats']).")";
                    $seatJoin = "AND css.spec_id=$data[seatId]";
                }

                if(!empty($data['searchText'])){
                    $condition .= " AND CONCAT(c.name,cb.name) LIKE '%$data[searchText]%' ";
                }
                
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price,FORMAT(c.deposit,0) deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    LEFT JOIN car_specification cst ON cst.car_id = c.id $transJoin
                    LEFT JOIN car_specification css ON css.car_id = c.id $seatJoin
                    WHERE c.active=1 AND c.deleted=0 $condition GROUP BY c.id ORDER BY c.rent $data[sortBy];");
                break;
            case 'offer':
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price,FORMAT(c.deposit,0) deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    WHERE c.active=1 AND c.deleted=0 AND c.offer_flag=1 GROUP BY c.id ORDER BY c.rent $data[sortBy];");
                break;
            default:
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND c.id = $data[id]";
                }
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(COALESCE(c.rent, 0), 0) AS rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(COALESCE(c.offer_price, 0), 0) AS offer_price,FORMAT(COALESCE(c.deposit, 0), 0) AS deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                                LEFT JOIN car_brand cb ON cb.id=c.brand_id
                                LEFT JOIN car_type ct ON ct.id=c.type_id
                                LEFT JOIN car_images ci ON ci.car_id=c.id
                                WHERE c.active=1 AND c.deleted=0 $condition GROUP BY c.id ORDER BY c.rent $data[sortBy];");
                break;
        }
    }
    
    public function getOfferCars($data=[]){

        if(!isset($data['sortBy'])){
            $data['sortBy'] = 'asc';
        } 
        switch ($data['format']) {
            case 'filter':
                $condition = '';
                $transJoin = '';
                $seatJoin = '';
                if(!empty($data['type'])){
                    $condition .= " AND ct.id IN(".implode(',', $data['type']).")";
                }
                if(!empty($data['brand'])){
                    $condition .= " AND cb.id IN(".implode(',', $data['brand']).")";
                }
                if(!empty($data['carTransmission'])){
                    $str = '';
                    foreach ($data['carTransmission'] as $key => $value) {
                        $str .= "'".$value."',";
                    }
                    $condition .= " AND cst.details IN(".rtrim($str,',').")";
                    $transJoin = "AND cst.spec_id=$data[transId]";
                }
                if(!empty($data['carSeats'])){
                    $condition .= " AND css.details IN(".implode(',', $data['carSeats']).")";
                    $seatJoin = "AND css.spec_id=$data[seatId]";
                }

                if(!empty($data['searchText'])){
                    $condition .= " AND CONCAT(c.name,cb.name) LIKE '%$data[searchText]%' ";
                }
                
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price,FORMAT(c.deposit,0) deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    LEFT JOIN car_specification cst ON cst.car_id = c.id $transJoin
                    LEFT JOIN car_specification css ON css.car_id = c.id $seatJoin
                    WHERE c.active=1 AND c.deleted=0 AND c.offer_flag=1 $condition GROUP BY c.id ORDER BY c.offer_price $data[sortBy];");
                break;
            case 'offer':
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price,FORMAT(c.deposit,0) deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                    LEFT JOIN car_brand cb ON cb.id=c.brand_id
                    LEFT JOIN car_type ct ON ct.id=c.type_id
                    LEFT JOIN car_images ci ON ci.car_id=c.id
                    WHERE c.active=1 AND c.deleted=0 AND c.offer_flag=1 GROUP BY c.id ORDER BY c.offer_price $data[sortBy];");
                break;
            default:
                $condition = '';
                if(!empty($data['id'])){
                    $condition .= " AND c.id = $data[id]";
                }
                return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(COALESCE(c.rent, 0), 0) AS rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(COALESCE(c.offer_price, 0), 0) AS offer_price,FORMAT(COALESCE(c.deposit, 0), 0) AS deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                                LEFT JOIN car_brand cb ON cb.id=c.brand_id
                                LEFT JOIN car_type ct ON ct.id=c.type_id
                                LEFT JOIN car_images ci ON ci.car_id=c.id
                                WHERE c.active=1 AND c.deleted=0 AND c.offer_flag=1 $condition GROUP BY c.id ORDER BY c.offer_price $data[sortBy];");
                break;
        }
    }

    public function getCarsRate($data=[]){
        
        return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',FORMAT(c.rent,0) rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,FORMAT(c.offer_price,0) offer_price,FORMAT(c.deposit,0) deposit,c.kmeter,COALESCE(c.daily_mileage, 0) AS daily_mileage,FORMAT(COALESCE(c.per_week, 0), 0) AS per_week,COALESCE(c.weekly_mileage, 0) AS weekly_mileage,FORMAT(COALESCE(c.per_month, 0), 0) AS per_month,COALESCE(c.monthly_mileage, 0) AS monthly_mileage,FORMAT(COALESCE(c.toll_charges, 0), 0) AS toll_charges,FORMAT(COALESCE(c.add_mileage_charge, 0), 0) AS add_mileage_charge,c.offer_flag_weekly,FORMAT(COALESCE(c.offer_price_weekly, 0), 0) AS offer_price_weekly,c.offer_flag_monthly,FORMAT(COALESCE(c.offer_price_monthly, 0), 0) AS offer_price_monthly FROM cars c
                        LEFT JOIN car_brand cb ON cb.id=c.brand_id
                        LEFT JOIN car_type ct ON ct.id=c.type_id
                        LEFT JOIN car_images ci ON ci.car_id=c.id
                        WHERE c.active=1 AND c.deleted=0 AND c.id = $data[carId] GROUP BY c.id;");
            
    }

    public function getCarFeatures($data=[]){
        return DB::select("SELECT f.feature FROM car_features cf
                            LEFT JOIN features f ON f.id=cf.feature_id
                            WHERE cf.car_id='$data[id]';");
    }

    public function getAllSpecifications($data=[]){
        return DB::select("SELECT s.id,s.name,CASE WHEN s.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status',s.options FROM specification s
                            WHERE s.active=1 AND s.deleted=0 ORDER BY s.name;");
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
                $union = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                    // $union = "SELECT id,'Kilometers Driven' AS 'name',kmeter AS details,'assets/images/icon-fleets-benefits-1.svg' image FROM cars WHERE id=$data[id] UNION ";
                }
                return DB::select("$union SELECT cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
            
            default:
                $condition = '';
                $union = '';
                if(!empty($data['id'])){
                    $condition .= " AND cs.car_id = $data[id]";
                    // $union = "SELECT id,'Kilometers Driven' AS 'name',kmeter AS details,'assets/images/icon-fleets-benefits-1.svg' image FROM cars WHERE id=$data[id] UNION ";
                }
                return DB::select("$union SELECT cs.car_id,s.name,cs.details,s.image FROM car_specification cs
                                    LEFT JOIN specification s ON cs.spec_id = s.id
                                    WHERE s.deleted=0 $condition;");
                break;
        }
    }

    public function getCarType(){
        return DB::select("SELECT ct.id,ct.name,ct.image FROM car_type ct
                            WHERE ct.active=1 AND ct.deleted=0;");
    }
    
    public function getCountry(){
        $countries = DB::select("SELECT id, name FROM country;");
    
        // Convert the result to an associative array
        $countryArray = [];
        foreach ($countries as $country) {
            $countryArray[$country->id] = $country->name;
        }

        return $countryArray;
        
    }

    public function getCarGeneralInfo(){
        return DB::select("SELECT mst.id,mst.heading,mst.content,GROUP_CONCAT(det.options SEPARATOR '~') 'options'
                FROM general_informations mst
                LEFT JOIN general_informations_det det ON mst.id=det.gi_id
                WHERE active=1 GROUP BY mst.id;");
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
        $res = DB::select("SELECT id FROM enduser WHERE email='$data[email]' AND deleted=0;");
        if(!isset($res[0])){
            DB::INSERT("INSERT INTO enduser (first_name,last_name,email,password,phone,flat,building,landmark,city,country) VALUES ('$data[firstName]','$data[lastName]','$data[email]','$data[password]','$data[phone]','$data[flat]','$data[building]','$data[landmark]','$data[city]','$data[country]');");
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
        if(!empty($data['destinationEmirate'])){
            $condition .= " AND e.name LIKE '%$data[destinationEmirate]%'";
        }
        return DB::select("SELECT e.id,e.name,e.rate FROM emirates e
                            WHERE e.deleted=0 AND e.active=1 $condition ORDER BY e.name;");
    }

    public function getEmiratesForRate($data){
        $condition = '';
        if(!empty($data['destinationEmirate'])){
            $condition .= " AND e.name LIKE '%$data[destinationEmirate]%'";
        }
        
        return DB::select("SELECT e.id,e.name,e.rate FROM emirates e
                            WHERE e.deleted=0 AND e.active=1 $condition ORDER BY e.name;");
    }
    
    public function getCarlineEmiratesForRate($data){
        
        return DB::select("SELECT office_charge AS rate FROM additional_settings WHERE id=1;");
    }

    public function login($data){
        return DB::select("SELECT id,first_name,last_name,email,phone,flat,building,landmark,city,emirates FROM enduser WHERE email='$data[username]' AND password='$data[password]' AND active=1 AND deleted=0;");
    }

    public function saveBookingData($data){
        
        $temp = [
            's_address'=> $data['sourceData']['Address'],
            's_emirates'=>$data['sourceData']['Emirates'],
            's_latitude'=>$data['sourceData']['Latitude'],
            's_longitude'=>$data['sourceData']['Longitude'],
            'd_address'=>$data['destinationData']['Address'],
            'd_emirates'=>$data['destinationData']['Emirates'],
            'd_latitude'=>$data['destinationData']['Latitude'],
            'd_longitude'=>$data['destinationData']['Longitude'],
        ];
        DB::INSERT("INSERT INTO booking (car_id,user_id,pickup_date,return_date,pickup_time,return_time,rate) VALUES ('$data[carId]','$data[userId]','$data[pickupdate]','$data[returndate]','$data[pickuptime]','$data[returntime]','$data[rate]');");
        $bookingId = DB::getPdo()->lastInsertId();
        DB::INSERT("INSERT INTO booking_details (booking_id,s_address,s_emirates,s_lat,s_lon,d_address,d_emirates,d_lat,d_lon) VALUES ('$bookingId','$temp[s_address]','$temp[s_emirates]','$temp[s_latitude]','$temp[s_longitude]','$temp[d_address]','$temp[d_emirates]','$temp[d_latitude]','$temp[d_longitude]');");
        return $bookingId;
    }

    public function getMyDetails($data=[]){
        return DB::select("SELECT eu.id,eu.first_name,eu.last_name,eu.email,eu.phone,eu.flat,eu.building,eu.landmark,eu.city,e.name emirates,eu.country,eu.emirates emirateid 
            FROM enduser eu
            LEFT JOIN emirates e ON eu.emirates=e.id
            WHERE eu.id='$data[id]' AND eu.active=1;");
    }
    
    public function getMyDocumentDetails($data=[]){
        return DB::select("SELECT eu.id,ud.pass_front,ud.pass_back,ud.dl_front,ud.dl_back,ud.eid_front,ud.eid_back,ud.cdl_front,ud.cdl_back,eu.user_type
            FROM enduser eu
            LEFT JOIN user_documents ud ON eu.id=ud.user_id
            WHERE eu.id='$data[id]' AND eu.active=1;");
    }

    public function getDocumentUpload($data=[]){
        return DB::table('enduser')
                        ->select('passf_flag','passb_flag','dlf_flag','dlb_flag','eidf_flag','eidb_flag','user_type')
                        ->where('id', $data['id'])
                        ->where('active', 1)
                        ->first();
    }

    public function saveUploadedDocuments($data = [],$rider_type)
    {
        DB::beginTransaction();
        try {
            // Insert document records
            DB::table('user_documents')->insert([
                'user_id' => $data['id'],
                'pass_front' => $data['uploadedFiles']['pass_front'] ?? '',
                'pass_back' => $data['uploadedFiles']['pass_back'] ?? '',
                'dl_front' => $data['uploadedFiles']['dl_front'] ?? '',
                'dl_back' => $data['uploadedFiles']['dl_back'] ?? '',
                'eid_front' => $data['uploadedFiles']['eid_front'] ?? '',
                'eid_back' => $data['uploadedFiles']['eid_back'] ?? '',
                'cdl_front' => $data['uploadedFiles']['cdl_front'] ?? '',
                'cdl_back' => $data['uploadedFiles']['cdl_back'] ?? '',
            ]);

            // Update user record to mark documents as uploaded
            $flags = [];
            if (isset($data['uploadedFiles']['pass_front'])) {
                $flags['passf_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['pass_back'])) {
                $flags['passb_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['dl_front'])) {
                $flags['dlf_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['dl_back'])) {
                $flags['dlb_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['eid_front'])) {
                $flags['eidf_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['eid_back'])) {
                $flags['eidb_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['cdl_front'])) {
                $flags['cdlf_flag'] = '1';
            }
            if (isset($data['uploadedFiles']['cdl_back'])) {
                $flags['cdlb_flag'] = '1';
            }

            $flags['user_type'] = ($rider_type == 'resident') ? 'R' : 'T';

            DB::table('enduser')->where('id', $data['id'])->update($flags);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false; // Return false on failure
        }
    }
    
    
    public function updateUploadedDocuments($data = [])
    {
        // Validate if 'uploadedFiles' is provided and is an array
        if (!isset($data['uploadedFiles']) || !is_array($data['uploadedFiles'])) {
            return false;
        }

        // Validate if 'id' is provided
        if (!isset($data['id']) || empty($data['id'])) {
            return false;
        }

        // Define mappings for uploaded files to database columns
        $fieldMapping = [
            'edit_pass_front' => 'pass_front',
            'edit_pass_back'  => 'pass_back',
            'edit_dl_front'   => 'dl_front',
            'edit_dl_back'    => 'dl_back',
            'edit_eid_front'  => 'eid_front',
            'edit_eid_back'   => 'eid_back',
            'edit_cdl_front'   => 'cdl_front',
            'edit_cdl_back'   => 'cdl_back',
        ];

        $flagMapping = [
            'edit_pass_front' => 'passf_flag',
            'edit_pass_back'  => 'passb_flag',
            'edit_dl_front'   => 'dlf_flag',
            'edit_dl_back'    => 'dlb_flag',
            'edit_eid_front'  => 'eidf_flag',
            'edit_eid_back'   => 'eidb_flag',
            'edit_cdl_front'   => 'cdlf_flag',
            'edit_cdl_back'   => 'cdlb_flag',
        ];

        // Map input data for updates
        $documentUpdates = [];
        $flagUpdates = [];

        foreach ($data['uploadedFiles'] as $key => $value) {
            if (!is_null($value) && $value !== '' && isset($fieldMapping[$key])) {
                $documentUpdates[$fieldMapping[$key]] = $value; // Update document columns
                $flagUpdates[$flagMapping[$key]] = 1;          // Set corresponding flag to 1
            }
        }

        // Check if there's anything to update
        if (empty($documentUpdates)) {
            return false;
        }

        try {
            DB::beginTransaction();

            // Update the user_documents table
            DB::table('user_documents')
                ->where('user_id', $data['id'])
                ->update($documentUpdates);

            // Update the flags in the enduser table
            DB::table('enduser')
                ->where('id', $data['id'])
                ->update($flagUpdates);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false; // Handle error
        }
    }

    public function updateMissingUploadedDocuments($data = [])
    {
        // Ensure uploadedFiles key exists and is an array
        if (!isset($data['uploadedFiles']) || !is_array($data['uploadedFiles'])) {
            return false; // Or handle the error as needed
        }

        // Define the mapping of input keys to database column names
        $fieldMapping = [
            'pass_front' => 'pass_front', 
            'pass_back' => 'pass_back', 
            'dl_front' => 'dl_front', 
            'dl_back' => 'dl_back', 
            'eid_front' => 'eid_front', 
            'eid_back' => 'eid_back',
            'cdl_front' => 'cdl_front',
            'cdl_back' => 'cdl_back',
        ];

        // Map input data to database columns and filter out null/empty values
        $updateData = [];
        foreach ($data['uploadedFiles'] as $key => $value) {
            if (!is_null($value) && $value !== '' && isset($fieldMapping[$key])) {
                $updateData[$fieldMapping[$key]] = $value;
            }
        }

        // Proceed only if there's data to update
        if (empty($updateData)) {
            return false; // Or handle the case when there's nothing to update
        }

        // Perform the update query
        return DB::table('user_documents')
            ->where('user_id', $data['id']) // Ensure ID is provided
            ->update($updateData);
    }

    public function getBookingHistory($data = [])
    {
        $userId = $data['id'];

        return \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_images as ci', 'ci.car_id', '=', 'c.id')
            ->where('b.user_id', $userId)
            ->groupBy('b.id')
            ->select([
                'b.id',
                \DB::raw("DATE_FORMAT(b.pickup_date, '%Y-%m-%d') as pickup_date"),
                \DB::raw("DATE_FORMAT(b.return_date, '%Y-%m-%d') as return_date"),
                \DB::raw("DATE_FORMAT(b.pickup_time, '%h:%i %p') as pickup_time"),
                \DB::raw("DATE_FORMAT(b.return_time, '%h:%i %p') as return_time"),
                'b.rate',
                \DB::raw("LEFT(bd.s_address, LOCATE(',', bd.s_address) - 1) as source"),
                'bd.s_address',
                \DB::raw("LEFT(bd.d_address, LOCATE(',', bd.d_address) - 1) as destination"),
                'bd.d_address',
                \DB::raw("CONCAT(cb.name, ' ', c.name, ' ', c.model) as car_name"),
                'ci.image AS image'
                // \DB::raw("LEFT(GROUP_CONCAT(ci.image), LOCATE(',', GROUP_CONCAT(ci.image)) - 1) as image")
            ])->get();
    }

    

    public function updateUserData($data = [])
    {
        // $userId = $data['id'];
        return DB::table('enduser')
                ->where('id', $data['id'])
                ->update([
                    'first_name' => $data['firstName'],
                    'last_name' => $data['lastName'],
                    'phone' => $data['phone'],
                    'flat' => $data['flat'],
                    'building' => $data['building'],
                    'landmark' => $data['landmark'],
                    'city' => $data['city'],
                    'emirates' => $data['emirates'],
                    'country' => $data['country'],
                ]);
    }

    public function getTimeAvailable($data=[]){
        switch ($data['type']) {
            case 'pickup':
                return DB::select("SELECT pickup_time,'' return_time FROM booking WHERE car_id=$data[carId] AND pickup_date='$data[pickupdate]'
                                    UNION
                                    SELECT '' pickup_time,return_time FROM booking WHERE car_id=$data[carId] AND return_date='$data[pickupdate]';");
                break;

            case 'dropoff':
                return DB::select("SELECT '' pickup_time,return_time FROM booking WHERE car_id=$data[carId] AND return_date='$data[returndate]'
                                    UNION
                                    SELECT pickup_time,'' return_time FROM booking WHERE car_id=$data[carId] AND return_date='$data[returndate]';");
                break;
            
            default:
                return DB::select("SELECT * 
                                    FROM booking
                                    WHERE car_id=$data[carId] AND ((pickup_date BETWEEN '$data[pickupdate]' AND '$data[returndate]')
                                    OR (return_date BETWEEN '$data[pickupdate]' AND '$data[returndate]'));");
                break;
        }
        
    }

    public function checkCarBooking($data=[]){
        switch ($data['type']) {
            case 'date':
                /*return DB::select("SELECT count(*) cnt
                    FROM booking
                    WHERE car_id=$data[carId] AND ((STR_TO_DATE(pickup_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('$data[pickupdate]', '%Y-%m-%d') AND STR_TO_DATE('$data[returndate]', '%Y-%m-%d'))
                    OR (STR_TO_DATE(return_date, '%Y-%m-%d %H:%i:%s') BETWEEN STR_TO_DATE('$data[pickupdate]', '%Y-%m-%d') AND STR_TO_DATE('$data[returndate]', '%Y-%m-%d'))) GROUP BY car_id;");*/
                return DB::select("SELECT count(*) cnt 
                            FROM booking
                            WHERE car_id = 1
                            AND (
                                (pickup_date BETWEEN '$data[pickupdate]' AND '$data[returndate]')
                                OR (return_date BETWEEN '$data[pickupdate]' AND '$data[returndate]')
                                OR (pickup_date <= '$data[pickupdate]' AND return_date >= '$data[returndate]')
                            );");
                    
                
                break;

            default:
                return DB::select("SELECT count(*) cnt
                    FROM booking
                    WHERE car_id=$data[carId] AND ((STR_TO_DATE(CONCAT(pickup_date, ' ', pickup_time), '%Y-%m-%d %H:%i:%s') BETWEEN STR_TO_DATE('$data[pickupdate] $data[pickuptime]', '%Y-%m-%d %h:%i %p') AND STR_TO_DATE('$data[returndate] $data[returntime]', '%Y-%m-%d %h:%i %p'))
                    OR (STR_TO_DATE(CONCAT(return_date, ' ', return_time), '%Y-%m-%d %H:%i:%s') BETWEEN STR_TO_DATE('$data[pickupdate] $data[pickuptime]', '%Y-%m-%d %h:%i %p') AND STR_TO_DATE('$data[returndate] $data[returntime]', '%Y-%m-%d %h:%i %p'))) GROUP BY car_id;");
                break;
        }
        
    }
    
    public function getCarQty($data=[]){
        return DB::table('cars')
                ->where('id', $data['carId'])->pluck('qty')->first();
        
    }
}
