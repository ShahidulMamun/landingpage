@extends('admin.layout')
@section('title', 'নিউজলেটার সাবস্ক্রাইবার')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="m-0">সাবস্ক্রাইবার ({{ $counts['all'] }})</h4>
  <a href="{{ route('admin.subscribers.export', request()->only('status')) }}" class="btn btn-outline-secondary">
    <i class="bi bi-download"></i> CSV এক্সপোর্ট
  </a>
</div>

<div class="order-tabs mb-3">
  <a href="{{ route('admin.subscribers.index') }}" class="order-tab {{ !request('status') ? 'active' : '' }}">
    সব <span>{{ $counts['all'] }}</span>
  </a>
  <a href="{{ route('admin.subscribers.index', ['status' => 'subscribed']) }}" class="order-tab {{ request('status') === 'subscribed' ? 'active' : '' }}">
    সাবস্ক্রাইবড <span>{{ $counts['subscribed'] }}</span>
  </a>
  <a href="{{ route('admin.subscribers.index', ['status' => 'unsubscribed']) }}" class="order-tab {{ request('status') === 'unsubscribed' ? 'active' : '' }}">
    আনসাবস্ক্রাইবড <span>{{ $counts['unsubscribed'] }}</span>
  </a>
</div>

<div class="admin-card">
  <form method="GET" class="row g-2 mb-3">
    @if(request('status'))
      <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    <div class="col-md-6">
      <input type="text" name="q" class="form-control" placeholder="ইমেইল দিয়ে খুঁজো" value="{{ request('q') }}">
    </div>
    <div class="col-md-2">
      <button class="btn btn-admin-primary w-100">খুঁজো</button>
    </div>
    @if(request()->anyFilled(['q','status']))
    <div class="col-md-2">
      <a href="{{ route('admin.subscribers.index') }}" class="btn btn-outline-secondary w-100">রিসেট</a>
    </div>
    @endif
  </form>

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>ইমেইল</th>
          <th>স্ট্যাটাস</th>
          <th>সাবস্ক্রাইব করেছে</th>
          <th>আনসাবস্ক্রাইব করেছে</th>
          <th class="text-end">অ্যাকশন</th>
        </tr>
      </thead>
      <tbody>
        @forelse($subscribers as $s)
        <tr>
          <td>{{ $s->email }}</td>
          <td>
            @if($s->status === 'subscribed')
              <span class="badge bg-success">সাবস্ক্রাইবড</span>
            @else
              <span class="badge bg-secondary">আনসাবস্ক্রাইবড</span>
            @endif
          </td>
          <td class="text-muted small">{{ optional($s->subscribed_at)->format('d M Y') ?? '—' }}</td>
          <td class="text-muted small">{{ optional($s->unsubscribed_at)->format('d M Y') ?? '—' }}</td>
          <td class="text-end">
            <form action="{{ route('admin.subscribers.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('ডিলিট করবে?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-4">কোনো সাবস্ক্রাইবার নেই</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">{{ $subscribers->links() }}</div>
</div>
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