@extends('layouts.main')

@section('content')
    <div class="col8">
        <h1 class="headline">Remind Password</h1>
		<form action="{{ action('RemindersController@postReset') }}" method="POST">
		    <input type="hidden" name="token" value="{{ $token }}">
		    <input type="email" name="email">
		    <input type="password" name="password">
		    <input type="password" name="password_confirmation">
		    <input type="submit" value="Reset Password">
		</form>
        <br class="clear">
    </div>
    @include('contacts/right-col')
@endsection