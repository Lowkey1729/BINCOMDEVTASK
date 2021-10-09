<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        "uniqueid", "polling_unit_id", "ward_id", "lga_id", "uniquewardid",
        "polling_unit_number", "polling_unit_name", "polling_unit_description",
        "lat", "long", "entered_by_user", "date_entered", "user_ip_address",
    ];

    protected $primaryKey = "uniqueid";

    public function announcedPuResults(){

        return $this->hasMany("App\Models\AnnouncedPuResult", "polling_unit_uniqueid");
    }

    public function lgas(){

        return $this->belongsTo("App\Models\Lga", "uniqueid");
    }
}
