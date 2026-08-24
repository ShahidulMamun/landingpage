<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>রিভিউ দিন — ShopKori</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/landing.page.css') }}">

<style>
  body{ background: var(--sk-ivory); min-height:100vh; }
  .review-wrap{ max-width:560px; margin: 0 auto; padding: 3rem 1rem; }
  .review-nav{ text-align:center; padding: 1.5rem 0; }
  .review-card{
    background:#fff; border-radius: var(--sk-radius); padding: 2rem;
    box-shadow: var(--sk-shadow);
  }
  .review-card h2{
    font-family: var(--font-display); font-weight:700;
    font-size: 1.6rem; text-align:center; margin-bottom:.5rem;
  }
  .review-card p.sub{ text-align:center; color: var(--sk-gray); margin-bottom:1.75rem; }

  .star-picker{
    display:flex; justify-content:center; gap:.4rem; font-size:2.2rem;
    margin-bottom: .5rem;
  }
  .star-picker i{
    color: #ddd; cursor:pointer; transition: color .15s ease, transform .15s ease;
  }
  .star-picker i.active{ color: var(--sk-gold); transform: scale(1.08); }
  .star-picker-label{ text-align:center; color: var(--sk-gray); font-size:.85rem; margin-bottom:1.5rem; }

  .review-success{ display:none; text-align:center; padding: 2rem 0; }
  .review-success i{ font-size:3rem; color: var(--sk-teal); }
</style>
</head>
<body>

<div class="review-nav">
  <a href="{{ route('landing') }}" class="sk-logo">Shop<span>Kori</span></a>
</div>

<div class="review-wrap">
  <div class="review-card">

    <div class="review-success" id="reviewSuccess">
      <i class="bi bi-check-circle-fill"></i>
      <h4 class="mt-3">রিভিউর জন্য ধন্যবাদ!</h4>
      <p class="text-muted">অ্যাপ্রুভ হওয়ার পর সাইটে দেখা যাবে।</p>
      <a href="{{ route('landing') }}" class="btn sk-btn-primary mt-2">শপিংয়ে ফিরে যাও</a>
    </div>

    <form id="reviewForm">
      <h2>তোমার অভিজ্ঞতা শেয়ার করো</h2>
      <p class="sub">আমাদের প্রোডাক্ট বা সার্ভিস নিয়ে তোমার মতামত জানাও</p>

      <div class="star-picker" id="starPicker">
        <i class="bi bi-star" data-value="1"></i>
        <i class="bi bi-star" data-value="2"></i>
        <i class="bi bi-star" data-value="3"></i>
        <i class="bi bi-star" data-value="4"></i>
        <i class="bi bi-star" data-value="5"></i>
      </div>
      <p class="star-picker-label" id="starLabel">রেটিং বাছাই করো</p>
      <input type="hidden" name="rating" id="ratingInput" required>

      <div class="mb-3">
        <label class="form-label">তোমার নাম *</label>
        <input type="text" name="customer_name" class="form-control" required placeholder="নাম লিখো">
      </div>

      <div class="mb-3">
        <label class="form-label">শহর</label>
        <input type="text" name="city" class="form-control" placeholder="যেমন: ঢাকা">
      </div>

      @if($products->isNotEmpty())
      <div class="mb-3">
        <label class="form-label">কোন প্রোডাক্ট নিয়ে রিভিউ? (ঐচ্ছিক)</label>
        <select name="product_id" class="form-select">
          <option value="">সাধারণ রিভিউ (নির্দিষ্ট প্রোডাক্ট না)</option>
          @foreach($products as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
          @endforeach
        </select>
      </div>
      @endif

      <div class="mb-3">
        <label class="form-label">মন্তব্য *</label>
        <textarea name="comment" class="form-control" rows="4" required placeholder="তোমার অভিজ্ঞতা লেখো..."></textarea>
      </div>

      <div class="review-error alert alert-danger py-2 d-none"></div>

      <button type="submit" class="btn sk-btn-primary w-100 btn-lg">
        <span class="review-btn-text"><i class="bi bi-send"></i> রিভিউ সাবমিট করো</span>
        <span class="review-btn-spinner d-none">
          <span class="spinner-border spinner-border-sm"></span> প্রসেসিং...
        </span>
      </button>
    </form>

  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('#starPicker i');
  const ratingInput = document.getElementById('ratingInput');
  const starLabel = document.getElementById('starLabel');
  const labels = { 1: 'খারাপ', 2: 'মোটামুটি', 3: 'ভালো', 4: 'খুব ভালো', 5: 'চমৎকার' };

  function paintStars(value) {
    stars.forEach((s) => {
      const v = parseInt(s.dataset.value, 10);
      s.classList.toggle('active', v <= value);
      s.className = (v <= value ? 'bi bi-star-fill active' : 'bi bi-star');
    });
  }

  stars.forEach((star) => {
    star.addEventListener('click', function () {
      const value = this.dataset.value;
      ratingInput.value = value;
      starLabel.textContent = labels[value];
      paintStars(parseInt(value, 10));
    });
    star.addEventListener('mouseenter', function () {
      paintStars(parseInt(this.dataset.value, 10));
    });
  });
  document.getElementById('starPicker').addEventListener('mouseleave', function () {
    paintStars(parseInt(ratingInput.value || 0, 10));
  });

  const form = document.getElementById('reviewForm');
  const successView = document.getElementById('reviewSuccess');

  form.addEventListener('submit', function (e) {
    e.preventDefault();

    if (!ratingInput.value) {
      const errorBox = form.querySelector('.review-error');
      errorBox.textContent = 'রেটিং দেওয়া বাধ্যতামূলক — একটা স্টার বাছাই করো।';
      errorBox.classList.remove('d-none');
      return;
    }

    const submitBtn = form.querySelector('button[type="submit"]');
    const btnText = submitBtn.querySelector('.review-btn-text');
    const btnSpinner = submitBtn.querySelector('.review-btn-spinner');
    const errorBox = form.querySelector('.review-error');

    btnText.classList.add('d-none');
    btnSpinner.classList.remove('d-none');
    submitBtn.disabled = true;
    errorBox.classList.add('d-none');

    const token = document.querySelector('meta[name="csrf-token"]');
    const formData = new FormData(form);

    fetch('{{ route("reviews.store") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token ? token.content : '',
        'Accept': 'application/json',
      },
      body: formData,
    })
      .then((res) => {
        if (!res.ok) throw new Error('validation-or-server-error');
        return res.json();
      })
      .then(() => {
        form.classList.add('d-none');
        successView.style.display = 'block';
      })
      .catch(() => {
        errorBox.textContent = 'দুঃখিত, রিভিউ সাবমিট করা যায়নি। আবার চেষ্টা করো।';
        errorBox.classList.remove('d-none');
      })
      .finally(() => {
        btnText.classList.remove('d-none');
        btnSpinner.classList.add('d-none');
        submitBtn.disabled = false;
      });
  });
});
</script>
</body>
</html>