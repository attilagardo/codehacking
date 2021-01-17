@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_photo'))
        <p class="bg-danger">{{session('deleted_photo')}}</p>
    @endif

    <h1>Media</h1>


    @if($photos)

      <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Created</th>
              <th></th>
            </tr>
          </thead>

          @foreach($photos as $photo)
          <tbody>
            <tr>
              <td>{{$photo->id}}</td>
              <td><img height="80" src="{{$photo->file ? $photo->file : 'No Picture'}}"></td>
              <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>
              <td>
                 {!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}

                         <div class="form-group">
                             {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                         </div>

                 {!! Form::close() !!}
              </td>
            </tr>
          </tbody>
          @endforeach
        </table>
    @endif

@endsection