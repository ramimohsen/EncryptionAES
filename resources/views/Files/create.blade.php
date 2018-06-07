@extends('layouts.app')

@section('content')
   <h1>Upload new File</h1>
   {!! Form::open(['action'=>'FilesController@store','method'=>'POST','files'=>'true'])!!}
   <div class="form-group">
       {{Form::label('description','Description')}}
       {{Form::textarea('description','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description of the file'])}}    
   </div>
   <div class="form-group">
    {{Form::file('file')}}
   </div>
   {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
   {!! Form::close() !!}
@endsection