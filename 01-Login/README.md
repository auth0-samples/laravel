# Laravel Login Tutorial

## Introduction

This tutorial explains how to run an example [Laravel](https://laravel.com/) application that uses [Auth0](auth0.com) for authentication. This project can be installed as a local application or in the cloud using [Heroku](https://www.heroku.com/).

A step-by-step [Quickstart document](hhttps://auth0.com/docs/quickstart/webapp/laravel) is provided with more detail on how this example was built. If you prefer to skip it and just run the sample, make sure to setup the project first using the steps below.

## Create an Auth0 Account and Application

This tutorial requires an Auth0 account and a Application configured for this type. 

1. Sign up for your free Auth0 account [here](https://auth0.com/signup)
1. Go to **Applications > Create Application** in the Dashboard
1. Give your Application a name, select **Regular Web Application**, and click **Create**
1. Select **PHP (Laravel)** to see the steps for how this seed project was created or scroll up and click the **Settings** tab to get started using the pre-built project below.

## Local Application

This section assumes you have PHP and Apache installed and configured on a local machine (we recommend [Homebrew](https://github.com/Homebrew/homebrew-php) for this). You can modify the steps below to install this on a publicly-accessible web server as well. 

### Installing Dependencies

Dependencies are installed and updated with Composer. If you have Composer installed globally, run:

    composer install

Otherwise:

1. [Download Composer](https://getcomposer.org/download/)
1. [Install Composer](https://getcomposer.org/doc/00-intro.md)
1. [Run Composer](https://getcomposer.org/doc/01-basic-usage.md)

### Configure the Database (optional) 

If you want to use `mysql` for the example, change settings in `.env` file. The default settings are:

    DB_HOST=localhost
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

After the database is configured, apply the migrations:

    php artisan migrate

Please see the `app/Providers/AppServiceProvider.php` file for information on how to configure the application to store users in the database along with Auth0 authentication. Just running the configuration operations above does not enable this functionality. 

### Configuration

1. Rename the `.env.example` file to `.env` and add the required credentials from the settings page for the Application created previously.
    * **Domain** as `AUTH0_DOMAIN`
    * **Client ID** as `AUTH0_CLIENT_ID`
    * **Client Secret** as `AUTH0_CLIENT_SECRET`
1. Enter `php artisan key:generate` in the console to create an `APP_KEY` automatically in the `.env` file.
1. Go to your [Auth0 dashboard](https://manage.auth0.com) and add the following:
    * `http://localhost:3000/auth0/callback` to the **Allowed Callback URLs** field
    * `http://localhost:3000` to the **Allowed Web Origins** field
    * `http://localhost:3000` to the **Allowed Logout URLs** field
1. Serve the application one of the following ways:
    * Run `php artisan serve --port=3000`; open [http://localhost:3000](http://localhost:3000) in your browser
    * Point the Apache `DocumentRoot` to this project folder and start/restart Apache; ; open [http://localhost:8080](http://localhost:8080) (or whatever URL is configured) in your browser 
    * Use Docker by running `sh exec.sh` on a Mac/Linux machine or `.\exec.ps1` in Windows; open [http://localhost:3000](http://localhost:3000) in your browser

## Heroku

### Configure Your Heroku Account

In order to do this you need to have an Heroku account and the [Heroku toolbelt](https://toolbelt.heroku.com/) installed.

Create a Procfile for this project to indicate where the document root is located:

```bash
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
```

Create a git repo for this project in the same directory as `composer.json` and add all files:

```bash
git init
git add -A
git commit -m "First commit"
```

Login to Heroku:

```bash
heroku login
```

Next, we need to create an application from the local git repository. In your path to the repo execute

```bash
heroku create --buildpack https://github.com/heroku/heroku-buildpack-php
```

Create and push an APP_KEY:

```bash
composer install
touch .env # required for key:generate to run
php artisan key:generate
heroku config:set APP_KEY=GENERATED_APP_KEY # exclude surrounding square brackets
```

Add environment config entries for required Auth0 attributes from your Application settings page: 

```bash
heroku config:set AUTH0_DOMAIN=your-tenant.auth0.com
heroku config:set AUTH0_CLIENT_ID=YOUR_CLIENT_ID_HERE
heroku config:set AUTH0_CLIENT_SECRET=YOUR_CLIENT_SECRET_HERE
```

Now you have a remote called Heroku and you can upload to it by executing

```bash
git push heroku master
```

Finally, go to your [Auth0 dashboard](https://manage.auth0.com/#/clients) and add the following to the Application used above:
    * `https://HEROKU_APP_NAME.herokuapp.com/auth0/callback` to the **Allowed Callback URLs** field
    * `https://HEROKU_APP_NAME.herokuapp.com` to the **Allowed Web Origins** field
    * `https://HEROKU_APP_NAME.herokuapp.com` to the **Allowed Logout URLs** field

If there are any issues with the above, see Heroku's [Getting Started with Laravel](https://devcenter.heroku.com/articles/getting-started-with-laravel) guide for more information. We happily accept pull requests clarifying the steps above or adding new process steps! 

## Issue Reporting

If you have found a bug or if you have a feature request, please report them at this repository issues section. Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## Author

[Auth0](https://auth0.com)

## License

This project is licensed under the MIT license. See the [LICENSE](LICENSE) file for more info.
