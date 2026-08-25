<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $siteSettings->site_name ?? 'ShopKori' }} @if($siteSettings->tagline ?? false) — {{ $siteSettings->tagline }} @endif</title>
<meta name="description" content="{{ $siteSettings->meta_description ?? 'সেরা দামে অথেনটিক প্রোডাক্ট, ক্যাশ অন ডেলিভারি সহ সারা বাংলাদেশে ফাস্ট ডেলিভারি।' }}">
@if($siteSettings->favicon ?? false)
<link rel="icon" href="{{ asset('storage/' . $siteSettings->favicon) }}">
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Custom -->
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg sk-navbar sticky-top">
  <div class="container">
    @if($siteSettings->logo ?? false)
      <a class="navbar-brand" href="{{ route('landing') }}">
        <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name }}" height="36">
      </a>
    @else
      <a class="navbar-brand sk-logo" href="{{ route('landing') }}">Shop<span>Kori</span></a>
    @endif
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#skNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="skNav">
      <ul class="navbar-nav mx-auto gap-lg-4">
        <li class="nav-item"><a class="nav-link" href="#categories">ক্যাটাগরি</a></li>
        <li class="nav-item"><a class="nav-link" href="#products">প্রোডাক্টস</a></li>
        <li class="nav-item"><a class="nav-link" href="#how-to-order">অর্ডার প্রসেস</a></li>
        <li class="nav-item"><a class="nav-link" href="#why">কেন আমরা</a></li>
        <li class="nav-item"><a class="nav-link" href="#reviews">রিভিউ</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        <a href="#" class="sk-icon-btn"><i class="bi bi-search"></i></a>
        <a href="#" class="sk-icon-btn position-relative">
          <i class="bi bi-bag"></i>
          <span class="sk-cart-count">3</span>
        </a>
        <a href="#products" class="btn sk-btn-primary d-none d-lg-inline-flex">শপিং শুরু করুন</a>
      </div>
    </div>
  </div>
</nav>

<!-- ===== HERO ===== -->
<header class="sk-hero">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6" data-reveal>
        <span class="sk-eyebrow">🔥 ঈদ কালেকশন লাইভ</span>
        <h1 class="sk-hero-title">
          কেনাকাটা হোক<br>
          <span class="sk-italic">ঝামেলাহীন</span> ও আনন্দের
        </h1>
        <p class="sk-hero-sub">
          ফ্যাশন, ইলেকট্রনিক্স, লাইফস্টাইল — সবকিছু একই প্ল্যাটফর্মে। অরিজিনাল প্রোডাক্ট,
          সবচেয়ে ভালো দাম, আর দুয়ারে ডেলিভারি।
        </p>
        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="#products" class="btn sk-btn-primary btn-lg">এখনই কিনুন</a>
          <a href="#categories" class="btn sk-btn-ghost btn-lg">ক্যাটাগরি দেখুন</a>
        </div>
        <div class="sk-hero-trust mt-5">
          <div><strong>৫০k+</strong><span>খুশি কাস্টমার</span></div>
          <div class="sk-divider"></div>
          <div><strong>৪.৮/৫</strong><span>গড় রেটিং</span></div>
          <div class="sk-divider"></div>
          <div><strong>৬৪</strong><span>জেলায় ডেলিভারি</span></div>
        </div>
      </div>
      <div class="col-lg-6" data-reveal data-reveal-delay="150">
        <div class="sk-hero-visual">
          <div class="sk-hero-card sk-hero-card--main">
            <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?q=80&w=800&auto=format&fit=crop" alt="Featured product">
            <div class="sk-price-tag">
              <span class="sk-price-old">৳ ৩,৫০০</span>
              <span class="sk-price-new">৳ ২,১৯৯</span>
            </div>
          </div>
          <div class="sk-hero-card sk-hero-card--float sk-float-1">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=400&auto=format&fit=crop" alt="Watch">
            <span class="sk-tag-mini">নতুন</span>
          </div>
          <div class="sk-hero-card sk-hero-card--float sk-float-2">
            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=400&auto=format&fit=crop" alt="Shoes">
            <span class="sk-tag-mini sk-tag-mini--sale">৩৫% ছাড়</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===== TRUST BAR ===== -->
<section class="sk-trustbar">
  <div class="container">
    <div class="row text-center gy-4">
      <div class="col-6 col-lg-3">
        <i class="bi bi-cash-coin"></i>
        <p>ক্যাশ অন ডেলিভারি</p>
      </div>
      <div class="col-6 col-lg-3">
        <i class="bi bi-truck"></i>
        <p>২৪-৭২ ঘণ্টায় ডেলিভারি</p>
      </div>
      <div class="col-6 col-lg-3">
        <i class="bi bi-arrow-repeat"></i>
        <p>৭ দিনের ইজি রিটার্ন</p>
      </div>
      <div class="col-6 col-lg-3">
        <i class="bi bi-shield-check"></i>
        <p>১০০% অরিজিনাল প্রোডাক্ট</p>
      </div>
    </div>
  </div>
</section>

<!-- ===== CATEGORIES ===== -->
<section class="sk-section" id="categories">
  <div class="container">
    <div class="sk-section-head" data-reveal>
      <span class="sk-eyebrow">শপ বাই ক্যাটাগরি</span>
      <h2>যা খুঁজছেন, দ্রুত খুঁজে নিন</h2>
    </div>
    <div class="row g-4">
      @forelse($categories as $cat)
      <div class="col-6 col-lg-3" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <a href="{{ route('landing') }}#products" class="sk-cat-card">
          <img src="{{ $cat->image ? asset('storage/' . $cat->image) : 'https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $cat->name }}">
          <span>{{ $cat->name }}</span>
        </a>
      </div>
      @empty
      <p class="text-center text-muted">এখনো কোনো ক্যাটাগরি যোগ করা হয়নি — অ্যাডমিন প্যানেল থেকে যোগ করো।</p>
      @endforelse
    </div>
  </div>
</section>

<!-- ===== PRODUCTS ===== -->
<section class="sk-section sk-section--muted" id="products">
  <div class="container">
    <div class="sk-section-head" data-reveal>
      <span class="sk-eyebrow">বেস্ট সেলার</span>
      <h2>এই সপ্তাহের সেরা পিকস</h2>
    </div>
    <div class="row g-4">
      @forelse($products as $p)
      <div class="col-6 col-lg-3" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <div class="sk-product-card"
             data-id="{{ $p->id }}"
             data-name="{{ $p->name }}"
             data-price="{{ $p->price }}"
             data-old="{{ $p->old_price }}"
             data-img="{{ $p->image ? asset('storage/' . $p->image) : '' }}"
             data-desc="{{ $p->description }}">
          <div class="sk-product-img sk-open-details" role="button" tabindex="0">
            <img src="{{ $p->image ? asset('storage/' . $p->image) : 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=500&auto=format&fit=crop' }}" alt="{{ $p->name }}">
            @if($p->badge)
              <span class="sk-badge">{{ $p->badge }}</span>
            @endif
            <button class="sk-wishlist" onclick="event.stopPropagation()"><i class="bi bi-heart"></i></button>
          </div>
          <div class="sk-product-body">
            <h6 class="sk-open-details" role="button" tabindex="0">{{ $p->name }}</h6>
            <div class="sk-product-price">
              <span class="sk-price-new">৳{{ number_format($p->price) }}</span>
              @if($p->old_price)
                <span class="sk-price-old">৳{{ number_format($p->old_price) }}</span>
              @endif
            </div>
            <div class="d-flex gap-2 mt-2">
              <button class="btn sk-btn-cart sk-open-details flex-fill">
                <i class="bi bi-eye"></i> বিস্তারিত
              </button>
              <button class="btn sk-btn-primary sk-open-order flex-fill">
                <i class="bi bi-lightning-charge-fill"></i> অর্ডার করুন
              </button>
            </div>
          </div>
        </div>
      </div>
      @empty
      <p class="text-center text-muted">এখনো কোনো ফিচার্ড প্রোডাক্ট নেই — অ্যাডমিন প্যানেল থেকে প্রোডাক্ট যোগ করে "ফিচার্ড" টিক দাও।</p>
      @endforelse
    </div>
    <div class="text-center mt-5" data-reveal>
      <a href="#" class="btn sk-btn-ghost btn-lg">সব প্রোডাক্ট দেখুন</a>
    </div>
  </div>
</section>

<!-- ===== HOW TO ORDER ===== -->
<section class="sk-section" id="how-to-order">
  <div class="container">
    <div class="sk-section-head" data-reveal>
      <span class="sk-eyebrow">সহজ ৪ ধাপ</span>
      <h2>মাত্র কয়েক ক্লিকে অর্ডার করুন</h2>
    </div>
    <div class="row g-4">
      @php
        $steps = [
          ['num' => '০১', 'icon' => 'bi-bag-heart', 'title' => 'প্রোডাক্ট বাছাই করুন', 'desc' => 'পছন্দের প্রোডাক্টে ক্লিক করে বিস্তারিত দেখুন'],
          ['num' => '০২', 'icon' => 'bi-pencil-square', 'title' => 'ফর্ম পূরণ করুন', 'desc' => 'নাম, ফোন নম্বর ও ঠিকানা দিন — মাত্র ৩০ সেকেন্ড'],
          ['num' => '০৩', 'icon' => 'bi-telephone-outbound', 'title' => 'কনফার্মেশন কল', 'desc' => 'আমাদের টিম কল করে অর্ডার নিশ্চিত করবে'],
          ['num' => '০৪', 'icon' => 'bi-box-seam', 'title' => 'হাতে পেয়ে টাকা দিন', 'desc' => 'প্রোডাক্ট হাতে পেয়ে ক্যাশ অন ডেলিভারিতে পেমেন্ট'],
        ];
      @endphp
      @foreach($steps as $s)
      <div class="col-6 col-lg-3" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <div class="sk-step-card">
          <span class="sk-step-num">{{ $s['num'] }}</span>
          <i class="bi {{ $s['icon'] }}"></i>
          <h6>{{ $s['title'] }}</h6>
          <p>{{ $s['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-4" data-reveal>
      <a href="#products" class="btn sk-btn-primary btn-lg">
        <i class="bi bi-lightning-charge-fill"></i> এখনই অর্ডার শুরু করুন
      </a>
    </div>
  </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="sk-section" id="why">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5" data-reveal>
        <span class="sk-eyebrow">কেন ShopKori</span>
        <h2 class="mb-4">কেনাকাটা যেন হয় বিশ্বস্ত অভিজ্ঞতা</h2>
        <p class="text-muted">আমরা জানি অনলাইন শপিংয়ে সবচেয়ে বড় চিন্তা— প্রোডাক্ট আসল কিনা, আর সময়মতো
        পাবেন কিনা। তাই প্রতিটি ধাপে আমরা রেখেছি স্বচ্ছতা আর নিশ্চয়তা।</p>
      </div>
      <div class="col-lg-7">
        <div class="row g-4">
          @php
            $features = [
              ['icon' => 'bi-patch-check', 'title' => 'ভেরিফাইড সেলার', 'desc' => 'প্রতিটি সেলার আগে যাচাই করা হয়'],
              ['icon' => 'bi-lightning-charge', 'title' => 'ফাস্ট প্রসেসিং', 'desc' => 'অর্ডারের ২৪ ঘণ্টার মধ্যে শিপমেন্ট'],
              ['icon' => 'bi-headset', 'title' => '২৪/৭ সাপোর্ট', 'desc' => 'যেকোনো সময় লাইভ চ্যাটে সাহায্য'],
              ['icon' => 'bi-wallet2', 'title' => 'সহজ পেমেন্ট', 'desc' => 'bKash, Nagad, কার্ড বা COD'],
            ];
          @endphp
          @foreach($features as $f)
          <div class="col-sm-6" data-reveal>
            <div class="sk-feature-item">
              <i class="bi {{ $f['icon'] }}"></i>
              <div>
                <h6>{{ $f['title'] }}</h6>
                <p>{{ $f['desc'] }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section class="sk-section sk-section--dark" id="reviews">
  <div class="container">
    <div class="sk-section-head" data-reveal>
      <span class="sk-eyebrow sk-eyebrow--light">কাস্টমার বলছেন</span>
      <h2 class="text-white">যারা কিনেছেন, তারাই বলছেন সেরা</h2>
    </div>
    <div class="row g-4">
      @forelse($reviews as $r)
      <div class="col-lg-4" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <div class="sk-review-card">
          <span class="sk-verified"><i class="bi bi-patch-check-fill"></i> ভেরিফাইড ক্রেতা</span>
          <div class="mb-2">
            @for($i = 1; $i <= 5; $i++)
              <i class="bi {{ $i <= $r->rating ? 'bi-star-fill' : 'bi-star' }}" style="color:#FFC145;font-size:.85rem"></i>
            @endfor
          </div>
          <p>"{{ $r->comment }}"</p>
          <div class="sk-review-author">
            <div class="sk-avatar">{{ mb_substr($r->customer_name, 0, 1) }}</div>
            <div>
              <strong>{{ $r->customer_name }}</strong>
              @if($r->city)<span>{{ $r->city }}</span>@endif
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center">
        <p class="text-white-50">এখনো কোনো রিভিউ অ্যাপ্রুভ করা হয়নি।</p>
      </div>
      @endforelse
    </div>
    <div class="text-center mt-5" data-reveal>
      <a href="{{ route('reviews.create') }}" class="btn sk-btn-ghost" style="border-color:rgba(255,255,255,0.3);color:#fff">
        <i class="bi bi-pencil-square"></i> তোমার অভিজ্ঞতা শেয়ার করো
      </a>
    </div>
  </div>
</section>

<!-- ===== NEWSLETTER / APP CTA ===== -->
<section class="sk-cta-band" data-reveal>
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-7">
        <h3>প্রতি সপ্তাহে নতুন অফার সরাসরি আপনার ইনবক্সে</h3>
        <p>এক্সক্লুসিভ ডিসকাউন্ট আর নতুন প্রোডাক্ট লঞ্চের খবর সবার আগে পান।</p>
      </div>
      <div class="col-lg-5">
        <form class="sk-newsletter-form" id="skNewsletterForm">
          <input type="email" name="email" placeholder="আপনার ইমেইল দিন" required>
          <button type="submit" class="btn sk-btn-primary">সাবস্ক্রাইব</button>
        </form>
        <p class="sk-newsletter-msg small mt-2 mb-0 d-none"></p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="sk-footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-3">
        @if($siteSettings->logo ?? false)
          <a href="{{ route('landing') }}"><img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="{{ $siteSettings->site_name }}" height="32"></a>
        @else
          <a class="sk-logo sk-logo--footer" href="{{ route('landing') }}">Shop<span>Kori</span></a>
        @endif
        <p>{{ $siteSettings->footer_about ?? 'বাংলাদেশের সবচেয়ে বিশ্বস্ত অনলাইন শপিং ডেস্টিনেশন।' }}</p>
        @if(($siteSettings->facebook_url ?? false) || ($siteSettings->instagram_url ?? false) || ($siteSettings->youtube_url ?? false) || ($siteSettings->tiktok_url ?? false))
        <div class="sk-social">
          @if($siteSettings->facebook_url ?? false)<a href="{{ $siteSettings->facebook_url }}" target="_blank"><i class="bi bi-facebook"></i></a>@endif
          @if($siteSettings->instagram_url ?? false)<a href="{{ $siteSettings->instagram_url }}" target="_blank"><i class="bi bi-instagram"></i></a>@endif
          @if($siteSettings->youtube_url ?? false)<a href="{{ $siteSettings->youtube_url }}" target="_blank"><i class="bi bi-youtube"></i></a>@endif
          @if($siteSettings->tiktok_url ?? false)<a href="{{ $siteSettings->tiktok_url }}" target="_blank"><i class="bi bi-tiktok"></i></a>@endif
        </div>
        @endif
      </div>
      <div class="col-6 col-lg-2">
        <h6>কোম্পানি</h6>
        <ul>
          <li><a href="#">আমাদের সম্পর্কে</a></li>
          <li><a href="#">ক্যারিয়ার</a></li>
          <li><a href="#">যোগাযোগ</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h6>সাপোর্ট</h6>
        <ul>
          <li><a href="#">রিটার্ন পলিসি</a></li>
          <li><a href="#">শিপিং তথ্য</a></li>
          <li><a href="{{ route('faq') }}">FAQ</a></li>
        </ul>
      </div>
      @if(($siteSettings->address ?? false) || ($siteSettings->phone ?? false) || ($siteSettings->email ?? false))
      <div class="col-6 col-lg-2">
        <h6>যোগাযোগ</h6>
        <ul>
          @if($siteSettings->address ?? false)<li><i class="bi bi-geo-alt"></i> {{ $siteSettings->address }}</li>@endif
          @if($siteSettings->phone ?? false)<li><a href="tel:{{ $siteSettings->phone }}"><i class="bi bi-telephone"></i> {{ $siteSettings->phone }}</a></li>@endif
          @if($siteSettings->email ?? false)<li><a href="mailto:{{ $siteSettings->email }}"><i class="bi bi-envelope"></i> {{ $siteSettings->email }}</a></li>@endif
        </ul>
      </div>
      @endif
      <div class="col-lg-3">
        <h6>পেমেন্ট মেথড</h6>
        <div class="sk-payment-icons">
          <span>bKash</span><span>Nagad</span><span>Rocket</span><span>Visa</span><span>COD</span>
        </div>
      </div>
    </div>
    <hr>
    <p class="sk-copyright">© {{ date('Y') }} {{ $siteSettings->site_name ?? 'ShopKori' }}. সর্বস্বত্ব সংরক্ষিত।</p>
  </div>
</footer>

<!-- ===== PRODUCT DETAILS + QUICK ORDER MODAL ===== -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content sk-modal">

      <!-- Success state -->
      <div class="sk-order-success d-none text-center p-5">
        <i class="bi bi-check-circle-fill"></i>
        <h4 class="mt-3">অর্ডার সফলভাবে সাবমিট হয়েছে!</h4>
        <p class="text-muted">আমাদের টিম শীঘ্রই আপনার দেওয়া নম্বরে কল করে অর্ডার নিশ্চিত করবে।</p>
        <button type="button" class="btn sk-btn-primary mt-2" data-bs-dismiss="modal">ঠিক আছে</button>
      </div>

      <!-- Main content -->
      <div class="sk-order-body">
        <button type="button" class="btn-close sk-modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="row g-0">

          <!-- Product summary -->
          <div class="col-md-5 sk-modal-product">
            <img id="omProductImg" src="" alt="">
            <div class="sk-modal-product-info">
              <h5 id="omProductName">—</h5>
              <p id="omProductDesc" class="text-muted small"></p>
              <div class="sk-product-price mb-3">
                <span class="sk-price-new" id="omProductPrice">৳0</span>
                <span class="sk-price-old" id="omProductOld"></span>
              </div>
              <div class="sk-qty-stepper">
                <button type="button" id="omQtyMinus"><i class="bi bi-dash"></i></button>
                <span id="omQtyValue">1</span>
                <button type="button" id="omQtyPlus"><i class="bi bi-plus"></i></button>
              </div>
            </div>
          </div>

          <!-- Quick order form -->
          <div class="col-md-7">
            <form id="omOrderForm" class="sk-order-form">
              <input type="hidden" name="product_id" id="omProductId">
              <input type="hidden" name="product_name" id="omProductNameField">
              <input type="hidden" name="unit_price" id="omUnitPrice">
              <input type="hidden" name="quantity" id="omQtyField" value="1">
              <span class="sk-eyebrow mb-2">দ্রুত অর্ডার — মাত্র ৩০ সেকেন্ড</span>
              <div class="mb-3">
                <label class="form-label">পুরো নাম *</label>
                <input type="text" name="customer_name" class="form-control" required placeholder="আপনার নাম লিখুন">
              </div>
              <div class="mb-3">
                <label class="form-label">মোবাইল নম্বর *</label>
                <input type="tel" name="phone" class="form-control" required pattern="^01[3-9][0-9]{8}$" placeholder="01XXXXXXXXX">
              </div>
              <div class="mb-3">
                <label class="form-label">সম্পূর্ণ ঠিকানা *</label>
                <textarea name="address" class="form-control" rows="2" required placeholder="বাসা/রোড, থানা, জেলা"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">পেমেন্ট মেথড</label>
                <div class="sk-payment-options">
                  <label class="sk-payment-radio">
                    <input type="radio" name="payment_method" value="cod" checked>
                    <span><i class="bi bi-cash-coin"></i> ক্যাশ অন ডেলিভারি</span>
                  </label>
                  <label class="sk-payment-radio">
                    <input type="radio" name="payment_method" value="bkash">
                    <span><i class="bi bi-wallet2"></i> bKash অ্যাডভান্স</span>
                  </label>
                </div>
              </div>
              <div class="sk-order-error alert alert-danger py-2 d-none"></div>
              <div class="sk-order-total">
                <span>সর্বমোট</span>
                <strong id="omTotalPrice">৳0</strong>
              </div>
              <button type="submit" class="btn sk-btn-primary w-100 btn-lg mt-3">
                <span class="sk-btn-text"><i class="bi bi-check2-circle"></i> অর্ডার কনফার্ম করুন</span>
                <span class="sk-btn-spinner d-none">
                  <span class="spinner-border spinner-border-sm"></span> প্রসেসিং...
                </span>
              </button>
              <p class="sk-order-note">* কোনো অগ্রিম টাকা লাগবে না, শুধু ডেলিভারির সময় পেমেন্ট করুন (COD)</p>
            </form>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // landing.js একটা static ফাইল — Blade route() ওখানে কাজ করে না,
  // তাই route URL টা এখান থেকে global variable এ পাস করা হচ্ছে
  window.SK_ORDER_URL = "{{ route('order.store') }}";
  window.SK_NEWSLETTER_URL = "{{ route('newsletter.subscribe') }}";
</script>
<script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>