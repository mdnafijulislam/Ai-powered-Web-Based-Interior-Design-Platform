<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class WorkerPortfolio extends Model
{
    protected $fillable = [
        'worker_id',
        'title',
        'location',
        'type',
        'description',
        'image',
        'before_image',
        'after_image',
        'featured'
    ];

    // Relation
    public function worker()
    {
        return $this->belongsTo(\App\Models\User::class, 'worker_id');
    }

    // Accessor for full image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/portfolio/' . $this->image);
        }
        return asset('assets/images/default-project.jpg'); // fallback
    }

    public function getBeforeImageUrlAttribute()
    {
        return $this->before_image ? asset('uploads/portfolio/' . $this->before_image) : null;
    }

    public function getAfterImageUrlAttribute()
    {
        return $this->after_image ? asset('uploads/portfolio/' . $this->after_image) : null;
    }
}
