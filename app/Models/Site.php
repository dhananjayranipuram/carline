<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public function getBrands(){
        return DB::select("SELECT cb.id,cb.name,cb.image FROM car_brand cb 
                            WHERE cb.deleted=0 AND cb.active=1
                            ORDER BY cb.name;");
    }

    public function getCars(){
        return DB::select("SELECT c.id,c.name,c.model,cb.name brand_name,ct.name car_type,ci.image FROM cars c
                            LEFT JOIN car_brand cb ON cb.id=c.brand_id
                            LEFT JOIN car_type ct ON ct.id=c.type_id
                            LEFT JOIN car_images ci ON ci.car_id=c.id
                            WHERE c.active=1 AND c.deleted=0;");
    }

    public function getCarType(){
        return DB::select("SELECT ct.id,ct.name,ct.image FROM car_type ct
                            WHERE ct.active=1 AND ct.deleted=0 LIMIT 4;");
    }

}
