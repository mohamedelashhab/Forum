@extends('layouts.app')

@section('content')

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
                    <a href="#">{{$thread->creator->name}}</a> and has currently {{$thread->replies_count}}
                    {{str_plural('comment', $thread->replies_count)}}
                </div>
            </div>  
        </div>

        <div class="col-md-8">
                @foreach ($replies as $reply)
                    @include('threads.replay') 
                @endforeach
                <hr>
            {{$replies->links()}}
        </div>

        <div class="col-md-8">
            @if (auth()->check())
                
                    <form action="{{$thread->path() . '/replies'}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reply"></label>
                            <textarea id="reply" class="form-control" name="body" placeholder="Have something to say" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">post</button>
                    </form>
                
            @else
               <div class="col-md-8"> <p class="text-center"> please <a href="{{route('login')}}">login</a> to participate in this discussion </p> </div>
            @endif
        </div>

    </div>
</div>

@endsection
