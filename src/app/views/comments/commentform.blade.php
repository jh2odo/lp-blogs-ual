
<div id="reply">
    <h2>Leave a Reply</h2>
    
    @if(Auth::check())
    
	    @if(Session::has('success'))
	        <div data-alert class="alert-box round">
	            {{Session::get('success')}}
	            <a href="#" class="close">&times;</a>
	        </div>
	    @endif
	    {{ Form::open(['route'=>['comment.new',$post->id_posts]]) }}
	        <div class="row">
	            <div class="small-7 large-7 column">
	                {{ Form::label('content','Content:') }}
	                {{ Form::textarea('content',Input::old('content'),['rows'=>5]) }}
	            </div>
	        </div>
	    @if($errors->has())
	        @foreach($errors->all() as $error)
	            <div data-alert class="alert-box warning round">
	                {{$error}}
	                <a href="#" class="close">&times;</a>
	            </div>
	        @endforeach
	    @endif
	    {{ Form::submit('Submit',['class'=>'button tiny radius']) }}
	    {{ Form::close() }}
   @else
		<p>Es necesario estar registrado para comentar el post</p>
   @endif
</div>
