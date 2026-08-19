@extends('admin.layout')
@section('title', 'অর্ডার ম্যানেজমেন্ট')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">অর্ডার ({{ $counts['all'] }})</h4>
</div>

<!-- Status tabs -->
<div class="order-tabs mb-3">
  <a href="{{ route('admin.orders.index') }}" class="order-tab {{ !request('status') ? 'active' : '' }}">
    সব <span>{{ $counts['all'] }}</span>
  </a>
  <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="order-tab {{ request('status') === 'pending' ? 'active' : '' }}">
    পেন্ডিং <span>{{ $counts['pending'] }}</span>
  </a>
  <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" class="order-tab {{ request('status') === 'confirmed' ? 'active' : '' }}">
    কনফার্মড <span>{{ $counts['confirmed'] }}</span>
  </a>
  <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="order-tab {{ request('status') === 'shipped' ? 'active' : '' }}">
    শিপড <span>{{ $counts['shipped'] }}</span>
  </a>
  <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="order-tab {{ request('status') === 'delivered' ? 'active' : '' }}">
    ডেলিভারড <span>{{ $counts['delivered'] }}</span>
  </a>
  <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="order-tab {{ request('status') === 'cancelled' ? 'active' : '' }}">
    বাতিল <span>{{ $counts['cancelled'] }}</span>
  </a>
</div>

<div class="admin-card">
  <form method="GET" class="row g-2 mb-3">
    @if(request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <div class="col-md-5">
      <input type="text" name="q" class="form-control" placeholder="নাম, ফোন বা অর্ডার নম্বর দিয়ে খুঁজো" value="{{ request('q') }}">
    </div>
    <div class="col-md-3">
      <select name="payment_status" class="form-select" onchange="this.form.submit()">
        <option value="">সব পেমেন্ট স্ট্যাটাস</option>
        <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
        <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-admin-primary w-100">খুঁজো</button>
    </div>
    @if(request()->anyFilled(['q','payment_status','status']))
    <div class="col-md-2">
      <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">রিসেট</a>
    </div>
    @endif
  </form>

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
          <th class="text-end">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr>
          <td>#{{ $order->id }}</td>
          <td>{{ $order->product_name }}</td>
          <td>{{ $order->customer_name }}</td>
          <td>{{ $order->phone }}</td>
          <td>{{ $order->quantity }}</td>
          <td>৳{{ number_format($order->total_price) }}</td>
          <td>
            @php
              $payColors = ['unpaid' => 'secondary', 'paid' => 'success', 'refunded' => 'danger'];
            @endphp
            <span class="badge bg-{{ $payColors[$order->payment_status] ?? 'secondary' }}">{{ $order->payment_status }}</span>
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
          <td class="text-end">
            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-eye"></i> দেখো
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="10" class="text-center text-muted py-4">কোনো অর্ডার পাওয়া যায়নি</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">{{ $orders->links() }}</div>
</div>
@endsection

@section('extra_head')
<style>
  .order-tabs{ display:flex; gap:.4rem; flex-wrap:wrap; }
  .order-tab{
    background:#fff; border-radius:100px; padding:.45rem 1rem;
    font-size:.85rem; color:#1A1A2E; border:1px solid rgba(0,0,0,0.08);
  }
  .order-tab span{ color:#6c757d; margin-left:.3rem; }
  .order-tab.active{ background:#0F5257; color:#fff; border-color:#0F5257; }
  .order-tab.active span{ color:rgba(255,255,255,0.75); }
</style>
@endsection