<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class activate_sim extends Model
{

    protected $fillable = [
        'ICCID', 'IMSI', 'MSISDN'
    ];
}
