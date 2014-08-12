@extends('layouts.main')

@section('content')
    <div class="col8">
        <h1 class="headline">Contact Us</h1>
        <p>We appreciate your comments and inquiries. <span class="imp">(*required field)</span></p>
        {{ Form::open(array('class' => 'form', 'action' => 'ContactController@process')) }}
            <div class="form-field">
                {{ Form::label('first_name', '* First Name', ['class' => 'control-label']) }}
                {{ Form::text('first_name', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('first_name') }}}</span>
            </div>

            <div class="form-field">
                {{ Form::label('last_name', '* Last Name', ['class' => 'control-label']) }}
                {{ Form::text('last_name', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('last_name') }}}</span>
            </div>

            <div class="form-field">
                {{ Form::label('email', '* Email', ['class' => 'control-label']) }}
                {{ Form::text('email', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('email') }}}</span>
            </div>

            <div class="form-field">
                {{ Form::label('company', 'Company', ['class' => 'control-label']) }}
                {{ Form::text('company', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('company') }}}</span>
            </div>

            <div class="form-field">
                {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}
                {{ Form::text('phone', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('phone') }}}</span>
            </div>

            <div class="form-field">
                {{ Form::label('message_body', '* Message', ['class' => 'control-label']) }}
                {{ Form::textarea('message_body', null, ['class' => 'text']) }}
                <span class="error-msg">{{{ $errors->first('message_body') }}}</span>
            </div>


            {{ Form::submit('Send') }}
        {{ Form::close() }}
        <br class="clear">
    </div>
    @include('contacts/right-col')
@endsection