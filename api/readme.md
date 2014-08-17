# Laravel Rest API

Starter kit to let you focus on real work not boiler plate

## Install

Ubuntu 14.04

	sudo apt-get install php5 php5-mcrypt php5-mysqlnd mysql-server

Everything Else

	composer update
	php artisan migrate --package=tappleby/laravel-auth-token
	php artisan migrate

## Run

This will run as [http://localhost:8000/](http://localhost:8000/)

	php artisan serve

## Sending Emails

Emails are set to output to your log file, not to real email accounts. Your log file is located at **`app/storage/logs/laravel.log`**. If you need to send emails, edit `app/config/mail.php` and change the driver from **log** to **smtp**, or other supported drivers like mail, or sendmail.

	'driver' => 'log',

Can be changed to

	'driver' => 'smtp',

## Remigrate Everything

	php artisan migrate:reset

## Performance Settings

Be sure to change a few things when switching to production mode.

### Minify Assets

app/config/packages/mmanos/laravel-assets/config.php

	'combine' => true,
	'minify' => true,

### Turn Off Debugging

app/config/app.php

	'debug' => false,