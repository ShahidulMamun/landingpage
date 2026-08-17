@extends('admin.layout')
@section('title', 'ড্যাশবোর্ড')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="m-0">ড্যাশবোর্ড</h4>
    <p class="text-muted mb-0 small">আজকের সারসংক্ষেপ</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.products.create') }}" class="btn btn-admin-primary btn-sm">
      <i class="bi bi-plus-lg"></i> নতুন প্রোডাক্ট
    </a>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-secondary btn-sm">
      <i class="bi bi-plus-lg"></i> নতুন ক্যাটাগরি
    </a>
  </div>
</div>

<!-- Stat cards -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-4">
    <div class="stat-card">
      <div class="stat-icon" style="background:rgba(15,82,87,0.1);color:#0F5257">
        <i class="bi bi-cash-stack"></i>
      </div>
      <div>
        <span class="stat-label">মোট আয় (কনফার্মড)</span>
        <strong class="stat-value">৳{{ number_format($stats['revenue']) }}</strong>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="stat-card">
      <div class="stat-icon" style="background:rgba(255,107,74,0.12);color:#FF6B4A">
        <i class="bi bi-receipt"></i>
      </div>
      <div>
        <span class="stat-label">মোট অর্ডার</span>
        <strong class="stat-value">{{ $stats['total_orders'] }}</strong>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="stat-card">
      <div class="stat-icon" style="background:rgba(255,193,69,0.18);color:#B8860B">
        <i class="bi bi-hourglass-split"></i>
      </div>
      <div>
        <span class="stat-label">পেন্ডিং অর্ডার</span>
        <strong class="stat-value">{{ $stats['pending_orders'] }}</strong>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="stat-card">
      <div class="stat-icon" style="background:rgba(15,82,87,0.1);color:#0F5257">
        <i class="bi bi-box-seam"></i>
      </div>
      <div>
        <span class="stat-label">মোট প্রোডাক্ট</span>
        <strong class="stat-value">{{ $stats['total_products'] }}</strong>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="stat-card">
      <div class="stat-icon" style="background:rgba(108,117,125,0.12);color:#6c757d">
        <i class="bi bi-tags"></i>
      </div>
      <div>
        <span class="stat-label">মোট ক্যাটাগরি</span>
        <strong class="stat-value">{{ $stats['total_categories'] }}</strong>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-4">
    <div class="stat-card {{ $stats['low_stock'] > 0 ? 'stat-card--alert' : '' }}">
      <div class="stat-icon" style="background:rgba(220,53,69,0.1);color:#dc3545">
        <i class="bi bi-exclamation-triangle"></i>
      </div>
      <div>
        <span class="stat-label">লো স্টক (≤৫)</span>
        <strong class="stat-value">{{ $stats['low_stock'] }}</strong>
      </div>
    </div>
  </div>
</div>

<!-- Recent orders -->
<div class="admin-card">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h6 class="m-0">সাম্প্রতিক অর্ডার</h6>
    <span class="small text-muted">সর্বশেষ ৮টা অর্ডার</span>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>প্রোডাক্ট</th>
          <th>কাস্টমার</th>
          <th>ফোন</th>
          <th>পরিমাণ</th>
          <th>টোটাল</th>
          <th>পেমেন্ট</th>
          <th>স্ট্যাটাস</th>
          <th>সময়</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentOrders as $order)
        <tr>
          <td>#{{ $order->id }}</td>
          <td>{{ $order->product_name }}</td>
          <td>{{ $order->customer_name }}</td>
          <td>{{ $order->phone }}</td>
          <td>{{ $order->quantity }}</td>
          <td>৳{{ number_format($order->total_price) }}</td>
          <td>
            @if($order->payment_method === 'cod')
              <span class="badge bg-light text-dark border">COD</span>
            @else
              <span class="badge bg-light text-dark border">bKash</span>
            @endif
          </td>
          <td>
            @php
              $statusColors = [
                'pending'   => 'warning text-dark',
                'confirmed' => 'info text-dark',
                'shipped'   => 'primary',
                'delivered' => 'success',
                'cancelled' => 'danger',
              ];
            @endphp
            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">{{ $order->status }}</span>
          </td>
          <td class="text-muted small">{{ $order->created_at->diffForHumans() }}</td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center text-muted py-4">এখনো কোনো অর্ডার আসেনি</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('extra_head')
<style>
  .stat-card{
    background:#fff; border-radius:14px; padding:1.1rem 1.25rem;
    display:flex; align-items:center; gap:.9rem;
    box-shadow:0 4px 16px rgba(0,0,0,0.04);
    height:100%;
  }
  .stat-card--alert{ border: 1px solid rgba(220,53,69,0.3); }
  .stat-icon{
    width:44px; height:44px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.25rem; flex-shrink:0;
  }
  .stat-label{ display:block; font-size:.78rem; color:#6c757d; }
  .stat-value{ font-size:1.3rem; font-weight:700; color:#1A1A2E; }
</style>
@endsection