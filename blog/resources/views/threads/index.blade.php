@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum</div>

                <div class="card-body">
                    @foreach ($threads as $thread)                      
                        <article>
                            <a href="{{$thread->path()}}">{{$thread->title}}</a>
                            <a class="level" href="{{$thread->path()}}"><strong>{{$thread->replies_count}} {{str_plural('reply', $thread->replies_count)}}</strong></a>
                            <div class="body">{{$thread->body}}</div>
                        </article>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
