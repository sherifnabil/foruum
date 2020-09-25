@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="page-header">
                <h1>
                    {{ ucfirst($profileUser->name) }}
                </h1>
            </div>
            
            @foreach ($activities as $date => $anActivity)
                <h2 class="page-header text-center">
                    {{ $date }}
                </h2>
                @foreach ($anActivity as $activity)
                    @include("profiles.activities.{$activity->type}")
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
