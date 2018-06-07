@extends('layouts.app')

@section('content')
   <h1>Edit file Information</h1>
   {!! Form::open(['action'=>['FilesController@update',$file->id],'method'=>'POST'])!!}
   <div class="form-group">
       {{Form::label('description','Description')}}
       {{Form::textarea('description',$file->description,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Description of the file'])}}    
   </div>
   
   {{Form::hidden('_method','PUT')}}
   {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
   {!! Form::close() !!}
@endsection