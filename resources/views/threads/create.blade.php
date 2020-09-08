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
                                <input type="text" class="form-control" placeholder="Title" name="title">
                            </div>
                            <div class="form-group">
                                <textarea rows="8" name="body" id="body" placeholder="Your Thread" class="form-control"></textarea>
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
