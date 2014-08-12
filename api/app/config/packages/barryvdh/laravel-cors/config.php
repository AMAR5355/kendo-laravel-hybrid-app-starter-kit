<?php

return array(

	'defaults' => array(
		'supportsCredentials' => false,
		'allowedOrigins' => array(),
		'allowedHeaders' => array(),
		'allowedMethods' => array(),
		'exposedHeaders' => array(),
		'maxAge' => 0,
		'hosts' => array(),
	),

	'paths' => array(
		'auth' => array(
			'allowedOrigins' => array('*'),
			'allowedHeaders' => array('Accept', 'Content-Type', 'X-Auth-Token'),
			'allowedMethods' => array('POST', 'PUT', 'GET', 'DELETE'),
			'maxAge' => 3600,
		),
		'api/*' => array(
			'allowedOrigins' => array('*'),
			'allowedHeaders' => array('Accept', 'Content-Type', 'X-Auth-Token'),
			'allowedMethods' => array('*'),
			'maxAge' => 3600,
		),
		'*' => array(
			'allowedOrigins' => array('*'),
			'allowedHeaders' => array('Content-Type'),
			'allowedMethods' => array('POST', 'PUT', 'GET', 'DELETE'),
			'maxAge' => 3600,
			'hosts' => array('api.*'),
		),
	),
);