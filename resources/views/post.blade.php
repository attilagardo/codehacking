@extends('layouts.blog-post')



@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->body}}</p>
    <hr>

    <!-- Blog Comments -->

    @if(Auth::check())

        @if(Session::has('comment_message'))
            <p class="bg-danger">{{session('comment_message')}}</p>
        @endif

        <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
             {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}

                     {{csrf_field()}}

                      <input type="text" name="post_id" value="{{$post->id}}" class="hidden">


                     <div class="form-group">
                         {!! Form::label('','') !!}
                         {!! Form::textarea('body',null,['class'=>'form-control','row'=>3]) !!}
                     </div>

                     <div class="form-group">
                         {!! Form::submit('Submit Comment',['class'=>'btn btn-primary']) !!}
                     </div>

             {!! Form::close() !!}
        </div>

    @endif

    <hr>

    <!-- Posted Comments -->

    @if(count($comments)>0)

    <!-- Comment -->
    @foreach($comments as $comment)
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->DiffForhumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>

            <!-- Nested Comment -->
            @foreach($comment->replies as $reply)

                @if($reply->is_active == 1)
                <div id="nested-media" class="media">

                        <a class="pull-left" href="#">
                            <img height="60" class="media-object" src="{{$reply->photo}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$reply->author}}
                                <small>{{$reply->created_at->DiffForhumans()}}</small>
                            </h4>
                            <p>{{$reply->body}}</p>
                        </div>
                </div>
                @else
                    <h1 class="text-center">No Replies</h1>
                @endif
            @endforeach

                    <div class="comment-reply-container">

                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                        <div class="comment-reply">

                             {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}

                                     {{csrf_field()}}

                                      <input type="text" name="comment_id" value="{{$comment->id}}" class="hidden">

                                     <div class="form-group">
                                         {!! Form::label('','') !!}
                                         {!! Form::textarea('body',null,['class'=>'form-control','rows'=>2]) !!}
                                     </div>

                                     <div class="form-group">
                                         {!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
                                     </div>

                             {!! Form::close() !!}
                        </div>
                    </div>


                <!-- End Nested Comment -->


        </div>
    </div>
    @endforeach
    @endif



@endsection

@section('scripts')

    <script>

        $(document).on("click", ".toggle-reply", function() {
            $(this).next().slideToggle('slow');
        });

    </script>

@endsection