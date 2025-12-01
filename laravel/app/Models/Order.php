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
