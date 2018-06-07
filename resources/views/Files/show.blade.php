        @extends('layouts.app')

        @section('content')


                <div class="card text-center">
                        <div class="card-header">
                                Uploaded By {{$file->user->email}}
                        </div>
                        <div class="card-body">
                                <h4 class="card-title">File Information</h4>

                                <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>

                                                <th scope="col">Name</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Extension</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>

                                                <td> {{$file->file_name}}</td>
                                                <td> {{$file->file_size}} B</td>
                                                <td> {{$file->file_extention}}</td>
                                        </tr>

                                        </tbody>
                                </table>
<hr>
                            <h4>Description</h4>
                            <p >{!!$file->description!!}</p>

<hr>
                        @auth
                                        @if (Auth::user()->id == $file->user_id)

                                                <a href="/files/{{$file->id}}/edit" class="btn btn-info float-left">Edit</a>

                                                {!! Form::open(['action'=>['FilesController@destroy',$file->id],'method'=>'POST','class'=>'float-left'])!!}
                                                {{Form::hidden('_method','Delete')}}
                                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                                {!! Form::close() !!}
                                                {!! Form::open(['action'=>['FilesController@download',$file->id],'method'=>'GET'])!!}
                                                {{Form::submit('Download Decrypted Version',['class'=>'btn btn-success float-right'])}}
                                                {!! Form::close() !!}
                                                {!! Form::open(['action'=>['FilesController@download_EN',$file->id],'method'=>'GET'])!!}
                                                {{Form::submit('Download Encrypted Version',['class'=>'btn btn-danger float-right'])}}
                                                {!! Form::close() !!}
                                        @endif


                                @endauth







                        </div>
                        <div class="card-footer text-muted">
                                <a href="/files" class="btn btn-primary ">Go Back</a><br><br>

                                <small> Uploaded at {{$file->created_at}}</small>
                        </div>
                </div>

       

        
        @endsection
























