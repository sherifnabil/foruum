<reply :attributes="{{ json_encode($reply) }}" inline-template v-cloak>
    <div>
        <div class="card" id="reply-{{ $reply->id }}">
            <div class="card-header">
                <div class="level">
                    <a href="{{ route('profile', $reply->owner) }}">
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
                <div v-if="editing">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" ></textarea>
                    </div>
                    <button @click="update" class="btn btn-success ml-2">Update</button>
                    <button @click="editing = false" class="btn btn-link ml-2">Cancel</button>

                </div>
                <div v-else v-text="body">
                    {{ $reply->body }}
                </div>
            </div>
        
            @can('update', $reply)
                <div class="card-footer">
                    <button @click="editing = true" class="btn btn-info btn-xs pull-right ml-2">Edit</button>
                    <button @click="destroy" class="btn btn-danger pull-right btn-xs">Delete</button>
                </div>
            @endcan
            
        </div><br>
    </div>
</reply>