@extends('layout') 
@section('content')

<form class="form-horizontal" 
    method="POST" enctype="multipart/form-data"
    action="{{ route('users.update', ['user' => $user->id]) }}">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-4">    
            <img src="{{ $user->image ? $user->image->url() : '' }}" 
                class="img-thumbnail avatar">
            
            <div class="card mt-4">
                <div class="card-body">
                        <h6>Upload a different photo...</h6>
                    <input type="file" class="form-control-file" name="avatar">
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label">Name:</label>
                <input class="form-control" value="" type="text">
            </div>

            <div class="form-group">
                <input class="btn btn-primary" value="Save Changes" type="submit">
            </div>
        </div>
    </div>
</form>
@endsection