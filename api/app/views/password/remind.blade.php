@extends('layouts.main')

@section('content')
    <div class="col8">
        <h1 class="headline">Remind Password</h1>
        <form action="{{ action('RemindersController@postRemind') }}" method="POST">
		    <input type="email" name="email">
		    <input type="submit" value="Send Reminder">
		</form>
        <br class="clear">
    </div>
    @include('contacts/right-col')
@endsection