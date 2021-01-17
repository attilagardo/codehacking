@extends('layouts.admin')

@section('content')

    @if(Session::has('updated_category'))
        <p class="bg-danger">{{session('updated_category')}}</p>
    @endif

    @if(Session::has('deleted_category'))
        <p class="bg-danger">{{session('deleted_category')}}</p>
    @endif

    <h1>Categories</h1>

    <div class="col-sm-6">

         {!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}

                 {{csrf_field()}}

                 <div class="form-group">
                     {!! Form::label('name','Name') !!}
                     {!! Form::text('name',null,['class'=>'form-control']) !!}
                 </div>

                 <div class="form-group">
                     {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
                 </div>

         {!! Form::close() !!}

    </div>

    <div class="col-sm-6">

        @if($categories)

            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                </tr>
                </thead>

                @foreach($categories as $category)
                    <tbody>
                    <tr>
                        <td>{{$category->id}}</td>
                        <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No Date'}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>

        @endif


    </div>


@endsection