@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="channel_id">Channel</label>
                                <select class="js-example-basic-single form-control" name="channel_id">
                                    <option value=""></option>
                                    @foreach ($channels as $channel)
                                        <option {{ old('channel_id') == $channel->id ? 'selected' : '' }} value="{{ $channel->id }}">{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                                @error('channel_id')
                                    <p class="text-danger" >{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <p class="text-danger" >{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea rows="8" name="body" id="body" placeholder="Your Thread" class="form-control">{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="text-danger" >{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Add Thread</button>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
