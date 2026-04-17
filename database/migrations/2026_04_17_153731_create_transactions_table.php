<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // هنا نقوم بإنشاء الجدول وإضافة الأعمدة بداخله
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // العمود الأول الجاهز
            
            // أضيفي الأسطر الجديدة هنا في المنتصف:
            $table->foreignId('customer_id')->constrained()->onDelete('cascade'); 
            $table->decimal('amount', 10, 2); 
            
            $table->timestamps(); // العمود الأخير الجاهز
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};