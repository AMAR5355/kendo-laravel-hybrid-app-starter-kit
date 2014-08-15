# Hybrid Mobile App Starter Kit #

This started kit is designed to get you up and running with the basic functionality.

Includes the following:

- Registration
- Login
- Forgot Password (Incomplete)
- Single Page Application using **Kendo UI Mobile**
- JWT - Json Web Tokens, a scalable, secure session storage
- CORS - Cross-origin resource sharing - for local / remote development
- API starter for Laravel

## Folders ##

### app/ ###

This is the single page application (SPA), written entirely in JavaScript, CSS and HTML.

For more information about the App please go to the [README](app/README.md) in that folder.

### api/ ###

This is the back-end service to the single page application. This handles the login, registration and forgot password features as well as other features you decide to include. This is written in PHP using Laravel as the framework. 

For more information about the API please go to the [README](api/readme.md) in that folder.

## Requirements ##

You only need PHP 5.4+ and Composer. Other tools like mysql, apache, etc is not needed for local development. If you are on windows please edit the php.ini to allow SQLite & PDO SQlite

## PHP on Windows ##

Download the [PHP 5.5.x](http://windows.php.net/downloads/releases/php-5.5.15-nts-Win32-VC11-x86.zip) *VC11 x86 Non Thread Safe* is fine. Unzip PHP somewhere you can get too. If you want add that folder to your environment PATH variable. 

## Composer on Windows ##

You can download an installer for composer, this lets you call composer from anywhere. The installer lets you locate PHP so you don't need to edit your environment PATH variable. [Download Composer](https://getcomposer.org/Composer-Setup.exe)

### php.ini ##

You can download a sample for windows from a gist: [php.ini](https://gist.github.com/joseph-montanez/97a68cfd26e79a5f54a4) or follow the guide below

1. Rename `php.ini-developlemt` to `php.ini`
2. Setup extensions directory, uncomment `extension_dir`

       ; Directory in which the loadable extensions (modules) reside.
	   ; http://php.net/extension-dir
	   ; extension_dir = "./"
	   ; On windows:
	    extension_dir = "ext"
3. Enable the following:

	   extension=php_curl.dll       ; for composer
	   extension=php_openssl.dll    ; for composer
	   extension=php_pdo_sqlite.dll ; for web api
	   extension=php_sqlite3.dll    ; for web api