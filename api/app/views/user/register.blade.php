{{ Form::open(array('url' => 'register')) }}
    {{ Form::label('first_name', 'First Name') }}
    {{ Form::text('first_name') }}
    {{ $errors->first('first_name') }}
    <br />

    {{ Form::label('last_name', 'Last Name') }}
    {{ Form::text('last_name') }}
    {{ $errors->first('last_name') }}
    <br />

    {{ Form::label('email', 'Email') }}
    {{ Form::text('email', '') }}
    {{ $errors->first('email') }}
    <br />

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    {{ $errors->first('password') }}
    <br />

    {{ Form::submit('Register') }}
{{ Form::close() }}