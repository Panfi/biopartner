# Laravel Meeting Request package
A laravel package to request meetings

## Installation

[PHP](https://php.net) 7+, [Laravel](https://laravel.com/docs/5.4) 5.4+ and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel, and simply add the following to your `composer.json` file.

```
"repositories": [
  	{
        "type": "git",
    	"url": "https://gladwelln@bitbucket.org/gladwelln/biopartnering.git"
	}
],

"require": {
	"biopartnering/biopartnering": "dev-master"
}
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.
Also run `php artisan vendor:publish` to publish public files.

If you are using Laravel 5.5 or later, the service provider auto discovery feature will load the required classes after installation otherwise, you need to register the service provider.
Open up `config/app.php` and add the following to the `providers` key.

* `biopartnering\biopartnering\BioPartneringServiceProvider::class`

Update your mail server credentials add below to your .env file:

```bash
MAIL_FROM_ADDRESS=postmaster@mg.hybse.com
MAIL_FROM_NAME="Bio Africa"
```

Update DB credentials on your .env file:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biopartnering
DB_USERNAME=root
DB_PASSWORD=******
```

Migrate transaction table:
```bash
php artisan migrate
```
