@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">new thread</div>

                <div class="card-body">
                    <form action="/threads" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="channel_id">Channel</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Select One...</option>
                                @foreach (App\Channel::all() as $channel)
                                    <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected': ''}} >{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" id="title" required>
                        </div>

                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea id="body" class="form-control" name="body"  rows="8" required>{{old('body')}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Publish</button>
                        <hr>

                        @foreach ($errors->all() as $error)
                            <ul>
                                <li class="alert alert-danger">{{$error}}</li>
                            </ul>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
