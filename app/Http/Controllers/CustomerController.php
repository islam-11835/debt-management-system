<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; // السطر اللي أضفناه
use App\Models\Transaction; 
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers', compact('customers'));
    }
public function store(Request $request)
{
    // 1. التحقق من صحة البيانات (المنع البرمجي)
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|numeric',      // سيمنع أي حرف ويقبل أرقام فقط
        'total_debt' => 'nullable|numeric', // سيمنع أي حرف ويقبل أرقام فقط
    ], [
        'phone.numeric' => 'عذراً، يجب إدخال أرقام فقط في خانة الهاتف!',
        'total_debt.numeric' => 'عذراً، خانة الدين يجب أن تكون رقماً!',
    ]);

    // 2. إذا كانت البيانات صحيحة سيقوم بالحفظ
    \App\Models\Customer::create($request->all());

    return redirect()->back();
}
public function destroy($id)
{
    // البحث عن الزبون وحذفه
    $customer = \App\Models\Customer::findOrFail($id);
    $customer->delete();

    // العودة للجدول مع تحديث البيانات
    return redirect()->back();
}
// ملاحظة مهمة جداً: تأكدي أن هذا السطر موجود في أعلى الملف مع الـ "use" الأخرى


public function pay(Request $request, $id)
{
    // 1. العثور على الزبون
    $customer = Customer::findOrFail($id);
    
    // 2. طرح المبلغ من الدين الكلي
    $customer->total_debt -= $request->amount;
    $customer->save();

    // 3. الخطوة الجديدة: تسجيل هذه العملية في جدول السجل
    Transaction::create([
        'customer_id' => $id,      // رقم الزبون اللي دفع
        'amount' => $request->amount // كم دفع
    ]);

    return redirect()->back();
}
}