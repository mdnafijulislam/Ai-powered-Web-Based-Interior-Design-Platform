<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WorkerPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'title',
        'location',
        'type',
        'description',
        'image',
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }

    // ✅ IMAGE URL ACCESSOR (FIX)
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('uploads/portfolio/' . $this->image);
        }

        return asset('assets/images/no-image.png');
    }
}
