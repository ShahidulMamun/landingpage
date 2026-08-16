<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin Panel') — ShopKori</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
  :root{ --admin-teal:#0F5257; }
  body{ background:#F4F6F7; font-family: 'Segoe UI', sans-serif; }
  .admin-sidebar{
    width:230px; min-height:100vh; background: var(--admin-teal);
    position:fixed; top:0; left:0; padding: 1.5rem 1rem;
  }
  .admin-sidebar a{
    display:flex; align-items:center; gap:.6rem;
    color: rgba(255,255,255,0.8); padding:.6rem .8rem;
    border-radius:8px; text-decoration:none; font-size:.92rem; margin-bottom:.3rem;
  }
  .admin-sidebar a.active, .admin-sidebar a:hover{ background: rgba(255,255,255,0.12); color:#fff; }
  .admin-sidebar .brand{ color:#fff; font-weight:700; font-size:1.2rem; margin-bottom:1.5rem; display:block; }
  .admin-content{ margin-left:230px; padding: 2rem; }
  .admin-card{ background:#fff; border-radius:14px; padding:1.5rem; box-shadow:0 4px 16px rgba(0,0,0,0.04); }
  .btn-admin-primary{ background: var(--admin-teal); color:#fff; }
  .btn-admin-primary:hover{ background:#0A3A3E; color:#fff; }
  @media (max-width: 767.98px){
    .admin-sidebar{ position:static; width:100%; min-height:auto; }
    .admin-content{ margin-left:0; padding:1.25rem; }
  }
</style>
</head>
<body>

<div class="admin-sidebar">
  <a href="{{ route('admin.products.index') }}" class="brand">Shop<span style="color:#FFC145">Kori</span> Admin</a>
  <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
    <i class="bi bi-tags"></i> ক্যাটাগরি
  </a>
  <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
    <i class="bi bi-box-seam"></i> প্রোডাক্ট
  </a>
  <a href="{{ route('landing') }}" target="_blank">
    <i class="bi bi-box-arrow-up-right"></i> সাইট দেখুন
  </a>
</div>

<div class="admin-content">
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>