<h2 class="edit-post">
    Edit User
</h2>
<hr>
{{ Form::open(['route'=>['user.update']]) }}
<?php if(FALSE){ ?>
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('username','Username') }}
        {{ Form::text('username',Input::old('username',$user->username)) }}
    </div>
</div>
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('password','Password') }}
        {{ Form::password('password',Input::old('password',$user->password)) }}
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="small-5 large-5 column">
        {{ Form::label('email','Email') }}
        {{ Form::text('email',Input::old('email',$user->email)) }}
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
<?php if(FALSE){ ?>
{{ HTML::linkRoute('dashboard.show','Cancel',null,['class' => 'button tiny radius']) }}
<?php } ?>
{{ Form::submit('Update',['class'=>'button tiny radius']) }}
{{ HTML::linkRoute('user.delete','Delete',null,['class' => 'button tiny radius'])}}
{{ Form::close() }}
