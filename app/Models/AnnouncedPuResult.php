<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncedPuResult extends Model
{
    use HasFactory;

    protected $fillable =[
        "result_id", "polling_unit_uniqueid", "party_abbreviation", "party_score", "entered_by_user", "date_entered",
        "user_ip_address"
    ];

    protected $primaryKey = "polling_unit_uniqueid";

    public $timestamps = false;

    public function pollingUnits(){

        return $this->belongsTo("App\Models\PollingUnit", 'uniqueid');
    }


}
