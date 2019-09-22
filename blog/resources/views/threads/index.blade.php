@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <div class="flex">
                                <a href="{{$thread->path()}}">{{$thread->title}}</a>
                            </div>
                            <div>
                                <a class="level" href="{{$thread->path()}}"><strong>{{$thread->replies_count}} {{str_plural('reply', $thread->replies_count)}}</strong></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">                    
                        <article>
                                <div class="body">{{$thread->body}}</div>
                            
                        </article>
                    </div> 
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
