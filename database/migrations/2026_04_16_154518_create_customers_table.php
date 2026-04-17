<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        
        // أضيفي هدول الثلاث أسطر هون:
        $table->string('name');          // اسم الزبون
        $table->string('phone')->nullable(); // رقم الهاتف
        $table->decimal('total_debt', 10, 2)->default(0); // مبلغ الدين
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
