@extends('admin.layout')
@section('title', 'নতুন ক্যাটাগরি')

@section('content')
<h4 class="mb-4">নতুন ক্যাটাগরি যোগ করুন</h4>

<div class="admin-card" style="max-width:560px">
  <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label class="form-label">নাম *</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">ছবি</label>
      <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
      @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">সর্ট অর্ডার</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
    </div>

    <div class="form-check form-switch mb-4">
      <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" checked>
      <label class="form-check-label" for="isActive">অ্যাক্টিভ</label>
    </div>

    <button type="submit" class="btn btn-admin-primary">সেভ করুন</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">বাতিল</a>
  </form>
</div>
@endsection