@extends('admin.layout')
@section('title', 'FAQ প্রশ্ন')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
  <h4 class="m-0">FAQ প্রশ্ন ({{ $faqs->total() }})</h4>
  <a href="{{ route('admin.faqs.create') }}" class="btn btn-admin-primary">
    <i class="bi bi-plus-lg"></i> নতুন প্রশ্ন
  </a>
</div>

<div class="admin-card">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>প্রশ্ন</th>
          <th>স্ট্যাটাস</th>
          <th>অর্ডার</th>
          <th class="text-end">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        @forelse($faqs as $faq)
        <tr>
          <td style="max-width:480px">{{ $faq->question }}</td>
          <td>
            @if($faq->is_active)
              <span class="badge bg-success">অ্যাক্টিভ</span>
            @else
              <span class="badge bg-secondary">ইনঅ্যাক্টিভ</span>
            @endif
          </td>
          <td>{{ $faq->sort_order }}</td>
          <td class="text-end">
            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-secondary">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('ডিলিট করবে?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="text-center text-muted py-4">কোনো প্রশ্ন নেই — "নতুন প্রশ্ন" এ ক্লিক করে যোগ করো</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">{{ $faqs->links() }}</div>
</div>
@endsection