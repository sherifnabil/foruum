<div class="card">
    <div class="card-header">
        <div class="level">
            <a href="#">
                {{ $reply->owner->name }} 
            </a> Said ... {{ $reply->created_at->diffForHumans() }}

            <div class="pull-right">
                <form action="/replies/{{ $reply->id }}/favorites" method="POST">
                    @csrf
                    <button class="btn btn-success" type="submit" {{  $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Like', $reply->favorites_count) }}
                        
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div><br>