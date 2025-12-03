<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id','title','location','type','description','image'
    ];

    // relation to User (worker)
    public function worker()
    {
        return $this->belongsTo(\App\Models\User::class, 'worker_id');
    }

    // convenience accessor for image url
    public function getImageUrlAttribute()
    {
        if (!$this->image) return asset('assets/images/default-project.jpg');
        return asset('uploads/portfolio/' . $this->image);
    }
}
