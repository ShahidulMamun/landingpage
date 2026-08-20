<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>আনসাবস্ক্রাইব — ShopKori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  body{
    min-height:100vh; display:flex; align-items:center; justify-content:center;
    background:#FDF7F5; font-family:'Segoe UI',sans-serif; text-align:center;
  }
  .card-box{
    background:#fff; border-radius:18px; padding:2.5rem;
    max-width:420px; box-shadow:0 15px 40px rgba(0,0,0,0.08);
  }
  .card-box i{ font-size:2.5rem; color:#E85535; }
  .card-box h4{ margin-top:1rem; font-weight:700; }
  .btn-back{ background:#E85535; color:#fff; border-radius:100px; padding:.6rem 1.5rem; }
  .btn-back:hover{ background:#0A3A3E; color:#fff; }
</style>
</head>
<body>

<div class="card-box">
  <i class="bi bi-envelope-x"></i>
  <h4>আনসাবস্ক্রাইব সম্পন্ন হয়েছে</h4>
  <p class="text-muted">
    {{ $subscriber->email }} — এই ইমেইলে আর কোনো অফার বা নিউজলেটার পাঠানো হবে না।
  </p>
  <a href="{{ route('landing') }}" class="btn btn-back mt-2">
    <i class="bi bi-shop"></i> শপিংয়ে ফিরে যাও
  </a>
</div>

</body>
</html>