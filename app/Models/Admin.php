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
        return DB::select("SELECT c.id,c.name,c.model,cb.id brand_id,cb.name brand_name,ct.id type_id,ct.name car_type,GROUP_CONCAT(ci.image) AS 'image',c.rent,c.general_info_flag,c.rental_condition_flag,c.offer_flag,c.offer_price,c.deposit,c.qty FROM cars c
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
                "INSERT INTO cars (name, model, brand_id, type_id, general_info_flag, rental_condition_flag, rent, deposit, offer_flag, offer_price,qty) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
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
            DB::UPDATE("UPDATE cars SET name='$data[name]',model='$data[model]',brand_id='$data[brand]',type_id='$data[cartype]',general_info_flag='$data[general_info]',rental_condition_flag='$data[rental_condition]',rent='$data[rent]',offer_price='$data[specialOffer]',offer_flag='$data[offerFlag]',deposit='$data[deposit]',qty='$data[qty]' WHERE id=$carId;");

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
        $res = DB::select("SELECT id FROM car_brand WHERE name LIKE '%$data[brName]%';");
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

    public function getBookingHistory($data = [])
    {

        return \DB::table('booking as b')
            ->join('booking_details as bd', 'b.id', '=', 'bd.booking_id')
            ->leftJoin('cars as c', 'c.id', '=', 'b.car_id')
            ->leftJoin('car_brand as cb', 'cb.id', '=', 'c.brand_id')
            ->leftJoin('car_images as ci', 'ci.car_id', '=', 'c.id')
            // ->where('b.active', 1)
            ->whereBetween('b.pickup_date', [$data['from'], $data['to']])
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
                \DB::raw("LEFT(GROUP_CONCAT(ci.image), LOCATE(',', GROUP_CONCAT(ci.image)) - 1) as image")
            ])->get();
    }

    public function getUserList(){
        return \DB::table('enduser')
            ->where('active', 1)
            ->select('id','first_name', 'last_name', 'email', 'phone', 'emirates')->get();
    }

    public function getUsersDetails($data=[]){
        return DB::select("SELECT id,first_name,last_name,email,phone,flat,building,landmark,city,emirates FROM enduser WHERE id='$data[id]' AND active=1;");
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
                            WHERE car_id = 4 AND created_on BETWEEN '$data[from]' AND '$data[from]'
                            
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
                \DB::raw("DATE_FORMAT(b.pickup_date, '%Y-%m-%d') as pickup_date"),
                \DB::raw("DATE_FORMAT(b.return_date, '%Y-%m-%d') as return_date"),
                \DB::raw("DATE_FORMAT(b.pickup_time, '%h:%i %p') as pickup_time"),
                \DB::raw("DATE_FORMAT(b.return_time, '%h:%i %p') as return_time"),
                'b.rate',
                \DB::raw("LEFT(bd.s_address, LOCATE(',', bd.s_address) - 1) as source"),
                'bd.s_address',
                \DB::raw("LEFT(bd.d_address, LOCATE(',', bd.d_address) - 1) as destination"),
                'bd.d_address',
                \DB::raw("CONCAT(cb.name, ' ', c.name, ' ', c.model) as car_name")
            ])
            ->orderBy('b.created_on', 'desc')
            ->limit(5)  // Limit the results to 5 records
            ->get();
    }
}
