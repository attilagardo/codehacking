@extends('layouts.admin')

@section('content')

    <h1>Posts</h1>

    @if(Session::has('deleted_post'))
        <p class="bg-danger">{{session('deleted_post')}}</p>
    @endif

      <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Photo</th>
              <th>Owner</th>
              <th>Category</th>
              <th>Title</th>
              <th>Body</th>
              <th>View</th>
              <th>View</th>
              <th>Created</th>
              <th>Updated</th>
          </thead>
          <tbody>

          @if('posts')
              @foreach($posts as $post)
                <tr>
                  <td>{{$post->id}}</td>
                  <td><img height="50" src="{{$post->photo ? $post->photo->file : 'https://via.placeholder.com/400'}}"></td>
                  <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
                  <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                  <td>{{$post->title}}</td>
                  <td>{{str_limit($post->body,20)}}</td>
                  <td><a href="{{route('home.post',$post->id)}}">Post</a></td>
                  <td><a href="{{route('admin.comments.show',$post->id)}}">Comments ({{count($post->comments)}})</a></td>
                  <td>{{$post->created_at->DiffForhumans()}}</td>
                  <td>{{$post->updated_at->DiffForhumans()}}</td>
                </tr>
              @endforeach
          @endif

          </tbody>
        </table>

        <div class="row">

            <div class="col-sm-6 col-sm-offset-5">

                {{$posts->render()}}

            </div>

        </div>

@endsection