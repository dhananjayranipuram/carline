<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function authenticateAdmin($data){
        return DB::select("SELECT id,first_name,last_name,email FROM admin_user WHERE email='$data[email]' AND password='$data[password]';");
    }

    public function getCars($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND c.id = $data[id]";
        }
        return DB::select("SELECT c.id,c.name,c.model,cb.id brand_id,cb.name brand_name,ct.id type_id,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',c.rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,c.offer_price,c.deposit,c.qty,c.kmeter,c.daily_mileage,c.weekly_mileage,c.monthly_mileage,c.toll_charges,c.add_mileage_charge,c.per_week,c.offer_flag_weekly,c.offer_price_weekly,c.per_month,c.offer_flag_monthly,c.offer_price_monthly,c.online_flag,c.whatsapp_flag,c.fuel_type FROM cars c
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

    public function saveCarData($data = [])
    {
        DB::beginTransaction();

        try {
            // Insert into cars table
            DB::insert(
                "INSERT INTO cars (name, model, brand_id, type_id, general_info_flag, rental_condition_flag, rent, deposit, offer_flag, offer_price,qty,kmeter,daily_mileage,per_week,weekly_mileage,offer_flag_weekly,offer_price_weekly,per_month,monthly_mileage,offer_flag_monthly,offer_price_monthly,toll_charges,add_mileage_charge,online_flag,whatsapp_flag,fuel_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                [
                    $data['name'],
                    $data['model'],
                    $data['brand'],
                    $data['cartype'],
                    $data['general_info'],
                    $data['rental_condition'],
                    $data['rent'],
                    $data['deposit'],
                    $data['offerFlag'],
                    $data['specialOffer'] ?? null,
                    $data['qty'],
                    $data['kmeter'],

                    $data['daily_mileage'],
                    $data['weekly_rent'],
                    $data['weekly_mileage'],
                    $data['offerFlagWeekly'],
                    $data['specialOfferWeekly'] ?? null,
                    $data['monthly_rent'],
                    $data['monthly_mileage'],
                    $data['offerFlagMonthly'],
                    $data['specialOfferMonthly'] ?? null,
                    $data['toll'],
                    $data['additionalCharge'],
                    $data['online_flag'],
                    $data['whatsapp_flag'],
                    $data['fuel_type']
                ]
            );

            $carId = DB::getPdo()->lastInsertId();

            // Insert Car Specifications
            foreach ($data['specifications'] as $spec) {
                $specData = explode('~', $spec);
                if (count($specData) > 1) {
                    DB::insert(
                        "INSERT INTO car_specification (car_id, spec_id, details) VALUES (?, ?, ?)",
                        [$carId, $specData[0], $specData[1]]
                    );
                }
            }

            // Insert Car Features
            foreach ($data['features'] as $feature) {
                DB::insert(
                    "INSERT INTO car_features (car_id, feature_id) VALUES (?, ?)",
                    [$carId, $feature]
                );
            }

            // Insert Car Images
            foreach ($data['carImages'] as $image) {
                DB::insert(
                    "INSERT INTO car_images (car_id, image) VALUES (?, ?)",
                    [$carId, $image]
                );
            }

            DB::commit();
            return $carId;

        } catch (\Exception $e) {
            DB::rollBack();
            return false; // Return false to indicate failure
        }
    }


    public function updateCarData($data=[]){
        DB::beginTransaction();
        try {
            $carId = $data['carId'];
            DB::UPDATE("UPDATE cars SET name='$data[name]',model='$data[model]',brand_id='$data[brand]',type_id='$data[cartype]',general_info_flag='$data[general_info]',rental_condition_flag='$data[rental_condition]',rent='$data[rent]',offer_price='$data[specialOffer]',offer_flag='$data[offerFlag]',deposit='$data[deposit]',qty='$data[qty]',kmeter='$data[kmeter]',daily_mileage='$data[daily_mileage]',weekly_mileage='$data[weekly_mileage]',monthly_mileage='$data[monthly_mileage]',add_mileage_charge='$data[additionalCharge]',toll_charges='$data[toll]',per_week='$data[weekly_rent]',offer_flag_weekly='$data[offerFlagWeekly]',offer_price_weekly='$data[specialOfferWeekly]',per_month='$data[monthly_rent]',offer_flag_monthly='$data[offerFlagMonthly]',offer_price_monthly='$data[specialOfferMonthly]',online_flag='$data[online_flag]',whatsapp_flag='$data[whatsapp_flag]',fuel_type='$data[fuel_type]' WHERE id=$carId;");

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
            
            return DB::rollback();
        }
    }

    public function deleteCarData($data) {
        return DB::update("UPDATE cars SET deleted = :deleted WHERE id = :id", [
            'deleted' => 1,
            'id' => $data['id']
        ]);
    }
    
    public function deleteCarImageData($data) {
        return DB::DELETE("DELETE FROM car_images WHERE car_id = :id AND image = :carImage", [
            
            'id' => $data['carId'],
            'carImage' => $data['image']
        ]);
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
                            WHERE ct.deleted=0 $condition ORDER BY ct.name;");
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
        return DB::select("SELECT s.id,s.name,CASE WHEN s.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status',s.options,s.image FROM specification s
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
    
    public function updateFeatureData($data){
        return DB::UPDATE("UPDATE features SET feature='$data[name]' WHERE id='$data[id]';");
    }

    public function deleteBrandData($data){
        return DB::UPDATE("UPDATE car_brand SET deleted='1' WHERE id='$data[id]';");
    }

    public function updateBrandData($data) {
        $query = "UPDATE car_brand SET name = :name, active = :active";
        $bindings = [
            'name' => $data['brandName'],
            'active' => $data['brandActive'],
            'id' => $data['brandId']
        ];
    
        // Add the image field if it is set
        if (isset($data['image']) && !empty($data['image'])) {
            $query .= ", image = :image";
            $bindings['image'] = $data['image'];
        }
    
        $query .= " WHERE id = :id";
    
        return DB::update($query, $bindings);
    }

    public function saveBrandData($data){
        $res = DB::select("SELECT id FROM car_brand WHERE name LIKE '%$data[brName]%' AND deleted=0;");
        if(empty($res)){
            DB::INSERT("INSERT INTO car_brand (name,image,active) VALUES ('$data[brName]','$data[image]','$data[brActive]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function saveTypeData($data){
        $res = DB::select("SELECT id FROM car_type WHERE name = '$data[tyName]' AND deleted=0;");
        if(empty($res)){
            DB::INSERT("INSERT INTO car_type (name,image,active) VALUES ('$data[tyName]','$data[image]','$data[tyActive]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updateTypedData($data){
        $updateData = [
            'name' => $data['typeName'],
            'active' => $data['typeActive']
        ];
    
        if (!empty($data['image'])) {
            $updateData['image'] = $data['image'];
        }
    
        return DB::table('car_type')
            ->where('id', $data['typeId'])
            ->update($updateData);

    }

    public function deleteTypeData($data){
        return DB::UPDATE("UPDATE car_type SET deleted='1' WHERE id='$data[id]';");
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

    public function updateSpecData($data) {
        $sql = "UPDATE specification SET name = :name, options = :options, active = :active";
        $bindings = [
            'name' => $data['specName'],
            'options' => $data['options'],
            'active' => $data['specActive'],
            'id' => $data['specId'],
        ];
    
        if (isset($data['image'])) {
            $sql .= ", image = :image";
            $bindings['image'] = $data['image'];
        }
    
        $sql .= " WHERE id = :id";
    
        return DB::update($sql, $bindings);
    }

    public function deleteSpecData($data){
        return DB::UPDATE("UPDATE specification SET deleted='1' WHERE id='$data[id]';");
    }

    public function getGeneralInfo($data=[]){
        return DB::select("SELECT mst.id,mst.heading,mst.content,GROUP_CONCAT(det.options SEPARATOR '~') 'options'
                FROM general_informations mst
                LEFT JOIN general_informations_det det ON mst.id=det.gi_id
                WHERE active=1 GROUP BY mst.id;");
    }

    public function saveGeneralInfoData($data){
        DB::beginTransaction();

        try {

            DB::update("UPDATE general_informations SET heading = ?, content = ? WHERE active = 1",
                [$data['heading'], $data['content']]);

            DB::delete(
                "DELETE FROM general_informations_det WHERE gi_id = ?",
                [$data['id']]
            );
            
            // Insert options
            foreach ($data['options'] as $options) {
                DB::insert(
                    "INSERT INTO general_informations_det (gi_id,options) VALUES (?,?)",
                    [$data['id'],$options]
                );
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false; // Return false to indicate failure
        }
        
    }

    public function getPolicyAgreement($data=[]){
        $condition = '';
        if(!empty($data['id'])){
            $condition .= " AND pa.id = $data[id]";
        }
        return DB::select("SELECT pa.id,pa.name,pa.content,CASE WHEN pa.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM policy_agreement pa 
                            WHERE pa.deleted=0 $condition 
                            ORDER BY pa.id ASC;");
    }

    public function savePolicyAgreementData($data){
        $res = DB::select("SELECT id FROM policy_agreement WHERE name = '$data[name]';");
        if(empty($res)){
            DB::INSERT("INSERT INTO policy_agreement (name,content,active) VALUES ('$data[name]','$data[content]','$data[active]');");
            return DB::getPdo()->lastInsertId();
        }else{
            return -1;
        }
        
    }

    public function updatePolicyAgreementData($data){
        $content = str_replace("'", "''", $data['content']);
        return DB::UPDATE("UPDATE policy_agreement SET name='$data[name]',content='$content',active='$data[active]' WHERE id='$data[id]';");
    }

    public function deletePolicyAgreementData($data){
        return DB::UPDATE("UPDATE policy_agreement SET deleted='1' WHERE id='$data[id]';");
    }

    public function getEmirates($data=[]){
        $condition = $uninStr = '';
        if(!empty($data['id'])){
            $condition .= " AND e.id = $data[id]";
        }else{
            $uninStr = "(SELECT 'cl' AS id,ad.office_name AS 'name',ad.office_charge AS rate,'Active' AS 'status' FROM additional_settings ad WHERE ad.id=1) UNION ";
        }
        return DB::select("$uninStr (SELECT e.id,e.name,e.rate,CASE WHEN e.active = 1 THEN 'Active' ELSE 'Inactive' END as 'status' FROM emirates e
                            WHERE e.deleted=0 $condition ORDER BY e.name);");
    }
    
    public function getCarlineEmirates($data=[]){
        
        return DB::select("SELECT 'cl' AS id,ad.office_name AS 'name',ad.office_charge AS rate,'Active' AS 'status' FROM additional_settings ad WHERE ad.id=1;");
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
    
    public function updateCarlineEmiratesData($data){
        return DB::UPDATE("UPDATE additional_settings SET office_name='$data[emName]',office_charge='$data[emRate]' WHERE id='1';");
    }

    public function getBookingHistory($data = [])
    {

        $query = \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_images as ci', 'ci.car_id', '=', 'c.id')
            ->leftJoin('enduser as eu', 'b.user_id', '=', 'eu.id')
            ->leftJoin('payment_details as pd', 'b.id', '=', 'pd.booking_id')
            ->where('c.active', 1);

        if (!empty($data['brand'])) {
            $query->where('c.brand_id', $data['brand']);
        }

        if (!empty($data['type'])) {
            $query->where('c.type_id', $data['type']);
        }

        // if (!empty($data['from']) && !empty($data['to'])) {
        //     $query->whereBetween('b.created_on', [$data['from'], $data['to']]);
        // }

        if (!empty($data['from']) && !empty($data['to'])) {
            $from = $data['from'] . ' 00:00:00';
            $to = $data['to'] . ' 23:59:59';
            $query->whereBetween('b.created_on', [$from, $to]);
        }

        return $query->groupBy('b.id')
            ->select([
                'b.id',
                \DB::raw("CONCAT(cb.name, ' ', c.name, ' ', c.model) AS car_name"),
                \DB::raw("CONCAT(eu.first_name, ' ', eu.last_name) AS user_name"),
                \DB::raw("DATE_FORMAT(b.pickup_date, '%d-%m-%Y') AS pickup_date"),
                \DB::raw("DATE_FORMAT(b.created_on, '%d-%m-%Y') AS booked_date"),
                \DB::raw("DATE_FORMAT(b.return_date, '%d-%m-%Y') AS return_date"),
                \DB::raw("DATE_FORMAT(b.pickup_time, '%h:%i %p') AS pickup_time"),
                \DB::raw("DATE_FORMAT(b.return_time, '%h:%i %p') AS return_time"),
                'b.rate',
                \DB::raw("LEFT(bd.s_address, LOCATE(',', bd.s_address) - 1) AS source"),
                'bd.s_address',
                \DB::raw("LEFT(bd.d_address, LOCATE(',', bd.d_address) - 1) AS destination"),
                'bd.d_address',
                'pd.transaction_id'
            ])
            ->get();
    }

    public function getUserList(){
        return \DB::table('enduser as u')
            ->leftJoin('emirates as e', 'e.id', '=', 'u.emirates')
            ->where('u.active', 1)
            ->where('u.deleted', 0)
            ->select('u.id','u.first_name', 'u.last_name', 'u.email', 'u.phone', 'e.name AS emirates')->get();
    }

    public function deleteUserData($data){
        return DB::UPDATE("UPDATE enduser SET deleted='1' WHERE id='$data[id]';");
    }

    public function getUsersDetails($data=[]){
        return DB::select("SELECT u.id,u.first_name,u.last_name,u.email,u.phone,u.flat,u.building,u.landmark,u.city,u.emirates,u.country,d.pass_front,d.pass_back,d.dl_front,d.dl_back,d.eid_front,d.eid_back,d.cdl_front,d.cdl_back,c.name as country_name,u.user_type
            FROM enduser u
            LEFT JOIN user_documents d ON d.user_id=u.id
            LEFT JOIN country c ON c.id = u.country
            WHERE u.id='$data[id]' AND u.active=1;");
    }

    public function getChartData($data=[]){
        $query = '';
        switch ($data['period']) {

            case 'thismonth':
                $query = "SELECT 
                            d.label AS label,
                            COALESCE(b.booking_count, 0) AS booking_count
                        FROM 
                            (
                                SELECT 1 AS label UNION ALL
                                SELECT 2 UNION ALL
                                SELECT 3 UNION ALL
                                SELECT 4 UNION ALL
                                SELECT 5 UNION ALL
                                SELECT 6 UNION ALL
                                SELECT 7 UNION ALL
                                SELECT 8 UNION ALL
                                SELECT 9 UNION ALL
                                SELECT 10 UNION ALL
                                SELECT 11 UNION ALL
                                SELECT 12 UNION ALL
                                SELECT 13 UNION ALL
                                SELECT 14 UNION ALL
                                SELECT 15 UNION ALL
                                SELECT 16 UNION ALL
                                SELECT 17 UNION ALL
                                SELECT 18 UNION ALL
                                SELECT 19 UNION ALL
                                SELECT 20 UNION ALL
                                SELECT 21 UNION ALL
                                SELECT 22 UNION ALL
                                SELECT 23 UNION ALL
                                SELECT 24 UNION ALL
                                SELECT 25 UNION ALL
                                SELECT 26 UNION ALL
                                SELECT 27 UNION ALL
                                SELECT 28 UNION ALL
                                SELECT 29 UNION ALL
                                SELECT 30 UNION ALL
                                SELECT 31
                            ) d
                        LEFT JOIN (
                            SELECT 
                                DAY(pickup_date) AS label,
                                COUNT(*) AS booking_count
                            FROM booking
                            WHERE (
                                (pickup_date BETWEEN '$data[from]' AND '$data[to]')
                                OR (return_date BETWEEN '$data[from]' AND '$data[to]')
                                OR (pickup_date <= '$data[from]' AND return_date >= '$data[to]')
                            )
                            GROUP BY DAY(pickup_date)
                        ) b ON d.label = b.label
                        WHERE d.label <= DAY(LAST_DAY('$data[from]'))
                        ORDER BY d.label;";
                break;
            case 'thisyear':
                $query = "SELECT 
                        DATE_FORMAT(STR_TO_DATE(CONCAT(m.label, ' 1, 2024'), '%m %d, %Y'), '%b') AS label,
                        COALESCE(b.booking_count, 0) AS booking_count
                    FROM 
                        (
                            SELECT 1 AS label UNION ALL
                            SELECT 2 UNION ALL
                            SELECT 3 UNION ALL
                            SELECT 4 UNION ALL
                            SELECT 5 UNION ALL
                            SELECT 6 UNION ALL
                            SELECT 7 UNION ALL
                            SELECT 8 UNION ALL
                            SELECT 9 UNION ALL
                            SELECT 10 UNION ALL
                            SELECT 11 UNION ALL
                            SELECT 12
                        ) m
                    LEFT JOIN (
                        SELECT 
                            MONTH(pickup_date) AS label,
                            COUNT(*) AS booking_count
                        FROM booking
                        WHERE (
                            (pickup_date BETWEEN '$data[from]' AND '$data[to]')
                            OR (return_date BETWEEN '$data[from]' AND '$data[to]')
                            OR (pickup_date <= '$data[from]' AND return_date >= '$data[to]')
                        )
                        GROUP BY MONTH(pickup_date)
                    ) b ON m.label = b.label
                    ORDER BY m.label;";
                break;
            default:
            /**Today and yesterday*/
            $query = "SELECT 
                            d.label AS label,
                            COALESCE(b.booking_count, 0) AS booking_count
                        FROM 
                            (
                                SELECT 1 AS label UNION ALL
                                SELECT 2 UNION ALL
                                SELECT 3 UNION ALL
                                SELECT 4 UNION ALL
                                SELECT 5 UNION ALL
                                SELECT 6 UNION ALL
                                SELECT 7 UNION ALL
                                SELECT 8 UNION ALL
                                SELECT 9 UNION ALL
                                SELECT 10 UNION ALL
                                SELECT 11 UNION ALL
                                SELECT 12 UNION ALL
                                SELECT 13 UNION ALL
                                SELECT 14 UNION ALL
                                SELECT 15 UNION ALL
                                SELECT 16 UNION ALL
                                SELECT 17 UNION ALL
                                SELECT 18 UNION ALL
                                SELECT 19 UNION ALL
                                SELECT 20 UNION ALL
                                SELECT 21 UNION ALL
                                SELECT 22 UNION ALL
                                SELECT 23 UNION ALL
                                SELECT 24
                            ) d
                        LEFT JOIN (
                            SELECT 
                                HOUR(created_on) AS label,
                                COUNT(*) AS booking_count
                            FROM booking
                            WHERE (
                                (pickup_date BETWEEN '$data[from]' AND '$data[to]')
                                OR (return_date BETWEEN '$data[from]' AND '$data[to]')
                                OR (pickup_date <= '$data[from]' AND return_date >= '$data[to]')
                            )
                            
                            GROUP BY label
                        ) b ON d.label = b.label
                        ORDER BY d.label;";
                break;
        }

        return DB::select($query);
    }

    public function getChartData2($data=[]){
        $query = '';
        switch ($data['period']) {

            case 'thismonth':
                $query = "SELECT 
                            d.label AS label,
                            COALESCE(b.booking_count, 0) AS booking_count
                        FROM 
                            (
                                SELECT 1 AS label UNION ALL
                                SELECT 2 UNION ALL
                                SELECT 3 UNION ALL
                                SELECT 4 UNION ALL
                                SELECT 5 UNION ALL
                                SELECT 6 UNION ALL
                                SELECT 7 UNION ALL
                                SELECT 8 UNION ALL
                                SELECT 9 UNION ALL
                                SELECT 10 UNION ALL
                                SELECT 11 UNION ALL
                                SELECT 12 UNION ALL
                                SELECT 13 UNION ALL
                                SELECT 14 UNION ALL
                                SELECT 15 UNION ALL
                                SELECT 16 UNION ALL
                                SELECT 17 UNION ALL
                                SELECT 18 UNION ALL
                                SELECT 19 UNION ALL
                                SELECT 20 UNION ALL
                                SELECT 21 UNION ALL
                                SELECT 22 UNION ALL
                                SELECT 23 UNION ALL
                                SELECT 24 UNION ALL
                                SELECT 25 UNION ALL
                                SELECT 26 UNION ALL
                                SELECT 27 UNION ALL
                                SELECT 28 UNION ALL
                                SELECT 29 UNION ALL
                                SELECT 30 UNION ALL
                                SELECT 31
                            ) d
                        LEFT JOIN (
                            SELECT 
                                DAY(created_on) AS label,
                                COUNT(*) AS booking_count
                            FROM booking
                            WHERE CAST(created_on AS DATE) BETWEEN '$data[from]' AND '$data[to]'
                            GROUP BY DAY(created_on)
                        ) b ON d.label = b.label
                        WHERE d.label <= DAY(LAST_DAY('$data[from]'))
                        ORDER BY d.label;";
                break;
            case 'thisyear':
                $query = "SELECT 
                        DATE_FORMAT(STR_TO_DATE(CONCAT(m.label, ' 1, 2024'), '%m %d, %Y'), '%b') AS label,
                        COALESCE(b.booking_count, 0) AS booking_count
                    FROM 
                        (
                            SELECT 1 AS label UNION ALL
                            SELECT 2 UNION ALL
                            SELECT 3 UNION ALL
                            SELECT 4 UNION ALL
                            SELECT 5 UNION ALL
                            SELECT 6 UNION ALL
                            SELECT 7 UNION ALL
                            SELECT 8 UNION ALL
                            SELECT 9 UNION ALL
                            SELECT 10 UNION ALL
                            SELECT 11 UNION ALL
                            SELECT 12
                        ) m
                    LEFT JOIN (
                        SELECT 
                            MONTH(created_on) AS label,
                            COUNT(*) AS booking_count
                        FROM booking
                        WHERE CAST(created_on AS DATE) BETWEEN '$data[from]' AND '$data[to]'
                        GROUP BY MONTH(created_on)
                    ) b ON m.label = b.label
                    ORDER BY m.label;";
                break;
            default:
            /**Today and yesterday*/
            $query = "SELECT 
                            d.label AS label,
                            COALESCE(b.booking_count, 0) AS booking_count
                        FROM 
                            (
                                SELECT 1 AS label UNION ALL
                                SELECT 2 UNION ALL
                                SELECT 3 UNION ALL
                                SELECT 4 UNION ALL
                                SELECT 5 UNION ALL
                                SELECT 6 UNION ALL
                                SELECT 7 UNION ALL
                                SELECT 8 UNION ALL
                                SELECT 9 UNION ALL
                                SELECT 10 UNION ALL
                                SELECT 11 UNION ALL
                                SELECT 12 UNION ALL
                                SELECT 13 UNION ALL
                                SELECT 14 UNION ALL
                                SELECT 15 UNION ALL
                                SELECT 16 UNION ALL
                                SELECT 17 UNION ALL
                                SELECT 18 UNION ALL
                                SELECT 19 UNION ALL
                                SELECT 20 UNION ALL
                                SELECT 21 UNION ALL
                                SELECT 22 UNION ALL
                                SELECT 23 UNION ALL
                                SELECT 24
                            ) d
                        LEFT JOIN (
                            SELECT 
                                HOUR(created_on) AS label,
                                COUNT(*) AS booking_count
                            FROM booking
                            WHERE CAST(created_on AS DATE) BETWEEN '$data[from]' AND '$data[from]'
                            
                            GROUP BY label
                        ) b ON d.label = b.label
                        ORDER BY d.label;";
                break;
        }

        return DB::select($query);
    }

    public function getLatestBooking($data=[]){
        return \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_images as ci', 'ci.car_id', '=', 'c.id')
            ->groupBy('b.id')
            ->select([
                'b.id',
                'c.id as carId',
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
                'b.status',
                \DB::raw("CASE 
                    WHEN b.status = 1 THEN 'Booked' 
                    WHEN b.status = 0 THEN 'Canceled' 
                    ELSE 'unknown' 
                  END as status_label")
            ])
            ->orderBy('b.created_on', 'desc')
            ->limit(5)  // Limit the results to 5 records
            ->get();
    }

    public function carWiseBooking($data=[]){
        $query = "SELECT 
                CONCAT(cb.name,' ',c.name,' ',c.model) AS label,
                SUM(b.rate) AS booking_total
            FROM booking b
            LEFT JOIN cars c ON b.car_id=c.id
            LEFT JOIN car_brand cb ON cb.id=c.brand_id
            WHERE (
                (b.pickup_date BETWEEN '$data[from]' AND '$data[to]')
                OR (b.return_date BETWEEN '$data[from]' AND '$data[to]')
                OR (b.pickup_date <= '$data[from]' AND return_date >= '$data[to]')
            )
            GROUP BY b.car_id;";

        return DB::select($query);
    }

    public function getSales($data=[]){
        $query = "SELECT
                SUM(b.rate) AS booking_total
            FROM booking b
            WHERE (
                (b.pickup_date BETWEEN '$data[from]' AND '$data[to]')
                OR (b.return_date BETWEEN '$data[from]' AND '$data[to]')
                OR (b.pickup_date <= '$data[from]' AND return_date >= '$data[to]')
            );";

        return DB::select($query);
    }

    public function getCustomers($data=[]){
        $query = "SELECT
                COUNT(id) AS cnt
            FROM enduser
            WHERE CAST(created_on AS DATE) BETWEEN '$data[from]' AND '$data[to]';";

        return DB::select($query);
    }

    public function getBookingDetails($data=[]){
        return \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_images as ci', 'ci.car_id', '=', 'c.id')
            ->leftJoin('enduser as eu', 'b.user_id', '=', 'eu.id')
            ->leftJoin('payment_details as pd', 'b.id', '=', 'pd.booking_id')
            ->where('b.id', $data['id'])
            ->groupBy('b.id')
            ->select([
                'b.id',
                \DB::raw("DATE_FORMAT(b.pickup_date, '%d-%m-%Y') as pickup_date"),
                \DB::raw("DATE_FORMAT(b.return_date, '%d-%m-%Y') as return_date"),
                \DB::raw("DATE_FORMAT(b.pickup_time, '%h:%i %p') as pickup_time"),
                \DB::raw("DATE_FORMAT(b.return_time, '%h:%i %p') as return_time"),
                'b.rate',
                \DB::raw("LEFT(bd.s_address, LOCATE(',', bd.s_address) - 1) as source"),
                'bd.s_address',
                \DB::raw("LEFT(bd.d_address, LOCATE(',', bd.d_address) - 1) as destination"),
                'bd.d_address',
                \DB::raw("CONCAT(cb.name, ' ', c.name, ' ', c.model) as car_name"),
                \DB::raw("CONCAT(eu.first_name, ' ', eu.last_name) as user_name"),
                'bd.s_lat',
                'bd.s_lon',
                'bd.d_lat',
                'bd.d_lon',
                'b.status',
                'pd.transaction_id',
                'pd.totalRate AS carRent',
                'pd.vat',
                'pd.emirate',
                'pd.deposit',
                'pd.babySeat',
                'pd.total',
                \DB::raw("DATE_FORMAT(b.created_on, '%d-%m-%Y') as booked_on"),
                \DB::raw("CASE 
                    WHEN b.status = 1 THEN 'Booked' 
                    WHEN b.status = 0 THEN 'Canceled' 
                    ELSE 'unknown' 
                  END as status_label")
            ])
            ->get();
    }

    public function updateDocStatus($data)
    {
        // Define mapping of docType to database columns
        $docTypeToColumn = [
            'pass_front' => 'passf_flag',
            'pass_back'  => 'passb_flag',
            'dl_front'   => 'dlf_flag',
            'dl_back'    => 'dlb_flag',
            'eid_front'  => 'eidf_flag',
            'eid_back'   => 'eidb_flag',
            'cdl_front'   => 'cdlf_flag',
            'cdl_back'   => 'cdlb_flag',
        ];

        // Check if the docType is valid
        if (!isset($docTypeToColumn[$data['docType']])) {
            return false; // Invalid docType
        }

        // Update the appropriate column in the database
        return DB::table('enduser')
            ->where('id', $data['userId'])
            ->update([$docTypeToColumn[$data['docType']] => '0']);
    }

    public function updateDocImage($data,$image=[])
    {
        // Define the mapping of docType to database column
        $docTypeToColumn = [
            'pass_front' => 'pass_front',
            'pass_back'  => 'pass_back',
            'dl_front'   => 'dl_front',
            'dl_back'    => 'dl_back',
            'eid_front'  => 'eid_front',
            'eid_back'   => 'eid_back',
            'cdl_front'   => 'cdl_front',
            'cdl_back'   => 'cdl_back',
        ];

        // Validate if the provided docType exists in the mapping
        if (!isset($docTypeToColumn[$data['docType']])) {
            return response()->json(['error' => 'Invalid document type.'], 400); // Return error response
        }

        // Use the column mapped to the docType
        $column = $docTypeToColumn[$data['docType']];

        // Update the appropriate column in the database
        return DB::table('user_documents')
            ->where('user_id', $data['userId'])
            ->update([$column => '']);
    }

    public function getImage($data)
    {
        // Define the mapping of docType to database column
        $docTypeToColumn = [
            'pass_front' => 'pass_front',
            'pass_back'  => 'pass_back',
            'dl_front'   => 'dl_front',
            'dl_back'    => 'dl_back',
            'eid_front'  => 'eid_front',
            'eid_back'   => 'eid_back',
            'cdl_front'   => 'cdl_front',
            'cdl_back'   => 'cdl_back',
        ];

        // Validate if the provided docType exists in the mapping
        if (!isset($docTypeToColumn[$data['docType']])) {
            return response()->json(['error' => 'Invalid document type.'], 400); // Return error response
        }

        // Use the column mapped to the docType
        $column = $docTypeToColumn[$data['docType']];

        // Fetch the image from the database
        return \DB::table('enduser as eu')
            ->leftJoin('user_documents as ud', 'ud.user_id', '=', 'eu.id')
            ->where('eu.id', $data['userId'])
            ->select([$column . ' as image'])
            ->first();
    }

    public function updateUserData($data = [])
    {
        return DB::table('enduser')
                ->where('id', $data['userId'])
                ->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'phone' => $data['phone'],
                    'flat' => $data['flat'],
                    'building' => $data['building'],
                    'landmark' => $data['landmark'],
                    'city' => $data['city'],
                    'country' => $data['country'],
                    'user_type' => $data['user_type']
                ]);
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
            'pass_front' => 'pass_front',
            'pass_back'  => 'pass_back',
            'dl_front'   => 'dl_front',
            'dl_back'    => 'dl_back',
            'eid_front'  => 'eid_front',
            'eid_back'   => 'eid_back',
            'cdl_front'   => 'cdl_front',
            'cdl_back'   => 'cdl_back',
        ];

        $flagMapping = [
            'pass_front' => 'passf_flag',
            'pass_back'  => 'passb_flag',
            'dl_front'   => 'dlf_flag',
            'dl_back'    => 'dlb_flag',
            'eid_front'  => 'eidf_flag',
            'eid_back'   => 'eidb_flag',
            'cdl_front'   => 'cdlf_flag',
            'cdl_back'   => 'cdlb_flag',
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

    public function getMyDocumentDetails($data=[]){
        return DB::select("SELECT eu.id,ud.pass_front,ud.pass_back,ud.dl_front,ud.dl_back,ud.eid_front,ud.eid_back,ud.cdl_front,ud.cdl_back
            FROM enduser eu
            LEFT JOIN user_documents ud ON eu.id=ud.user_id
            WHERE eu.id='$data[userId]' AND eu.active=1;");
    }

    public function getBookingHistoryReports($data = [])
    {

        $query = \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_type as ct', 'ct.id', '=', 'c.type_id')
            ->where('c.active', 1);

        if (!empty($data['from']) && !empty($data['to'])) {
            $query->whereBetween('b.pickup_date', [$data['from'], $data['to']]);
        }

        return $query->groupBy('b.id')
            ->select([
                'b.id',
                \DB::raw("CONCAT(cb.name, ' ', c.name, ' ', c.model) AS car_name"),
                'b.rate',
                'c.name AS carname',
                'c.id AS carid',
                'cb.name AS carbrand',
                'cb.id AS carbrandid',
                'ct.id AS cartypeid',
                'ct.name AS cartypename',
            ])
            ->get();
    }

    public function getContry() {
        return DB::table('country')->select('id', 'name')->get()->toArray();
    }

    public function updateAdditionalSettingsData($data) {
        return DB::update("UPDATE additional_settings SET baby_seat_charge = :babySeat,vat_rate = :vatRate WHERE id = :id", [
            'babySeat' => $data['babySeat'],
            'vatRate' => $data['vatRate'],
            'id' => 1
        ]);
    }

    public function getAdditionalSettingsData() {
        return DB::table('additional_settings')->select('baby_seat_charge', 'vat_rate')->get()->toArray();
    }
}
