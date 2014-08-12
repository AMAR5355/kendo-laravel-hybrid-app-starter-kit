# Alpha Calendar

Alpha Calendar is a group calendar system.

## Install

Ubuntu 14.04

	sudo apt-get install php5 php5-mcrypt php5-mysqlnd mysql-server

Everything Else

	composer update
	php artisan migrate --package=cartalyst/sentry
	php artisan migrate --package=tappleby/laravel-auth-token
	php artisan migrate

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