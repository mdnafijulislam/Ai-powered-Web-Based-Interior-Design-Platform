@extends('layouts.main')

@section('title', 'My Portfolio')

@section('content')

<style>
.portfolio-wrapper { max-width: 1200px; margin:auto; padding:40px; }
.form-box { background:white; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.08); margin-bottom:40px; }
.portfolio-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(300px,1fr)); gap:25px; }
.card { background:white; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08); }
.card img { width:100%; height:220px; object-fit:cover; }
.card-body { padding:15px; }
.btn { display:inline-block; padding:8px 16px; border-radius:8px; background:black; color:white; text-decoration:none; margin-top:8px; }
</style>


<div class="portfolio-wrapper">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div style="padding:12px; background:#d4edda; border-left:4px solid green; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif


    {{-- =========================
         UPLOAD NEW PROJECT FORM
    ========================== --}}
    <div class="form-box">
        <h2>Add New Portfolio Project</h2>

        <form action="{{ route('worker.portfolio.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label>Project Title *</label>
            <input type="text" name="title" class="form-control" required>

            <label style="margin-top:10px;">Location</label>
            <input type="text" name="location" class="form-control">

            <label style="margin-top:10px;">Project Type</label>
            <input type="text" name="type" class="form-control">

            <label style="margin-top:10px;">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>

            <label style="margin-top:10px;">Project Image *</label>
            <input type="file" name="image" class="form-control" required>

            <button class="btn" style="margin-top:15px;">Upload Project</button>
        </form>
    </div>



    {{-- =========================
         DYNAMIC PORTFOLIO LIST
    ========================== --}}
    <h2 style="margin-bottom:20px;">Your Portfolio Projects</h2>

    @if($portfolios->count() == 0)
        <p>No portfolio projects uploaded yet.</p>
    @else

    <div class="portfolio-grid">
        @foreach($portfolios as $p)
            <div class="card">
                <img src="{{ $p->image_url }}" alt="Project Image">

                <div class="card-body">
                    <h3>{{ $p->title }}</h3>

                    <p><strong>Location:</strong> {{ $p->location }}</p>
                    <p><strong>Type:</strong> {{ $p->type }}</p>

                    <a href="{{ route('worker.portfolio.details', $p->id) }}" class="btn">View Details</a>
                </div>
            </div>
        @endforeach
    </div>

    @endif

</div>

@endsection
