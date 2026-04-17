<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام الديون</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
        <div class="container mt-5">
    <h2>قائمة ديون الزبائن</h2>
    <div style="background: white; padding: 20px; border-radius: 10px; margin: 20px auto; width: 80%; border: 1px solid #007bff; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
    <h3 style="color: #007bff; margin-top: 0;">إضافة زبون جديد</h3>
    @if ($errors->any())
    <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="/customers" method="POST" style="display: flex; gap: 10px; flex-wrap: wrap;">
        @csrf
        <input type="text" name="name" placeholder="اسم الزبون" required style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        <input type="text" name="phone" placeholder="رقم الهاتف" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        <input type="number" name="total_debt" placeholder="المبلغ" step="0.01" style="width: 120px; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
        <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">+ حفظ</button>
    </form>
</div>
    <table class="table table-striped table-hover shadow-sm mt-3">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>رقم الهاتف</th>
                <th>الدين الكلي</th>
                <th>العمليات</th>
            </tr>
        </thead>
   <tbody>
    @foreach($customers as $customer)
    <tr>
       <td>
    <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#customerModal{{ $customer->id }}">
        {{ $customer->name }}
    </a>
</td>
        <td>{{ $customer->phone }}</td>
        <td>{{ $customer->total_debt }} TL</td>
        <td>
            <div class="d-flex gap-2 justify-content-center">
                <form action="/customers/{{ $customer->id }}/pay" method="POST" class="d-flex gap-1">
                    @csrf
                    <input type="number" name="amount" placeholder="خصم" step="0.01" required class="form-control form-control-sm" style="width: 70px;">
                    <button type="submit" class="btn btn-primary btn-sm">خصم</button>
                </form>

                <form action="/customers/{{ $customer->id }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                </form>
            </div>
        </td>
    </tr>

    <div class="modal fade" id="customerModal{{ $customer->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">كشف حساب: {{ $customer->name }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>إجمالي الدين المتبقي: <span class="text-danger">{{ $customer->total_debt }} TL</span></h6>
                <hr>
                <p class="fw-bold">سجل الدفعات:</p>
                <ul class="list-group">
                    @forelse($customer->transactions()->latest()->get() as $log)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>دفع مبلغ: <strong>{{ $log->amount }} TL</strong></span>
                            <small class="text-muted">{{ $log->created_at->format('Y-m-d H:i') }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center">لا يوجد دفعات سابقة.</li>
                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
    @endforeach
</tbody>
    </table>
    <hr class="my-5"> <div class="row">
    <div class="col-md-8 mx-auto">
        <h3 class="text-center mb-4" style="color: #007bff;">
            <i class="fas fa-history"></i> سجل آخر عمليات الدفع
        </h3>
        
        <div class="list-group shadow-sm">
            @php
                // جلب آخر 10 عمليات دفع مع أسماء أصحابها
                $latestTransactions = \App\Models\Transaction::with('customer')->latest()->take(10)->get();
            @endphp

            @forelse($latestTransactions as $log)
                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user text-primary me-2"></i>
                        <strong>{{ $log->customer->name }}</strong>
                        <span class="text-muted small ms-2">({{ $log->created_at->format('Y-m-d H:i') }})</span>
                    </div>
                    <span class="badge bg-success rounded-pill px-3">
                        + دفع {{ $log->amount }} TL
                    </span>
                </div>
            @empty
                <div class="list-group-item text-center text-muted">
                    لا يوجد عمليات دفع مسجلة بعد.
                </div>
            @endforelse
        </div>
    </div>
</div>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>