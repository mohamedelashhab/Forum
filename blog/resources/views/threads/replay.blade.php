<div class="card">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <form action="{{route('favorite', $reply->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{$reply->isFavorited() ? 'disabled': ''}} >
                            {{$reply->favorites()->count()}} {{str_plural('Favorite', $reply->favorites()->count())}}</button>
                    </form>
                </div>

                <div>
                    <a href="#">{{$reply->owner->name}} </a>said {{ $reply->created_at->diffForHumans()}}
                </div>
                    
                    
            </div>
           
        </div>

        <div class="card-body">
            {{$reply->body}}
        </div>
</div>