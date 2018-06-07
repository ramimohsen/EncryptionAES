@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4 "> Cryptology</h1>
      <p class="lead">All files in one place</p>
    </div>
  </div>

    @if (count($files)>0)
        <div class="row">
        @foreach ($files as $file)
          <div class="col-sm-6">
        <div class="card text-center">
        <div class="card-header">
            Published By {{$file->user->email}}
          </div>
          <div class="card-body">
            <h5 class="card-title"><a href="/files/{{$file->id}}"class="btn btn-info">File Details</a></h5>
          </div>
          <div class="card-footer text-muted">
              Uploaded at {{$file->created_at}}
          </div>
        </div>

        <br>
        </div>
        @endforeach
        </div>
    @else
        <p>There are no files </p>
    @endif
@endsection


    
