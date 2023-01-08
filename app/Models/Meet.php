<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    public $table = 'meets';

    public $fillable = [
        'document_owner',
        'name',
        'last_name',
        'pet_name', 
        'meet_date',
        'meet_time'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'document_owner' => 'int',
        'name' => 'string',
        'last_name' => 'string',
        'pet_name' => 'string',
        'meet_date' => 'date',
        'meet_time' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'document_owner' => 'required',
        'name' => 'required',
        'last_name' => 'required',
        'pet_name' => 'required',
        'meet_date' => 'required',
        'meet_time' => 'required'
    ];
}
