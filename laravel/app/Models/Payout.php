<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model {
    protected $fillable = ['worker_id','amount','status','released_at'];
    public function worker(){ return $this->belongsTo(User::class,'worker_id'); }
}
