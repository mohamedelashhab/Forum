
<reply :reply="{{$reply}}" inline-template v-cloak>
   
    <div class="card" id="reply-{{$reply->id}}">

            <div  class="card-header">
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
                <div v-if="editing">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <div v-else>
                    <div v-html="body"></div>
                </div>
            </div>

            @can('update', $reply)
            
                <div class="card-footer level">
                    <button class="btn btn-primary btn-xs" v-if="!editing" @click = "editing = true">edit</button>&nbsp;&nbsp;
                    <button class="btn btn-xs btn-primary btn-xs" v-if="editing" @click = "update({{$reply->id}})">Update</button>&nbsp;&nbsp;
                    <button class="btn btn-danger btn-xs" v-if="!editing" @click = "destroy({{$reply->id}})">delete</button>
                    <button class="btn btn-primary btn-xs" v-if="editing" @click = "editing = false">cancel</button>

                </div>      
            @endcan
    </div>

</reply>
