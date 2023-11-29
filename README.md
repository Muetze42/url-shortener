# URL Shortener

My personal URL Shortener. Created with [Laravel](https://laravel.com/) and [Laravel Nova](https://nova.laravel.com/).

Features:

* Teams (URLs administrated by a Team)
* The session and CSRF check is deactivated for public routes to avoid unnecessary database queries
* Click Logging
* Referrer Logging
* `?ref=` Query Parameter Logging
* Logging via [Job](app/Jobs/UrlVisited.php)
* Administration reachable over admin subdomain `admin.domain.tld`

[Shortener Config](config/shortener.php)

## Running Tests

```shell
php artisan test
```
