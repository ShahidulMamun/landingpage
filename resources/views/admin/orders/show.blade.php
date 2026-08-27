@extends('admin.layout')
@section('title', 'অর্ডার #' . $order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <a href="{{ route('admin.orders.index') }}" class="text-muted small"><i class="bi bi-arrow-left"></i> অর্ডার লিস্টে ফিরে যাও</a>
    <h4 class="m-0 mt-1">অর্ডার #{{ $order->id }}</h4>
  </div>
  <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('এই অর্ডারটা ডিলিট করবে?')">
    @csrf @method('DELETE')
    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> ডিলিট</button>
  </form>
</div>

@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if($order->order_group_id)
<div class="alert alert-info d-flex align-items-center gap-2">
  <i class="bi bi-link-45deg fs-5"></i>
  এই অর্ডারটা একটা <strong>মাল্টি-প্রোডাক্ট চেকআউটের</strong> অংশ — একই কাস্টমার একসাথে {{ $groupOrders->count() }}টা প্রোডাক্ট অর্ডার করেছে। সবগুলো নিচে দেখানো হয়েছে।
</div>

<div class="admin-card mb-4">
  <h6 class="mb-3"><i class="bi bi-boxes"></i> এই চেকআউটের সব প্রোডাক্ট</h6>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>প্রোডাক্ট</th>
          <th>পরিমাণ</th>
          <th>ইউনিট প্রাইস</th>
          <th>ডেলিভারি চার্জ</th>
          <th>সাবটোটাল</th>
          <th>স্ট্যাটাস</th>
        </tr>
      </thead>
      <tbody>
        @foreach($groupOrders as $go)
        <tr class="{{ $go->id === $order->id ? 'table-active' : '' }}">
          <td>
            @if($go->id === $order->id)
              #{{ $go->id }} <span class="badge bg-secondary">এইটা দেখছো</span>
            @else
              <a href="{{ route('admin.orders.show', $go) }}">#{{ $go->id }}</a>
            @endif
          </td>
          <td>{{ $go->product_name }}</td>
          <td>{{ $go->quantity }}</td>
          <td>৳{{ number_format($go->unit_price) }}</td>
          <td>{{ $go->delivery_charge > 0 ? '৳' . number_format($go->delivery_charge) : '—' }}</td>
          <td>৳{{ number_format($go->total_price) }}</td>
          <td><span class="badge bg-light text-dark border">{{ $go->status }}</span></td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="text-end fw-bold">চেকআউট সর্বমোট</td>
          <td class="fw-bold">৳{{ number_format($groupTotal) }}</td>
          <td></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endif

<div class="row g-4">
  <!-- Order info -->
  <div class="col-lg-7">
    <div class="admin-card mb-4">
      <h6 class="mb-3">প্রোডাক্ট তথ্য</h6>
      <table class="table table-sm">
        <tr><td class="text-muted" width="160">প্রোডাক্ট</td><td>{{ $order->product_name }}</td></tr>
        <tr><td class="text-muted">ইউনিট প্রাইস</td><td>৳{{ number_format($order->unit_price) }}</td></tr>
        <tr><td class="text-muted">পরিমাণ</td><td>{{ $order->quantity }}</td></tr>
        <tr><td class="text-muted">সর্বমোট</td><td class="fw-bold">৳{{ number_format($order->total_price) }}</td></tr>
      </table>
    </div>

    <div class="admin-card">
      <h6 class="mb-3">কাস্টমার তথ্য</h6>
      <table class="table table-sm">
        <tr><td class="text-muted" width="160">নাম</td><td>{{ $order->customer_name }}</td></tr>
        <tr><td class="text-muted">ফোন</td><td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td></tr>
        <tr><td class="text-muted">ঠিকানা</td><td>{{ $order->address }}</td></tr>
        <tr><td class="text-muted">পেমেন্ট মেথড</td><td>{{ strtoupper($order->payment_method) }}</td></tr>
        <tr><td class="text-muted">অর্ডারের সময়</td><td>{{ $order->created_at->format('d M Y, h:i A') }}</td></tr>
      </table>
    </div>
  </div>

  <!-- Status update -->
  <div class="col-lg-5">
    <div class="admin-card">
      <h6 class="mb-3">স্ট্যাটাস আপডেট করো</h6>
      <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
          <label class="form-label">অর্ডার স্ট্যাটাস</label>
          <select name="status" class="form-select">
            @foreach(\App\Models\Order::STATUSES as $s)
              <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label">পেমেন্ট স্ট্যাটাস</label>
          <select name="payment_status" class="form-select">
            @foreach(\App\Models\Order::PAYMENT_STATUSES as $ps)
              <option value="{{ $ps }}" {{ $order->payment_status === $ps ? 'selected' : '' }}>{{ ucfirst($ps) }}</option>
            @endforeach
          </select>
        </div>

        @if($order->order_group_id)
        <div class="form-check mb-4">
          <input type="checkbox" name="apply_to_group" class="form-check-input" id="applyToGroup" value="1" checked>
          <label class="form-check-label" for="applyToGroup">
            এই চেকআউটের বাকি {{ $groupOrders->count() - 1 }}টা প্রোডাক্টেও একই স্ট্যাটাস বসাও
          </label>
        </div>
        @endif

        <button type="submit" class="btn btn-admin-primary w-100">আপডেট করো</button>
      </form>
    </div>

    <div class="admin-card mt-4">
      <h6 class="mb-2">দ্রুত কল করো</h6>
      <a href="tel:{{ $order->phone }}" class="btn btn-outline-secondary w-100">
        <i class="bi bi-telephone"></i> {{ $order->phone }}
      </a>
    </div>
  </div>
</div>
@endsection