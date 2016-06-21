# Laravel example tutorial

This is a tutorial on how to run an example laravel application that uses auth0 for authentication, we have it in two flavor, as a local application using apache, or in the cloud using heroku

## Clone the example

```
git clone https://github.com/auth0/laravel-auth0-sample.git
```

## Local apache

### Update dependencies

Download composer and execute

```
php composer.phar install
```

### Configure the database

If you want to use `mysql` for the example, change settings in `.env` file. The default settings are:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

if you want to use another driver, modify `config/database.php` directly.

After the database is configured, apply the migrations
```
php artisan migrate
```

### Configure Auth0

1. Edit the file `.env` with your auth0 domain, app id and secret.

2. Go to your auth0 dashboard and add `http://<ip-to-apache>/auth0/callback` to your authorized callbacks

3. Run `php artisan serve` and browse to [http://localhost:8000](http://localhost:8000)



## Heroku
### Configure your heroku account
In order to do this you need to have an heroku account and the [Heroku toolbelt](https://toolbelt.heroku.com/) installed.

Login to heroku

     heroku login

Next, we need to create an application from the local git repository. In your path to the repo execute

    heroku create --buildpack https://github.com/heroku/heroku-buildpack-php#beta

Now you have a remote called heroku and you can upload to it by executing

    git push heroku master

### Configure the database

Heroku uses postgresql by default, we can enable it by executing

    heroku addons:add heroku-postgresql:dev

Then apply the migrations by running the following command

    heroku run php /app/artisan migrate

### Configure Auth0

Add auth0 as an addon

    heroku addons:add auth0 --type=php --subdomain=<your-domain>

Open your auth0 dashboard (you can use `heroku addons:open auth0`) and configure the callback of your application to be

    http://<domain>/auth0/callback

Configure heroku to use the same callback

    heroku config:set AUTH0_CALLBACK_URL="http://<domain>/auth0/callback"

## Things to note:
* The Procfile tells heroku how to invoke an apache instance that is compatible with laravel
* The `bootstrap/start.php` has a function that detects whether the enviroment is local or heroku

## Issue Reporting

If you have found a bug or if you have a feature request, please report them at this repository issues section. Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## Author

[Auth0](auth0.com)

## License

This project is licensed under the MIT license. See the [LICENSE](LICENSE) file for more info.