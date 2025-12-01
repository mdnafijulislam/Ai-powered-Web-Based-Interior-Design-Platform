@extends('layouts.main')

@section('title', 'My Portfolio')

@section('content')

<style>
    .section-title { font-size:28px; font-weight:700; margin:40px 0 15px;}
    .portfolio-container { max-width:1200px; margin:auto; padding:20px; }
    .project-card { border-radius:12px; background:#fff; box-shadow:0 4px 12px rgba(0,0,0,0.08); overflow:hidden; margin-bottom:30px; }
    .project-card img { width:100%; height:260px; object-fit:cover; }
    .project-info { padding:20px; }
    .btn-view { background:black; padding:10px 18px; color:white; border-radius:6px; text-decoration:none; display:inline-block; }
    .gallery-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:15px; }
    .gallery-grid img { width:100%; border-radius:10px; height:220px; object-fit:cover; cursor:pointer; transition:.3s; }
    .gallery-grid img:hover { transform:scale(1.03); }
    .before-after { display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:20px; }
    .review-box { border-left:4px solid #000; padding:15px; margin-bottom:20px; background:#f8f8f8; border-radius:8px; }
    .contact-box { background:#f2f2f2; padding:25px; border-radius:12px; }
</style>

<div class="portfolio-container">

    <!-- FEATURED PROJECTS -->
    <h2 class="section-title">🌟 Featured Projects</h2>

    <div class="project-card">
        <img src="{{ asset('assets/images/featured1.jpg') }}" alt="Featured 1">
        <div class="project-info">
            <h3>Modern Luxury Living Room</h3>
            <p><strong>Location:</strong> Dhaka, Bangladesh</p>
            <p><strong>Type:</strong> Full Interior Design</p>
            <a href="#" class="btn-view">View Details</a>
        </div>
    </div>

    <!-- ALL PROJECTS GALLERY (example categories) -->
    <h2 class="section-title">🏡 All Projects Gallery</h2>

    <h3>Bedroom</h3>
    <div class="gallery-grid">
        <img src="{{ asset('assets/images/bed1.jpg') }}" alt="bed1">
        <img src="{{ asset('assets/images/bed2.jpg') }}" alt="bed2">
        <img src="{{ asset('assets/images/bed3.jpg') }}" alt="bed3">
    </div>

    <h3 style="margin-top:30px;">Living Room</h3>
    <div class="gallery-grid">
        <img src="{{ asset('assets/images/liv1.jpg') }}" alt="liv1">
        <img src="{{ asset('assets/images/liv2.jpg') }}" alt="liv2">
        <img src="{{ asset('assets/images/liv3.jpg') }}" alt="liv3">
    </div>

    <!-- BEFORE & AFTER -->
    <h2 class="section-title">🔄 Before & After Transformations</h2>
    <div class="before-after">
        <div>
            <h4>Before</h4>
            <img src="{{ asset('assets/images/before.jpg') }}" style="width:100%; border-radius:10px;">
        </div>
        <div>
            <h4>After</h4>
            <img src="{{ asset('assets/images/after.jpg') }}" style="width:100%; border-radius:10px;">
        </div>
    </div>

    <!-- 3D renders / moodboard -->
    <h2 class="section-title">🎨 3D Render & Moodboard</h2>
    <div class="gallery-grid" style="margin-top:10px;">
        <img src="{{ asset('assets/images/3d1.jpg') }}" alt="3d1">
        <img src="{{ asset('assets/images/3d2.jpg') }}" alt="3d2">
        <img src="{{ asset('assets/images/3d3.jpg') }}" alt="3d3">
    </div>

    <!-- SERVICES -->
    <h2 class="section-title">🛠️ Project Work Details</h2>
    <ul style="font-size:18px; line-height:32px;">
        <li>False Ceiling Work</li>
        <li>Paint & Wallpaper Design</li>
        <li>Lighting Setup</li>
        <li>Modular Kitchen</li>
        <li>Custom Wooden Furniture</li>
        <li>Tiles / Marble Work</li>
        <li>Complete Home Interior</li>
    </ul>

    <!-- REVIEWS -->
    <h2 class="section-title">💬 Client Reviews</h2>
    <div class="review-box">
        <p><strong>⭐⭐⭐⭐⭐</strong></p>
        <p>“Amazing work! The transformation was unbelievable. Highly recommended.”</p>
        <small>- Tanvir Ahmed, Dhaka</small>
    </div>

    <!-- CONTACT -->
    <h2 class="section-title">📞 Contact & Booking</h2>
    <div class="contact-box">
        <p><strong>Phone:</strong> +880 1700 000 000</p>
        <p><strong>Email:</strong> worker@example.com</p>
        <p><strong>Location:</strong> Dhaka, Bangladesh</p>

        <a href="https://wa.me/8801700000000" target="_blank" class="btn-view" style="background:green;">WhatsApp Chat</a>
        <a href="#" class="btn-view" style="margin-left:10px;">Book Now</a>
    </div>

</div>

@endsection

