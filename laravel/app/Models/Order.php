<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_key','client_name','client_email','client_phone',
        'project_title','project_type','description','status',
        'budget','payment_status','deadline','worker_id',
        'progress','deliverables'
    ];

    protected $casts = [
        'deliverables' => 'array'
    ];

    public function messages()
    {
        return $this->hasMany(OrderMessage::class)->orderBy('created_at', 'asc');
    }
}

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['client_id','worker_id','title','description','price','status','deadline','paid'];

    public function client() { return $this->belongsTo(User::class,'client_id'); }
    public function worker() { return $this->belongsTo(User::class,'worker_id'); }
    public function reviews() { return $this->hasMany(Review::class); }
}
