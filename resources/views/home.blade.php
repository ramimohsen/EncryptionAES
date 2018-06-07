@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>My Files</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="btn btn-primary my-2 my-sm-0" href="/files/create">Encrypt New File</a>
                    <br><br>

                    @if(count($files) > 0)
                        <table class="table  table-hover ">

                            @foreach($files as $file)
                                <tr>
                                    <td><a href="/files/{{$file->id}}">{{$file->file_name}}</a></td>
                                    <td>
                                        <a href="/files/{{$file->id}}/edit" class="btn btn-info ">Edit</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['action'=>['FilesController@download',$file->id],'method'=>'GET'])!!}
                                        {{Form::submit('Decrypt',['class'=>'btn btn-success'])}}
                                        {!! Form::close() !!}
                                    </td>

                                    <td>
                                            {!! Form::open(['action'=>['FilesController@destroy',$file->id],'method'=>'POST'])!!}
                                            {{Form::hidden('_method','Delete')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                             {!! Form::close() !!}
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no Files</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
