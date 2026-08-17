@extends('admin.layout')
@section('title', 'প্রোডাক্ট এডিট')

@section('content')
<h4 class="mb-4">প্রোডাক্ট এডিট করুন</h4>

<div class="admin-card" style="max-width:680px">
  <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">ক্যাটাগরি *</label>
      <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
      </select>
      @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">প্রোডাক্টের নাম *</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">বিবরণ</label>
      <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-6">
        <label class="form-label">দাম (৳) *</label>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" min="0" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
      <div class="col-6">
        <label class="form-label">আগের দাম (৳) — ঐচ্ছিক</label>
        <input type="number" name="old_price" class="form-control @error('old_price') is-invalid @enderror" value="{{ old('old_price', $product->old_price) }}" min="0">
        @error('old_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-6">
        <label class="form-label">স্টক পরিমাণ *</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0" required>
      </div>
      <div class="col-6">
        <label class="form-label">ব্যাজ টেক্সট — ঐচ্ছিক</label>
        <input type="text" name="badge" class="form-control" value="{{ old('badge', $product->badge) }}">
      </div>
    </div>

    @if($product->image)
      <div class="mb-3">
        <img src="{{ asset('storage/' . $product->image) }}" width="90" style="border-radius:8px">
      </div>
    @endif

    <div class="mb-3">
      <label class="form-label">নতুন ছবি (পরিবর্তন করতে চাইলে)</label>
      <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
      @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="form-check form-switch mb-2">
      <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
      <label class="form-check-label" for="isFeatured">ফিচার্ড / বেস্ট সেলার (ল্যান্ডিং পেজে দেখাবে)</label>
    </div>
    <div class="form-check form-switch mb-4">
      <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
      <label class="form-check-label" for="isActive">অ্যাক্টিভ</label>
    </div>

    <button type="submit" class="btn btn-admin-primary">আপডেট করুন</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">বাতিল</a>
  </form>
</div>
@endsection