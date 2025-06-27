<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SmsLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_id',
        'contact_id',
        'status',
        'sent_at',
    ];
    public function contact()
    {
        return $this->belongsTo(contacts::class);
    }

    public function template()
    {
        return $this->belongsTo(SmsTemplate::class, 'template_id');
    }

}
