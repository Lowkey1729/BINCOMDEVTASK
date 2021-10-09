<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncedStateResult extends Model
{
    use HasFactory;

    protected $fillable = [
        "result_id", "state_name", "party_abbreviation", "party_score", "entered_by_user", "date_entered",
        "user_ip_address"
    ];
}
