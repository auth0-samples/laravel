# Laravel example tutorial

This is a tutorial on how to run an example [laravel](https://laravel.com/) application that uses [Auth0](auth0.com) for authentication, we have it in two flavor, as a local application using [Apache](https://www.apache.org/) or in the cloud using [heroku](https://www.heroku.com/).

## Local Application

### Installing Dependencies

```
php composer.phar install
```
> For more information about Composer usage, check [their official documentation](https://getcomposer.org/doc/01-basic-usage.md).

### (Optional) Configure the database

If you want to use `mysql` for the example, change settings in `.env` file. The default settings are:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

if you want to use another driver, modify `config/database.php` directly.

After the database is configured, apply the migrations:

```
php artisan migrate
```

### Configuration

1. Rename the `.env.example` file to `.env` and populate it with the required [Auth0](auth0.com) credentials. **Client ID**, **Client Secret**, and **Domain**.

2. Use `php artisan key:generate` to generate your `APP_KEY`, it should be added automatically to the `.env` file.

3. Go to your [Auth0 dashboard](https://manage.auth0.com) and add `http://<Apache IP>:8000/callback` to your **Allowed Callback URLs**.

4. Run `php artisan serve` and browse to [http://localhost:8000](http://localhost:8000)

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
* The `bootstrap/start.php` has a function that detects whether the environment is local or heroku

## Running the example with Docker

If you want to run with [Docker](https://www.docker.com/) you need to add the `AUTH0_DOMAIN` and `API_ID`
to the `.env` filed as explained [previously](#configure-auth0).

Execute in command line `sh exec.sh` to run the Docker in Linux, or `.\exec.ps1` to run the Docker in Windows.

## Issue Reporting

If you have found a bug or if you have a feature request, please report them at this repository issues section. Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## Author

[Auth0](auth0.com)

## License

This project is licensed under the MIT license. See the [LICENSE](LICENSE) file for more info.
