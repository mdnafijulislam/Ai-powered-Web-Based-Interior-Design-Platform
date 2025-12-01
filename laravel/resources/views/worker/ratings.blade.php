@extends('layouts.main')

@section('title', 'Ratings & Reviews')

@section('content')

<style>
/* MAIN WRAPPER */
.ratings-wrapper {
    max-width: 1200px;
    margin: auto;
    padding: 35px 20px;
}

/* PAGE TITLE */
.page-title {
    font-size: 34px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 30px;
    background: linear-gradient(90deg, #000, #444);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* TOP OVERVIEW GRID */
.overview-cards {
    display: grid;
    grid-template-columns: 2fr 3fr;
    gap: 25px;
    margin-bottom: 30px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 6px 22px rgba(0,0,0,0.08);
}

/* STAR DISPLAY */
.avg-rating {
    font-size: 70px;
    font-weight: 900;
}

.star {
    color: gold;
    font-size: 20px;
}

/* BAR CHART */
.rating-bars .bar-box {
    margin-bottom: 10px;
}

.bar {
    height: 9px;
    background: #ddd;
    border-radius: 5px;
    position: relative;
}

.bar-fill {
    height: 9px;
    background: black;
    border-radius: 5px;
    position: absolute;
    left: 0;
    top: 0;
}

.bar-label {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

/* FILTERS */
.filter-section {
    margin: 20px 0;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-btn {
    border: 1px solid #ccc;
    padding: 8px 16px;
    border-radius: 25px;
    background: white;
    cursor: pointer;
    font-size: 14px;
    transition: .2s;
}

.filter-btn:hover {
    background: black;
    color: white;
}

/* REVIEW CARDS */
.review-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.review-header {
    display: flex;
    justify-content: space-between;
}

.client-name {
    font-size: 18px;
    font-weight: bold;
}

.review-date {
    font-size: 13px;
    color: gray;
}

.review-text {
    margin-top: 12px;
    font-size: 15px;
    color: #444;
}

/* STAR SMALL */
.small-star {
    color: gold;
    font-size: 16px;
}
</style>



<div class="ratings-wrapper">

    {{-- PAGE TITLE --}}
    <h2 class="page-title">⭐ Designer Ratings & Client Reviews</h2>


    {{-- TOP OVERVIEW --}}
    <div class="overview-cards">

        {{-- LEFT CARD: AVERAGE RATING --}}
        <div class="card">
            <div class="avg-rating">4.7</div>
            <div>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star" style="opacity:.4">★</span>
            </div>
            <p style="margin-top:8px; color:gray;">Based on 128 total reviews</p>
        </div>


        {{-- RIGHT CARD: RATING BARS --}}
        <div class="card rating-bars">

            @for($i=5; $i>=1; $i--)
            <div class="bar-box">
                <div class="bar-label">
                    <span>{{ $i }} ★</span>
                    <span>{{ 6 * $i + 4 }} reviews</span>
                </div>

                <div class="bar">
                    <div class="bar-fill" style="width: {{ $i * 18 }}%;"></div>
                </div>
            </div>
            @endfor

        </div>

    </div>



    {{-- FILTER SECTION --}}
    <div class="filter-section">
        <button class="filter-btn">All</button>
        <button class="filter-btn">5 Star</button>
        <button class="filter-btn">4 Star</button>
        <button class="filter-btn">3 Star</button>
        <button class="filter-btn">2 Star</button>
        <button class="filter-btn">1 Star</button>
        <button class="filter-btn">Newest</button>
        <button class="filter-btn">Oldest</button>
    </div>



    {{-- REVIEW CARDS --}}
    <div class="review-card">
        <div class="review-header">
            <span class="client-name">Tanvir Ahmed</span>
            <span class="review-date">12 Feb 2025</span>
        </div>

        <div style="margin: 5px 0;">
            <span class="small-star">★</span>
            <span class="small-star">★</span>
            <span class="small-star">★</span>
            <span class="small-star">★</span>
            <span class="small-star" style="opacity:.3">★</span>
        </div>

        <p class="review-text">
            Amazing work! The interior concept was clean, modern and delivered on time.
            Communication was also great.
        </p>

        <p style="margin-top:10px; font-size:13px; color:gray;">
            Project: Living Room Interior • Order #ORD-20201
        </p>
    </div>


    {{-- SAMPLE 2 --}}
    <div class="review-card">
        <div class="review-header">
            <span class="client-name">Mehedi Hasan</span>
            <span class="review-date">04 Feb 2025</span>
        </div>

        <div>
            <span class="small-star">★</span>
            <span class="small-star">★</span>
            <span class="small-star">★</span>
            <span class="small-star" style="opacity:.5">★</span>
            <span class="small-star" style="opacity:.2">★</span>
        </div>

        <p class="review-text">
            Good design but delivery was slightly late. But overall satisfied.
        </p>

        <p style="margin-top:10px; font-size:13px; color:gray;">
            Project: Kitchen Remodeling • Order #ORD-20218
        </p>
    </div>

</div>

@endsection
