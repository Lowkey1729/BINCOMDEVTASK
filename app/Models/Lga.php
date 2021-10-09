<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;

    protected $fillable = [
        "uniqueid", "lga_id", "lga_name", "state_id", "lga_description", "entered_by_user",
        "date_entered", "user_ip_address",
    ];

    protected $primaryKey = 'lga_id';

    public function pollingUnits() {

        return $this->hasMany("App\Models\PollingUnit", "lga_id");
    }

    public function announcedLgaResults(){

        return $this->hasMany("App\Models\AnnouncedLgaResult", "lga_name");
    }
}
