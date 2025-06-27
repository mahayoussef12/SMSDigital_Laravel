<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SmsLog;

class contacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'group',
    ];

    // Relations
    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class);
    }
}
