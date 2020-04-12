<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
        'id', 
        'email', 
        'password', 
        'name', 
        'gender', 
        'birth_year', 
        'country', 
        'state', 
        'city', 
        'categories', 
        'subcategories', 
        'level', 
        'picture_uri', 
        'user_type',
        'org_name',
        'org_website',
        'org_phone',
        'criteria_age_range',
        'criteria_genre',
        'criteria_level',
    ];

    
}