<?php

return array(
	'format_credentials' => function ($username, $password) {
	    return array(
	        'email' => $username,
	        // 'username' => $username,
	        'password' => $password,
	        'active' => true
	    );
	}
);