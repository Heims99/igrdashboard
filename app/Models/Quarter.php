<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quarter extends Model
{
    protected $table = 'quarter';
    protected $primaryKey = 'quarterId';
    protected $fillable = ['quarter'];
}
