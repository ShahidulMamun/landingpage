@extends('admin.layout')
@section('title', 'প্রোডাক্ট লিস্ট')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="m-0">প্রোডাক্ট ({{ $products->total() }})</h4>
  <a href="{{ route('admin.products.create') }}" class="btn btn-admin-primary">
    <i class="bi bi-plus-lg"></i> নতুন প্রোডাক্ট
  </a>
</div>

<div class="admin-card">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ছবি</th>
          <th>নাম</th>
          <th>ক্যাটাগরি</th>
          <th>দাম</th>
          <th>স্টক</th>
          <th>স্ট্যাটাস</th>
          <th class="text-end">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $p)
        <tr>
          <td>
            @if($p->image)
              <img src="{{ asset('storage/' . $p->image) }}" width="48" height="48" style="object-fit:cover;border-radius:8px">
            @else
              <div class="bg-light" style="width:48px;height:48px;border-radius:8px"></div>
            @endif
          </td>
          <td>
            {{ $p->name }}
            @if($p->is_featured) <span class="badge bg-warning text-dark">ফিচার্ড</span> @endif
          </td>
          <td>{{ $p->category->name ?? '—' }}</td>
          <td>
            ৳{{ number_format($p->price) }}
            @if($p->old_price)
              <span class="text-muted text-decoration-line-through small">৳{{ number_format($p->old_price) }}</span>
            @endif
          </td>
          <td>{{ $p->stock }}</td>
          <td>
            @if($p->is_active)
              <span class="badge bg-success">অ্যাক্টিভ</span>
            @else
              <span class="badge bg-secondary">ইনঅ্যাক্টিভ</span>
            @endif
          </td>
          <td class="text-end">
            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('ডিলিট করবে?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-4">কোনো প্রোডাক্ট নেই</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">{{ $products->links() }}</div>
</div>
@endsection