<?php

class Event extends \Eloquent {
	protected $fillable = [
		'first_name', 
		'last_name',
		'email',
		'company',
		'phone',
		'message_body'
	];
}