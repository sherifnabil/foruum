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
                <form action="">
                    <textarea name="" id="" cols="30" rows="10"></textarea>
                </form>
            </div>
        </div>
    @endauth
</div>
@endsection
