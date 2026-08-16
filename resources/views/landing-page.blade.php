<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopKori — একটাই ঠিকানা, সব কেনাকাটার</title>
<meta name="description" content="সেরা দামে অথেনটিক প্রোডাক্ট, ক্যাশ অন ডেলিভারি সহ সারা বাংলাদেশে ফাস্ট ডেলিভারি।">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Custom -->
<link rel="stylesheet" href="{{ asset('css/landing.page.css') }}">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg sk-navbar sticky-top">
  <div class="container">
    <a class="navbar-brand sk-logo" href="{{ route('landing') }}">Shop<span>Kori</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#skNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="skNav">
      <ul class="navbar-nav mx-auto gap-lg-4">
        <li class="nav-item"><a class="nav-link" href="#categories">ক্যাটাগরি</a></li>
        <li class="nav-item"><a class="nav-link" href="#products">প্রোডাক্টস</a></li>
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
      @php
        $categories = [
          ['name' => 'ফ্যাশন', 'img' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?q=80&w=500&auto=format&fit=crop'],
          ['name' => 'ইলেকট্রনিক্স', 'img' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?q=80&w=500&auto=format&fit=crop'],
          ['name' => 'হোম ও লিভিং', 'img' => 'https://images.unsplash.com/photo-1484154218962-a197022b5858?q=80&w=500&auto=format&fit=crop'],
          ['name' => 'বিউটি', 'img' => 'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=500&auto=format&fit=crop'],
        ];
      @endphp
      @foreach($categories as $cat)
      <div class="col-6 col-lg-3" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <a href="#" class="sk-cat-card">
          <img src="{{ $cat['img'] }}" alt="{{ $cat['name'] }}">
          <span>{{ $cat['name'] }}</span>
        </a>
      </div>
      @endforeach
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
      @php
        $products = [
          ['name' => 'ওয়্যারলেস ইয়ারবাডস', 'price' => '১,৪৯৯', 'old' => '২,২০০', 'img' => 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?q=80&w=500&auto=format&fit=crop', 'badge' => '৩২% ছাড়'],
          ['name' => 'মিনিমাল ব্যাকপ্যাক', 'price' => '২,১৫০', 'old' => null, 'img' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=500&auto=format&fit=crop', 'badge' => 'নতুন'],
          ['name' => 'স্মার্ট ওয়াচ প্রো', 'price' => '৩,৯৯০', 'old' => '৫,৫০০', 'img' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=500&auto=format&fit=crop', 'badge' => '২৭% ছাড়'],
          ['name' => 'ক্যাজুয়াল স্নিকার্স', 'price' => '২,৮৯০', 'old' => null, 'img' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=500&auto=format&fit=crop', 'badge' => 'জনপ্রিয়'],
        ];
      @endphp
      @foreach($products as $p)
      <div class="col-6 col-lg-3" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <div class="sk-product-card">
          <div class="sk-product-img">
            <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}">
            <span class="sk-badge">{{ $p['badge'] }}</span>
            <button class="sk-wishlist"><i class="bi bi-heart"></i></button>
          </div>
          <div class="sk-product-body">
            <h6>{{ $p['name'] }}</h6>
            <div class="sk-product-price">
              <span class="sk-price-new">৳{{ $p['price'] }}</span>
              @if($p['old'])
                <span class="sk-price-old">৳{{ $p['old'] }}</span>
              @endif
            </div>
            <button class="btn sk-btn-cart w-100 mt-2">
              <i class="bi bi-bag-plus"></i> কার্টে যোগ করুন
            </button>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5" data-reveal>
      <a href="#" class="btn sk-btn-ghost btn-lg">সব প্রোডাক্ট দেখুন</a>
    </div>
  </div>
</section>

<!-- ===== WHY CHOOSE US ===== -->
<section class="sk-section" id="why">
  <div class="row align-items-center g-5">
    <div class="container">
      <div class="row g-4">
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
      @php
        $reviews = [
          ['name' => 'তানভীর হাসান', 'city' => 'ঢাকা', 'text' => 'প্রোডাক্ট কোয়ালিটি একদম যেমনটা দেখানো হয়েছিল। ডেলিভারিও দ্রুত পেয়েছি।'],
          ['name' => 'নুসরাত জাহান', 'city' => 'চট্টগ্রাম', 'text' => 'কাস্টমার সাপোর্ট খুবই হেল্পফুল, এক্সচেঞ্জ প্রসেস অনেক সহজ ছিল।'],
          ['name' => 'রাকিব আহমেদ', 'city' => 'সিলেট', 'text' => 'দাম অনুযায়ী কোয়ালিটি সেরা। রেগুলার কাস্টমার হয়ে গেছি এখন।'],
        ];
      @endphp
      @foreach($reviews as $r)
      <div class="col-lg-4" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
        <div class="sk-review-card">
          <span class="sk-verified"><i class="bi bi-patch-check-fill"></i> ভেরিফাইড ক্রেতা</span>
          <p>"{{ $r['text'] }}"</p>
          <div class="sk-review-author">
            <div class="sk-avatar">{{ mb_substr($r['name'], 0, 1) }}</div>
            <div>
              <strong>{{ $r['name'] }}</strong>
              <span>{{ $r['city'] }}</span>
            </div>
          </div>
        </div>
      </div>
      @endforeach
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
        <form class="sk-newsletter-form">
          <input type="email" placeholder="আপনার ইমেইল দিন" required>
          <button type="submit" class="btn sk-btn-primary">সাবস্ক্রাইব</button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="sk-footer">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <a class="sk-logo sk-logo--footer" href="{{ route('landing') }}">Shop<span>Kori</span></a>
        <p>বাংলাদেশের সবচেয়ে বিশ্বস্ত অনলাইন শপিং ডেস্টিনেশন।</p>
        <div class="sk-social">
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
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
          <li><a href="#">FAQ</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h6>পেমেন্ট মেথড</h6>
        <div class="sk-payment-icons">
          <span>bKash</span><span>Nagad</span><span>Rocket</span><span>Visa</span><span>COD</span>
        </div>
      </div>
    </div>
    <hr>
    <p class="sk-copyright">© {{ date('Y') }} ShopKori. সর্বস্বত্ব সংরক্ষিত।</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>