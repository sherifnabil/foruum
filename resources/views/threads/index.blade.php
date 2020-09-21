@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($threads as $thread)
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <a href="{{ $thread->path() }}" class="pull-right">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
                            <h4>
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <article>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div><br>
            @empty
                <p>There are no Relevent Results at this time</p>
            @endforelse                
        </div>
    </div>
</div>
@endsection
