@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('profile', $thread->creator) }}">
                        {{ $thread->creator->name }} 
                    </a> posted: {{ $thread->title }}
                    @can('update', $thread)
                        <form action="{{$thread->path()}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-xs pull-right">Delete</button>
                        </form>
                    @endcan()
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
            <br>
        
            @foreach ($replies as $reply)
                @include('threads.reply')
            @endforeach
            {{ $replies->links() }}

            @auth
                <form action="{{ $thread->path() . '/replies' }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" placeholder="Have something to say" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Reply</button>
                    </div>
                </form>
            @else
                <p class="h3 text-center">Please <a href="{{ route('login') }}"> Sign in </a> to participate in the Discussion </p>
            @endauth
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p>
                        This Thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#"> {{ $thread->creator->name }} </a>
                        and currently has {{ $thread->replies_count }} {{ Str::plural('Comment', $thread->replies_count) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
