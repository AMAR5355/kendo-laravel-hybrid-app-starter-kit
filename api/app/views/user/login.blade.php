{{ Form::open(array('url' => 'login')) }}
    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', '') }}
    {{ $errors->first('email') }}
    <br />

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    {{ $errors->first('password') }}
    <br />


    {{ Form::label('remember_me', 'Remember Me') }}
    {{ Form::checkbox('remember_me', '1') }}

    {{ Form::submit('Login') }}
{{ Form::close() }}