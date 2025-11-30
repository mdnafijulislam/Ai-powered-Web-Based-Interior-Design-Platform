@extends('layouts.main')

@section('title', 'Account Life Cycle')

@section('content')

<div class="lifecycle-container">

    <h2>📅 Account Life Cycle</h2>

    <div class="life-box">
        <p><strong>Account Owner:</strong> {{ $user->name }}</p>
        <p><strong>Joined On:</strong> {{ $joined->format('d M Y') }}</p>
        <p><strong>Account Age:</strong> {{ $age }}</p>
    </div>

</div>

@endsection
