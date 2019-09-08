@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{$thread->creator->name}}</a> posted:
                    {{$thread->title}}
                </div>

                <div class="card-body">
                    {{$thread->body}}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
                @include('threads.replay') 
            @endforeach
        </div>
        @if (auth()->check())
            <div class="col-md-8" style="padding:100">
                <form action="{{$thread->path() . '/replies'}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply"></label>
                        <textarea id="reply" class="form-control" name="body" placeholder="Have something to say" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">post</button>
                </form>
            </div> 
        @else
           <div class="col-md-8"> <p class="text-center"> please <a href="{{route('login')}}">login</a> to participate in this discussion </p> </div>
        @endif
        
        
    </div>

</div>
@endsection
