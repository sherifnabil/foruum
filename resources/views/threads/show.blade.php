@extends('layouts.app')

@section('content')
<thread-view :initiail-replies-count="{{ $thread->replies_count }}" inline-template>
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
                </div><br>

                <replies
                    @remove="repliesCount--"
                    @added="repliesCount++"
                    :data="{{ $thread->replies }}"
                ></replies>

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This Thread was published {{ $thread->created_at->diffForHumans() }}
                            by <a href="#"> {{ $thread->creator->name }} </a>
                            and currently has <span v-text="repliesCount"></span> {{ Str::plural('Comment', $thread->replies_count) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
