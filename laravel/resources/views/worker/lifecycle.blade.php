@extends('layouts.main')

@section('title', 'Life Cycle')

@section('content')

<style>
/* ================================
   Modern Life Cycle Page Styles
================================ */

.lifecycle-wrapper {
    max-width: 1200px;
    margin: auto;
    padding: 40px 20px;
}

/* SECTION TITLES */
.section-title {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 20px;
    background: linear-gradient(90deg, #000, #555);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* SUMMARY CARDS */
.summary-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.summary-card {
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    transition: .25s;
}

.summary-card:hover {
    transform: translateY(-4px);
}

.summary-card h3 {
    font-size: 22px;
    margin-bottom: 8px;
    font-weight: 700;
}

.summary-card p {
    color: #666;
    font-size: 15px;
}

/* TIMELINE */
.timeline {
    position: relative;
    margin: 40px 0;
    padding-left: 40px;
}

.timeline::before {
    content: "";
    position: absolute;
    left: 15px;
    top: 0;
    width: 4px;
    height: 100%;
    background: #000;
    border-radius: 10px;
}

.timeline-item {
    margin-bottom: 40px;
    position: relative;
}

.timeline-item::before {
    content: "";
    position: absolute;
    left: -2px;
    width: 20px;
    height: 20px;
    background: #000;
    border-radius: 50%;
    top: 5px;
}

.timeline-item h4 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

.timeline-item p {
    margin: 6px 0 0;
    color: #555;
}

/* BADGES */
.badges {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.badge-card {
    background: linear-gradient(135deg, #000, #333);
    color: white;
    padding: 18px 25px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.15);
    font-size: 15px;
    font-weight: 600;
}

/* SUGGESTION BOX */
.suggestion-box {
    background: white;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
}

.suggestion-box ul {
    margin-top: 10px;
    padding-left: 20px;
}

.suggestion-box li {
    margin: 8px 0;
    font-size: 15px;
}
</style>


<div class="lifecycle-wrapper">

    {{-- PAGE HEADER --}}
    <h1 class="section-title">📅 Account Life Cycle Overview</h1>


    <!-- =======================
         ACCOUNT INFORMATION
    ======================== -->
    <h2 class="section-title">Account Information</h2>

    <div class="summary-cards">

        <div class="summary-card">
            <h3>Account Created</h3>
            <p>{{ $joined->format('d M, Y') }}</p>
        </div>

        <div class="summary-card">
            <h3>Account Age</h3>
            <p>{{ $age }}</p>
        </div>

        <div class="summary-card">
            <h3>Last Active</h3>
            <p>{{ now()->subDays(rand(1,4))->format('d M Y') }}</p>
        </div>

        <div class="summary-card">
            <h3>Total Active Days</h3>
            <p>{{ now()->diffInDays($joined) }} Days</p>
        </div>

    </div>



    <!-- =======================
         ACTIVITY OVERVIEW
    ======================== -->
    <h2 class="section-title">Activity Overview</h2>

    <div class="summary-cards">

        <div class="summary-card">
            <h3>42</h3>
            <p>Total Projects Completed</p>
        </div>

        <div class="summary-card">
            <h3>58</h3>
            <p>Total Orders</p>
        </div>

        <div class="summary-card">
            <h3>4.9 ★</h3>
            <p>Average Rating</p>
        </div>

        <div class="summary-card">
            <h3>$13,800</h3>
            <p>Total Earnings</p>
        </div>

    </div>



    <!-- =======================
         ACTIVITY TIMELINE
    ======================== -->
    <h2 class="section-title">Activity Timeline</h2>

    <div class="timeline">

        <div class="timeline-item">
            <h4>Account Created</h4>
            <p>{{ $joined->format('d M, Y') }}</p>
        </div>

        <div class="timeline-item">
            <h4>First Project Completed</h4>
            <p>Living Room Interior • Feb 2023</p>
        </div>

        <div class="timeline-item">
            <h4>First 5★★★★★ Rating Received</h4>
            <p>“Amazing work! Highly recommended.” – Client</p>
        </div>

        <div class="timeline-item">
            <h4>50th Order Completed</h4>
            <p>Kitchen Remodeling • Sep 2024</p>
        </div>

    </div>



    <!-- =======================
         BADGES & ACHIEVEMENTS
    ======================== -->
    <h2 class="section-title">Achievements & Badges</h2>

    <div class="badges">
        <div class="badge-card">🏆 Top Rated Designer</div>
        <div class="badge-card">🔥 Fast Growing Designer</div>
        <div class="badge-card">💼 50+ Completed Projects</div>
        <div class="badge-card">🎉 1 Year Anniversary</div>
    </div>



    <!-- =======================
         SUGGESTION SECTION
    ======================== -->
    <h2 class="section-title">Improvement Suggestions</h2>

    <div class="suggestion-box">
        <ul>
            <li>Update your portfolio with more high-quality images.</li>
            <li>Try to complete orders faster to improve delivery rating.</li>
            <li>Communicate with clients frequently for better satisfaction.</li>
            <li>Target more high-value interior projects for better earnings.</li>
        </ul>
    </div>

</div>

@endsection
