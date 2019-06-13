<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provision_sim extends Model
{
    protected $fillable = [
        'ICCID', 'IMSI', 'Ki', 'PIN1', 'PUC', 'status'
    ];
}
