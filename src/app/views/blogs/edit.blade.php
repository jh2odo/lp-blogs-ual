<h2 class="edit-post">
    Edit Blog
</h2>
<hr>
{{ Form::open(['route'=>['blog.update',$blog->id_blogs]]) }}
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('title','Blog Title:') }}
        {{ Form::text('title',Input::old('title',$blog->title)) }}
    </div>
</div>
<div class="row">
    <div class="small-7 large-7 column">
        {{ Form::label('description','Description:') }}
        {{ Form::textarea('description',Input::old('content',$blog->description),['rows'=>5]) }}
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
{{ HTML::linkRoute('blog.list','Cancel',null,['class' => 'button tiny radius']) }}
{{ Form::submit('Update',['class'=>'button tiny radius']) }}
{{ Form::close() }}
