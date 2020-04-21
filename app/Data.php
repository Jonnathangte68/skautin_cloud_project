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
        'is_job',
        'job_title',
        'job_description',
        'job_requirements',
        'job_category',
        'job_subcategory',
        'job_country',
        'job_state',
        'job_city',
        'job_type',
        'job_level',
        'job_creation_time'
    ];

    
}