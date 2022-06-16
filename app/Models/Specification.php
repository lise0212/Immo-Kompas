<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'kitchen_equipment',
        'furnished',
        'open_fire',
        'terrace',
        'terrace_area',
        'garden',
        'garden_area',
        'surface_land',
        'surface_plot_land',
        'number_of_facades',
        'swimming_pool',
    ];
    
    public $timestamps = false;
}
