<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>অ্যাডমিন লগইন — ShopKori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  body{
    min-height:100vh; display:flex; align-items:center; justify-content:center;
    background: linear-gradient(135deg,#0F5257,#0A3A3E);
    font-family:'Segoe UI',sans-serif;
  }
  .login-card{
    background:#fff; border-radius:18px; padding:2.5rem;
    width:100%; max-width:400px; box-shadow:0 20px 50px rgba(0,0,0,0.25);
  }
  .login-logo{ text-align:center; font-weight:700; font-size:1.4rem; margin-bottom:.25rem; }
  .login-logo span{ color:#FF6B4A; }
  .login-sub{ text-align:center; color:#6c757d; font-size:.88rem; margin-bottom:1.75rem; }
  .form-control:focus{ border-color:#0F5257; box-shadow:0 0 0 3px rgba(15,82,87,0.12); }
  .btn-login{ background:#0F5257; color:#fff; }
  .btn-login:hover{ background:#0A3A3E; color:#fff; }
</style>
</head>
<body>

<div class="login-card">
  <div class="login-logo">Shop<span>Kori</span></div>
  <p class="login-sub">অ্যাডমিন প্যানেলে প্রবেশ করুন</p>

  @if($errors->any())
    <div class="alert alert-danger py-2 small">
      @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
      @endforeach
    </div>
  @endif

  @if(session('status'))
    <div class="alert alert-success py-2 small">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('admin.login.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">ইমেইল</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
    </div>

    <div class="mb-3">
      <label class="form-label">পাসওয়ার্ড</label>
      <input type="password" name="password" class="form-control" required autocomplete="current-password">
    </div>

    <div class="form-check mb-4">
      <input type="checkbox" name="remember" class="form-check-input" id="remember" value="1">
      <label class="form-check-label small" for="remember">আমাকে মনে রাখো</label>
    </div>

    <button type="submit" class="btn btn-login w-100 py-2">লগইন করুন</button>
  </form>
</div>

</body>
</html>