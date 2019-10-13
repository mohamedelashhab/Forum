@extends('layouts.app')

@section('content')

<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <div class="flex">
                                <a href="{{route('profile', $thread->creator->name)}}">{{$thread->creator->name}}</a> posted:
                                {{$thread->title}}
                            </div>
                            @can('update', $thread)
                                <div>
                                    <form action="{{route('thread.delete',[$thread->channel ,$thread])}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-link">Delete</button>  
                                    </form>
                                </div>
                            @endcan
                            
                        </div>
                    </div>

                    <div class="card-body">
                        {{$thread->body}}
                    </div>
                    
                </div>
                <hr>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{$thread->created_at->diffForHumans()}} by
                        <a href="#">{{$thread->creator->name}}</a> and has currently <span v-text="repliesCount"></span>
                        {{str_plural('comment', $thread->replies_count)}}  <subscribe-button :flag="{{ json_encode($thread->isSubscribedTo) }}"></subscribe-button>
                    </div>
                    
                </div>  

                
            </div>

            <div class="col-md-8">
                <replies @removed="repliesCount--" @add="repliesCount++"> </replies>

            </div>

            

        </div>
    </div>

</thread-view>

@endsection
