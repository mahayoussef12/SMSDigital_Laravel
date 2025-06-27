<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SmsLog;
class SmsTemplate extends Model
{
    use HasFactory;

    protected $table = 'sms_templates'; // facultatif si le nom est respecté

    protected $fillable = [
        'title',
        'content',
    ];
    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class, 'template_id');
    }
}
