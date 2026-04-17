<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // هذا السطر يسمح للمتحكم بإرسال البيانات لهذا الجدول
    protected $fillable = ['customer_id', 'amount'];

    // لكي يعرف السجل لمن ينتمي هذا الدفع
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}