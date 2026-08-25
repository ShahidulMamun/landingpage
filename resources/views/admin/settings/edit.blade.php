@extends('admin.layout')
@section('title', 'সাইট সেটিংস')

@section('content')
<h4 class="mb-4">সাইট সেটিংস</h4>

@if(session('status'))
  <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
  @csrf @method('PUT')

  <div class="row g-4">

    <!-- Branding -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <h6 class="mb-3"><i class="bi bi-badge-tm"></i> ব্র্যান্ডিং</h6>

        <div class="mb-3">
          <label class="form-label">সাইটের নাম *</label>
          <input type="text" name="site_name" class="form-control @error('site_name') is-invalid @enderror" value="{{ old('site_name', $settings->site_name) }}" required>
          @error('site_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">ট্যাগলাইন</label>
          <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $settings->tagline) }}" placeholder="যেমন: একটাই ঠিকানা, সব কেনাকাটার">
        </div>

        <div class="mb-3">
          <label class="form-label">লোগো</label>
          @if($settings->logo)
            <div class="mb-2"><img src="{{ asset('storage/' . $settings->logo) }}" height="48"></div>
          @endif
          <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
          @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <div class="form-text">PNG, স্বচ্ছ ব্যাকগ্রাউন্ড হলে ভালো দেখাবে</div>
        </div>

        <div class="mb-0">
          <label class="form-label">ফ্যাভিকন</label>
          @if($settings->favicon)
            <div class="mb-2"><img src="{{ asset('storage/' . $settings->favicon) }}" height="32"></div>
          @endif
          <input type="file" name="favicon" class="form-control @error('favicon') is-invalid @enderror" accept="image/*">
          @error('favicon') <div class="invalid-feedback">{{ $message }}</div> @enderror
          <div class="form-text">বর্গাকার ছবি ভালো হয়, যেমন 32x32px বা 64x64px</div>
        </div>
      </div>
    </div>

    <!-- Contact -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <h6 class="mb-3"><i class="bi bi-telephone"></i> যোগাযোগের তথ্য</h6>

        <div class="mb-3">
          <label class="form-label">ঠিকানা</label>
          <input type="text" name="address" class="form-control" value="{{ old('address', $settings->address) }}" placeholder="যেমন: ১২৩, রোড ৫, ধানমন্ডি, ঢাকা">
        </div>

        <div class="row g-3 mb-3">
          <div class="col-6">
            <label class="form-label">ফোন নম্বর</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings->phone) }}" placeholder="01XXXXXXXXX">
          </div>
          <div class="col-6">
            <label class="form-label">WhatsApp নম্বর</label>
            <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $settings->whatsapp) }}" placeholder="01XXXXXXXXX">
          </div>
        </div>

        <div class="mb-0">
          <label class="form-label">ইমেইল</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings->email) }}" placeholder="support@yourdomain.com">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
    </div>

    <!-- Social -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <h6 class="mb-3"><i class="bi bi-share"></i> সোশ্যাল মিডিয়া লিংক</h6>

        <div class="mb-3">
          <label class="form-label"><i class="bi bi-facebook"></i> Facebook</label>
          <input type="url" name="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/yourpage">
          @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="bi bi-instagram"></i> Instagram</label>
          <input type="url" name="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/yourpage">
          @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label"><i class="bi bi-youtube"></i> YouTube</label>
          <input type="url" name="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/@yourchannel">
          @error('youtube_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-0">
          <label class="form-label"><i class="bi bi-tiktok"></i> TikTok</label>
          <input type="url" name="tiktok_url" class="form-control @error('tiktok_url') is-invalid @enderror" value="{{ old('tiktok_url', $settings->tiktok_url) }}" placeholder="https://tiktok.com/@yourpage">
          @error('tiktok_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
    </div>

    <!-- SEO / Footer -->
    <div class="col-lg-6">
      <div class="admin-card h-100">
        <h6 class="mb-3"><i class="bi bi-search"></i> SEO ও ফুটার</h6>

        <div class="mb-3">
          <label class="form-label">মেটা ডেসক্রিপশন</label>
          <textarea name="meta_description" class="form-control" rows="2" maxlength="300">{{ old('meta_description', $settings->meta_description) }}</textarea>
          <div class="form-text">গুগল সার্চ রেজাল্টে যে টেক্সট দেখাবে (৩০০ ক্যারেক্টারের মধ্যে)</div>
        </div>

        <div class="mb-0">
          <label class="form-label">ফুটার "আমাদের সম্পর্কে" টেক্সট</label>
          <textarea name="footer_about" class="form-control" rows="3">{{ old('footer_about', $settings->footer_about) }}</textarea>
        </div>
      </div>
    </div>

  </div>

  <button type="submit" class="btn btn-admin-primary mt-4">
    <i class="bi bi-check2-circle"></i> সেটিংস সেভ করো
  </button>
</form>
@endsection