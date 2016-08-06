<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commodities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'commodity_id',
    	'state',
    	'district',
    	'market',
    	'commodity_name',
    	'variety',
    	'arrival_date',
    	'min_price',
    	'max_price',
    	'modal_price',
        'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
    	'created_at',
    	'updated_at',
    	'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    	'arrival_date' => 'datetime',
        'timestamp' => 'datetime'
    ];
}