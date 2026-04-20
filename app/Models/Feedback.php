<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'feedbacks';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'location',
        'issue_type',
        'description',
        'status',
        'remark',
    ];
}
