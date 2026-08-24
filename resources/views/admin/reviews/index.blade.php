@extends('admin.layout')
@section('title', 'কাস্টমার রিভিউ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">রিভিউ ({{ $counts['all'] }})</h4>
</div>

{{-- @if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif --}}

<div class="order-tabs mb-3">
  <a href="{{ route('admin.reviews.index') }}" class="order-tab {{ !request('status') ? 'active' : '' }}">
    সব <span>{{ $counts['all'] }}</span>
  </a>
  <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="order-tab {{ request('status') === 'pending' ? 'active' : '' }}">
    পেন্ডিং <span>{{ $counts['pending'] }}</span>
  </a>
  <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="order-tab {{ request('status') === 'approved' ? 'active' : '' }}">
    অ্যাপ্রুভড <span>{{ $counts['approved'] }}</span>
  </a>
  <a href="{{ route('admin.reviews.index', ['status' => 'rejected']) }}" class="order-tab {{ request('status') === 'rejected' ? 'active' : '' }}">
    বাতিল <span>{{ $counts['rejected'] }}</span>
  </a>
</div>

<div class="row g-3">
  @forelse($reviews as $r)
  <div class="col-12">
    <div class="admin-card d-flex justify-content-between align-items-start flex-wrap gap-3">
      <div style="max-width:70%">
        <div class="mb-1">
          @for($i = 1; $i <= 5; $i++)
            <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}" style="color:#FFC145"></i>
          @endfor
          <strong class="ms-2">{{ $r->customer_name }}</strong>
          @if($r->city) <span class="text-muted small">— {{ $r->city }}</span> @endif
          @if($r->product) <span class="badge bg-light text-dark border ms-2">{{ $r->product->name }}</span> @endif
        </div>
        <p class="mb-1">{{ $r->comment }}</p>
        <span class="text-muted small">{{ $r->created_at->diffForHumans() }}</span>
      </div>

      <div class="d-flex flex-column align-items-end gap-2">
        @php
          $colors = ['pending' => 'warning text-dark', 'approved' => 'success', 'rejected' => 'danger'];
        @endphp
        <span class="badge bg-{{ $colors[$r->status] ?? 'secondary' }}">{{ $r->status }}</span>

        <div class="d-flex gap-1">
          @if($r->status !== 'approved')
          <form action="{{ route('admin.reviews.update', $r) }}" method="POST">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="approved">
            <button class="btn btn-sm btn-outline-success"><i class="bi bi-check-lg"></i></button>
          </form>
          @endif
          @if($r->status !== 'rejected')
          <form action="{{ route('admin.reviews.update', $r) }}" method="POST">
            @csrf @method('PUT')
            <input type="hidden" name="status" value="rejected">
            <button class="btn btn-sm btn-outline-warning"><i class="bi bi-x-lg"></i></button>
          </form>
          @endif
          <form action="{{ route('admin.reviews.destroy', $r) }}" method="POST" onsubmit="return confirm('ডিলিট করবে?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="col-12">
    <div class="admin-card text-center text-muted py-4">কোনো রিভিউ নেই</div>
  </div>
  @endforelse
</div>

<div class="mt-3">{{ $reviews->links() }}</div>
@endsection

@section('extra_head')
<style>
  .order-tabs{ display:flex; gap:.4rem; flex-wrap:wrap; }
  .order-tab{
    background:#fff; border-radius:100px; padding:.45rem 1rem;
    font-size:.85rem; color:#1A1A2E; border:1px solid rgba(0,0,0,0.08);
  }
  .order-tabs a{
    text-decoration: none;
  }
  .order-tab span{ color:#6c757d; margin-left:.3rem; }
  .order-tab.active{ background:#E85535; color:#fff; border-color:#E85535; }
  .order-tab.active span{ color:rgba(255,255,255,0.75); }
</style>
@endsection