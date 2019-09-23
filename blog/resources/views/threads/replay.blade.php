<div class="card">
        <div id="reply-{{$reply->id}}" class="card-header">
            <div class="level">
                <div class="flex">
                    <a href="{{route('profile', $reply->owner->name)}}">{{$reply->owner->name}} </a>said {{ $reply->created_at->diffForHumans()}}
                </div>
                <div>
                    <form action="{{route('favorite', $reply->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{$reply->isFavorited() ? 'disabled': ''}} >
                            {{$reply->favorites_count}} {{str_plural('Favorite', $reply->favorites_count)}}</button>
                    </form>
                </div>


            </div>
           
        </div>

        <div class="card-body">
            {{$reply->body}}
        </div>
</div>
<hr>