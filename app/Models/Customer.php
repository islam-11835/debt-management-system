<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // 1. السماح بإضافة هذه الحقول لقاعدة البيانات
    protected $fillable = ['name', 'phone', 'total_debt'];

    // 2. ربط الزبون بسجل دفعاته (علاقة One-to-Many)
    // يجب أن تكون داخل القوس الأخير للكلاس
    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }
} // هذا القوس هو نهاية الكلاس