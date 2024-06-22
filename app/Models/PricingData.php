<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingData extends Model
{
    use HasFactory;

    public static function sampleData($type_id)
    {
        if($type_id == 1){
            return '{
                "results": [
                    {
                    "symbol": "APPL",
                    "price": 300.97,
                    "last_price_datetime": "2023-10-30T17:31:18"
                    },
                    {
                    "symbol": "TSLA",
                    "price": 244.42,
                    "last_price_datetime": "2023-10-30T17:32:11"
                    }
                ]
            }';
        }else{
            return '{
                "results": [
                    {
                    "symbol": "LG",
                    "price": 160.15,
                    "last_price_datetime": "2023-10-30T17:31:18"
                    },
                    {
                    "symbol": "LMBO",
                    "price": 1000.42,
                    "last_price_datetime": "2023-10-30T17:32:11"
                    }
                ]
            }';
        }
      
    }
}
