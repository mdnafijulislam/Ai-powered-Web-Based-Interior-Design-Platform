<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id','worker_id','portfolio_id','status','preferred_date','message','budget'
    ];

    public function client()
    {
        return $this->belongsTo(\App\Models\User::class, 'client_id');
    }

    public function worker()
    {
        return $this->belongsTo(\App\Models\User::class, 'worker_id');
    }

    public function portfolio()
    {
        return $this->belongsTo(WorkerPortfolio::class, 'portfolio_id');
    }
}
