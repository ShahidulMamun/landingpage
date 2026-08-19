<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>সচরাচর জিজ্ঞাসা (FAQ) — ShopKori</title>
<meta name="description" content="ডেলিভারি, পেমেন্ট, রিটার্ন ও রিফান্ড নিয়ে সবচেয়ে বেশি জিজ্ঞাসিত প্রশ্নের উত্তর।">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;0,9..144,900;1,9..144,600&family=Inter:wght@400;500;600;700;800&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<!-- Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Shared site styles (navbar, footer, buttons, colors) -->
<link rel="stylesheet" href="{{ asset('css/landing.page.css') }}">
<!-- FAQ page only -->
<link rel="stylesheet" href="{{ asset('css/faq.css') }}">
</head>
<body>

<!-- ===== NAVBAR (same as landing) ===== -->
<nav class="navbar navbar-expand-lg sk-navbar sticky-top">
  <div class="container">
    <a class="navbar-brand sk-logo" href="{{ route('landing') }}">Shop<span>Kori</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#skNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="skNav">
      <ul class="navbar-nav mx-auto gap-lg-4">
        <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}#categories">ক্যাটাগরি</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}#products">প্রোডাক্টস</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}#why">কেন আমরা</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('faq') }}">FAQ</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
        <a href="{{ route('landing') }}#products" class="btn sk-btn-primary d-none d-lg-inline-flex">শপিং শুরু করুন</a>
      </div>
    </div>
  </div>
</nav>

<!-- ===== FAQ HERO ===== -->
<header class="faq-hero">
  <div class="container text-center">
    <span class="sk-eyebrow">সাহায্য কেন্দ্র</span>
    <h1 class="faq-title">তোমার প্রশ্নের উত্তর এখানে</h1>
    <p class="faq-sub">ডেলিভারি, পেমেন্ট, রিটার্ন — যেকোনো প্রশ্ন থাকলে নিচে খুঁজে দেখো।</p>

    <div class="faq-search">
      <i class="bi bi-search"></i>
      <input type="text" id="faqSearchInput" placeholder="যেমন: ডেলিভারি কত দিনে, রিফান্ড...">
    </div>
  </div>
</header>

<!-- ===== FAQ GROUPS ===== -->
<section class="sk-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto">

        <!-- Category quick-jump -->
        <div class="faq-jump mb-5">
          @foreach($faqGroups as $group)
          <a href="#faq-group-{{ $loop->index }}" class="faq-jump-item">
            <i class="bi {{ $group['icon'] }}"></i> {{ $group['title'] }}
          </a>
          @endforeach
        </div>

        <div id="faqNoResults" class="text-center text-muted py-5 d-none">
          <i class="bi bi-search" style="font-size:2rem"></i>
          <p class="mt-2">কোনো মিল খুঁজে পাওয়া যায়নি। অন্য শব্দ দিয়ে খুঁজে দেখো।</p>
        </div>

        @foreach($faqGroups as $group)
        <div class="faq-group" id="faq-group-{{ $loop->index }}">
          <h4 class="faq-group-title">
            <i class="bi {{ $group['icon'] }}"></i> {{ $group['title'] }}
          </h4>

          <div class="accordion sk-faq-accordion" id="faqAccordion{{ $loop->index }}">
            @foreach($group['items'] as $i => $item)
            <div class="accordion-item faq-item"
                 data-question="{{ mb_strtolower($item['q']) }}"
                 data-answer="{{ mb_strtolower($item['a']) }}">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#faqCollapse{{ $loop->parent->index }}-{{ $i }}">
                  {{ $item['q'] }}
                </button>
              </h2>
              <div id="faqCollapse{{ $loop->parent->index }}-{{ $i }}"
                   class="accordion-collapse collapse"
                   data-bs-parent="#faqAccordion{{ $loop->parent->index }}">
                <div class="accordion-body">
                  {{ $item['a'] }}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach

      </div>
    </div>

    <!-- Still need help CTA -->
    <div class="faq-help-card text-center mt-5">
      <i class="bi bi-headset"></i>
      <h5 class="mt-3">তোমার প্রশ্নের উত্তর পাওনি?</h5>
      <p class="text-muted">আমাদের সাপোর্ট টিম ২৪/৭ রেডি আছে সাহায্য করার জন্য।</p>
      <a href="tel:+8801700000000" class="btn sk-btn-primary">
        <i class="bi bi-telephone"></i> কল করো
      </a>
      <a href="{{ route('landing') }}#products" class="btn sk-btn-ghost">শপিং এ ফিরে যাও</a>
    </div>
  </div>
</section>

<!-- ===== FOOTER (same as landing) ===== -->
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
          <li><a href="{{ route('faq') }}">FAQ</a></li>
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
<script src="{{ asset('js/faq.js') }}"></script>
</body>
</html>