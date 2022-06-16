<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'estate_agent_id',
        'property_id',
        'sale_id',
        'state_id',
        'locality',
        'subtype of property',
        'price',
        'number of rooms',
        'area',
    ];

    public $timestamps = false;
}
