@extends('admin.layout')
@section('title', 'FAQ প্রশ্ন এডিট')

@section('content')
<h4 class="mb-4">প্রশ্ন এডিট করুন</h4>

<div class="admin-card" style="max-width:680px">
  <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">প্রশ্ন *</label>
      <input type="text" name="question" class="form-control @error('question') is-invalid @enderror" value="{{ old('question', $faq->question) }}" required>
      @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">উত্তর *</label>
      <textarea name="answer" class="form-control @error('answer') is-invalid @enderror" rows="4" required>{{ old('answer', $faq->answer) }}</textarea>
      @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">সর্ট অর্ডার</label>
      <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $faq->sort_order) }}" min="0">
    </div>

    <div class="form-check form-switch mb-4">
      <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" {{ $faq->is_active ? 'checked' : '' }}>
      <label class="form-check-label" for="isActive">অ্যাক্টিভ (FAQ পেজে দেখাবে)</label>
    </div>

    <button type="submit" class="btn btn-admin-primary">আপডেট করুন</button>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">বাতিল</a>
  </form>
</div>
@endsection