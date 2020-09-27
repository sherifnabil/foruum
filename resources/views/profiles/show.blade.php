@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1>
                    {{ ucfirst($profileUser->name) }}
                </h1>
            </div>
            
            @forelse ($activities as $date => $anActivity)
                <h2 class="page-header text-center">
                    {{ $date }}
                </h2>
                @foreach ($anActivity as $activity)
                    @if (view()->exists("profiles.activities.{$activity->type}"))
                        @include("profiles.activities.{$activity->type}")
                    @endif
                @endforeach
            @empty
                <h4>There's no activity for this user yet</h4>
            @endforelse
        </div>
    </div>
@endsection
