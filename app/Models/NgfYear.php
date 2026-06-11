<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NgfYear extends Model
{
    protected $table = 'ngfYear';
    protected $primaryKey = 'yearId';
    protected $fillable = ['year'];
}
