
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>RMUTSB Ebook Library</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Kanit',sans-serif;

    background:
    radial-gradient(circle at top left,#dbeafe,#f8fafc 40%),
    radial-gradient(circle at bottom right,#ede9fe,#f8fafc 40%);

    min-height:100vh;
}

.navbar{
    backdrop-filter:blur(20px);
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.hero-card{
    background:linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );

    color:white;

    border-radius:30px;

    padding:60px;

    margin-top:30px;

    margin-bottom:40px;

    box-shadow:
    0 20px 50px rgba(37,99,235,.25);
}

.hero-card h1{
    font-weight:700;
}

.hero-card p{
    opacity:.9;
}

.search-box{
    max-width:800px;
    margin:auto;
}

.search-box input{
    border:none;
    border-radius:15px;
    padding:18px;
    box-shadow:
    0 10px 30px rgba(0,0,0,.08);
}

.section-title{
    font-size:1.5rem;
    font-weight:700;
    margin-bottom:20px;
}

.category-btn{
    border-radius:999px;
    margin-right:10px;
    margin-bottom:10px;
}

.stats-card{
    background:
    rgba(255,255,255,.75);

    backdrop-filter:
    blur(10px);

    border:none;

    border-radius:20px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);
}

.book-card{

    background:
    rgba(255,255,255,.75);

    backdrop-filter:
    blur(10px);

    border:none;

    border-radius:20px;

    overflow:hidden;

    transition:.3s;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);
}

.book-card:hover{

    transform:
    translateY(-10px)
    scale(1.03);

    box-shadow:
    0 20px 40px rgba(0,0,0,.15);
}

.book-cover{
    width:100%;
    height:230px;
    object-fit:cover;
}

.book-title{
    font-size:.95rem;
    font-weight:600;
}

.book-author{
    color:#6b7280;
    font-size:.85rem;
}

.book-badge{
    position:absolute;
    top:10px;
    left:10px;
}

.news-card{
    border:none;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

footer{
    margin-top:80px;
    background:#111827;
    color:white;
    padding:40px;
    border-top-left-radius:30px;
    border-top-right-radius:30px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">

<div class="container">

<a class="navbar-brand fw-bold fs-3 text-primary">
📚 RUS Ebook
</a>

<div>

@auth

<a href="{{ route('dashboard') }}"
class="btn btn-light">
Dashboard
</a>

@else

<a href="{{ route('login') }}"
class="btn btn-primary">
เข้าสู่ระบบ
</a>

@endauth

</div>

</div>

</nav>

<div class="container">

<div class="hero-card text-center">

<h1 class="display-5">
ห้องสมุด Ebook ออนไลน์
</h1>

<p class="lead">
ค้นหา อ่าน และยืม Ebook ได้ทุกที่ทุกเวลา
</p>

</div>

<div class="search-box mb-5">

<input
type="text"
class="form-control form-control-lg"
placeholder="ค้นหาชื่อหนังสือ ผู้แต่ง ISBN ...">

</div>

<div class="row mb-5">

<div class="col-md-3 mb-3">
<div class="stats-card p-4 text-center">
<h2>1,250</h2>
<p class="mb-0">📚 Ebook ทั้งหมด</p>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stats-card p-4 text-center">
<h2>850</h2>
<p class="mb-0">👨‍🎓 ผู้ใช้งาน</p>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stats-card p-4 text-center">
<h2>3,500</h2>
<p class="mb-0">📖 การยืมทั้งหมด</p>
</div>
</div>

<div class="col-md-3 mb-3">
<div class="stats-card p-4 text-center">
<h2>25</h2>
<p class="mb-0">🏷️ หมวดหมู่</p>
</div>
</div>

</div>

<div class="mb-4">

<!-- <button class="btn btn-outline-primary category-btn">ทั้งหมด</button>
<button class="btn btn-outline-secondary category-btn">IT</button>
<button class="btn btn-outline-secondary category-btn">AI</button>
<button class="btn btn-outline-secondary category-btn">Business</button>
<button class="btn btn-outline-secondary category-btn">Education</button>
<button class="btn btn-outline-secondary category-btn">Science</button> -->

</div>

<h3 class="section-title">
🆕 Ebook มาใหม่
</h3>

<div class="row">

@for($i=1;$i<=12;$i++)

<div class="col-lg-2 col-md-3 col-6 mb-4">

<div class="book-card">

<div class="position-relative">

<img
src="https://picsum.photos/300/450?random={{ $i }}"
class="book-cover">

<span class="badge bg-danger book-badge">
NEW
</span>

</div>

<div class="p-3">

<div class="book-title">
Laravel Development {{ $i }}
</div>

<div class="book-author">
John Doe
</div>

</div>

</div>

</div>

@endfor

</div>

<h3 class="section-title mt-5">
🔥 Ebook ยอดนิยม
</h3>

<div class="row">

@for($i=13;$i<=24;$i++)

<div class="col-lg-2 col-md-3 col-6 mb-4">

<div class="book-card">

<div class="position-relative">

<img
src="https://picsum.photos/300/450?random={{ $i }}"
class="book-cover">

<span class="badge bg-success book-badge">
HOT
</span>

</div>

<div class="p-3">

<div class="book-title">
Artificial Intelligence {{ $i }}
</div>

<div class="book-author">
Jane Smith
</div>

</div>

</div>

</div>

@endfor

</div>

<h3 class="section-title mt-5">
📢 ข่าวประชาสัมพันธ์
</h3>

<div class="row mb-5">

<div class="col-md-6">

<div class="card news-card">

<div class="card-body">

<h5>
เปิดให้บริการ Ebook ใหม่
</h5>

<p>
เพิ่มหนังสือด้าน AI และ Data Science มากกว่า 200 รายการ
</p>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card news-card">

<div class="card-body">

<h5>
อบรมการใช้ฐานข้อมูลออนไลน์
</h5>

<p>
นักศึกษาสามารถเข้าร่วมอบรมการใช้งาน Ebook ได้ฟรี
</p>

</div>

</div>

</div>

</div>

<h3 class="section-title">
📖 วิธีการใช้งาน
</h3>

<div class="card border-0 shadow-sm mb-5">

<div class="card-body">

<div class="row text-center">

<div class="col-md-3">
<h1>1️⃣</h1>
<h5>เข้าสู่ระบบ</h5>
</div>

<div class="col-md-3">
<h1>2️⃣</h1>
<h5>ค้นหา Ebook</h5>
</div>

<div class="col-md-3">
<h1>3️⃣</h1>
<h5>ยืม Ebook</h5>
</div>

<div class="col-md-3">
<h1>4️⃣</h1>
<h5>อ่านออนไลน์</h5>
</div>

</div>

</div>

</div>

</div>

<footer class="text-center">

<h4>
RMUTSB Ebook Library System
</h4>

<p>
มหาวิทยาลัยเทคโนโลยีราชมงคลสุวรรณภูมิ
</p>

<small>
© 2026 All Rights Reserved
</small>

</footer>

</body>
</html>

