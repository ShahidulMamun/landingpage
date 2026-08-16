@extends('admin.layout')
@section('title', 'ক্যাটাগরি লিস্ট')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="m-0">ক্যাটাগরি ({{ $categories->total() }})</h4>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-admin-primary">
    <i class="bi bi-plus-lg"></i> নতুন ক্যাটাগরি
  </a>
</div>

<div class="admin-card">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ছবি</th>
          <th>নাম</th>
          <th>স্ট্যাটাস</th>
          <th>অর্ডার</th>
          <th class="text-end">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $cat)
        <tr>
          <td>
            @if($cat->image)
              <img src="{{ asset('storage/' . $cat->image) }}" width="48" height="48" style="object-fit:cover;border-radius:8px">
            @else
              <div class="bg-light" style="width:48px;height:48px;border-radius:8px"></div>
            @endif
          </td>
          <td>{{ $cat->name }}</td>
          <td>
            @if($cat->is_active)
              <span class="badge bg-success">অ্যাক্টিভ</span>
            @else
              <span class="badge bg-secondary">ইনঅ্যাক্টিভ</span>
            @endif
          </td>
          <td>{{ $cat->sort_order }}</td>
          <td class="text-end">
            <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('ডিলিট করবে?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-4">কোনো ক্যাটাগরি নেই</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">{{ $categories->links() }}</div>
</div>
@endsection