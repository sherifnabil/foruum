@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">
                        {{ $thread->creator->name }} 
                    </a> posted: {{ $thread->title }}
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        </div>
    </div><br>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
    </div>

    @auth
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="{{ $thread->path() . '/replies' }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" placeholder="Have something to say" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Reply</button>
                    </div>
                </form>

            </div>
        </div>
    @else
    <p class="h3 text-center">Please <a href="{{ route('login') }}"> Sign in </a> to participate in the Discussion </p>
    @endauth
</div>
@endsection
