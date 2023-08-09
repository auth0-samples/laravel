![Auth0 Laravel SDK](https://cdn.auth0.com/website/sdks/banners/laravel-auth0-banner.png)

:books: [Documentation](#documentation) — :rocket: [Getting Started](#getting-started) — :round_pushpin: [Routes](#demonstration-routes) — :wrench: [Default Changes](#changes-to-the-default-laravel-application)

This is a sample project demonstrating how to integrate [the Auth0 Laravel SDK](https://github.com/auth0/laravel-auth0) into a Laravel 9 application. For Laravel 10 applications, the integration steps are identical.

## Documentation

Guidance on integrating Auth0 into your Laravel application can be found here:

- [Auth0 Laravel SDK Readme](https://github.com/auth0/laravel-auth0/blob/master/README.md)
- [Auth0 Laravel SDK Session Authentication Quickstart](https://auth0.com/docs/quickstart/webapp/laravel)
- [Auth0 Laravel SDK Token Authorization Quickstart](https://auth0.com/docs/quickstart/backend/laravel)

You may also find the following documentation from the SDK's GitHub repository useful:

- [docs/Configuration](https://github.com/auth0/laravel-auth0/blob/master/docs/Configuration.md)
- [docs/Events](https://github.com/auth0/laravel-auth0/blob/master/docs/Events.md)
- [docs/Installation](https://github.com/auth0/laravel-auth0/blob/master/docs/Installation.md)
- [docs/Management](https://github.com/auth0/laravel-auth0/blob/master/docs/Management.md)
- [docs/Users](https://github.com/auth0/laravel-auth0/blob/master/docs/Users.md)

## Getting Started

Clone this repository:

```bash
git clone https://github.com/auth0-samples/laravel auth0-laravel-quickstart
```

Set the working directory to the sample project root:

```bash
cd auth0-laravel-quickstart/sample
```

Install the dependencies:

```bash
composer install --no-dev
```

Download the Auth0 CLI:

```bash
curl -sSfL https://raw.githubusercontent.com/auth0/auth0-cli/main/install.sh | sh -s -- -b .
```

Authenticate with Auth0 using the CLI:

```bash
./auth0 login
```

> **Note**  
> Authenticate as a "user" if prompted.

Create an Auth0 Application:

```bash
./auth0 apps create \
  --name "My Laravel Backend" \
  --type "regular" \
  --auth-method "post" \
  --callbacks "http://localhost:8000/callback" \
  --logout-urls "http://localhost:8000" \
  --reveal-secrets \
  --no-input \
  --json > .auth0.app.json
```

Create an Auth0 API:

```bash
./auth0 apis create \
  --name "My Laravel Backend API" \
  --identifier "https://github.com/auth0/laravel-auth0" \
  --offline-access \
  --no-input \
  --json > .auth0.api.json
```

Run the application:

```
php artisan serve
```

## Demonstration Routes

This sample includes a few demonstration routes to help you get started.

### Session-Based Authentication

The SDK automatically registers the following routes for session-based authentication:

| Method | Route                                        | Description                                                                                                |
| ------ | -------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| GET    | [/login](https://localhost:8000/login)       | Starts the user authentication flow. Sets up some initial cookies, and redirects to Auth0 to authenticate. |
| GET    | [/callback](https://localhost:8000/callback) | Handles the return callback from Auth0. Completes setting up the user's Laravel session.                   |
| GET    | [/logout](https://localhost:8000/logout)     | Logs the user out.                                                                                         |

The `routes/web.php` file contains routes that demonstrate working with session-based authentication. These are:

| Method | Route                                      | Description                                                     |
| ------ | ------------------------------------------ | --------------------------------------------------------------- |
| GET    | [/private](https://localhost:8000/private) | Demonstrates how to protect a route with the `auth` middleware. |
| GET    | [/scope](https://localhost:8000/scope)     | Demonstrates how to protect a route with the `can` middleware.  |
| GET    | [/colors](https://localhost:8000/colors)   | Demonstrates how to make Management API calls.                  |

### Token-Based Authorization

The `routes/api.php` file contains routes that demonstrate token-based authorization. These are:

| Method | Route                                              | Description                                                          |
| ------ | -------------------------------------------------- | -------------------------------------------------------------------- |
| GET    | [/api](https://localhost:8000/api)                 | Demonstrates how to extract information from the request token.      |
| GET    | [/api/private](https://localhost:8000/api/private) | Demonstrates how to protect an API route with the `auth` middleware. |
| GET    | [/api/scope](https://localhost:8000/api/scope)     | Demonstrates how to protect an API route with the `can` middleware.  |
| GET    | [/api/me](https://localhost:8000/api/me)           | Demonstrates how to make Management API calls.                       |

## Changes to the Default Laravel Application

This sample is based on [the default Laravel application](https://github.com/laravel/laravel) you can [create](https://laravel.com/docs/9.x/installation#your-first-laravel-project) using `laravel new` or `composer create-project`.

> **Note**  
> For Laravel 10, use `composer create-project laravel/laravel:^10.0` and follow the same steps outlined below.

Few changes are necessary to get started, as the SDK automatically sets up all the necessary guards, middleware and other services necessary to support authentication and authorization. The following is a list of changes that have been applied:

- The `auth0/login` package has been added to the `composer.json` file, using:

    ```bash
    composer require auth0/login:^7.8 --update-with-all-dependencies
    ```

- The `config/auth0.php` file was generated, using:

    ```bash
    php artisan vendor:publish --tag auth0
    ```

- The `routes/web.php` file was updated to include the demonstration routes.
- The `routes/api.php` file was updated to include the demonstration routes.

## Feedback

We appreciate your feedback! Please create an issue in this repository or reach out to us on [Community](https://community.auth0.com/).

## Vulnerability Reporting

Please do not report security vulnerabilities on the public GitHub issue tracker. The [Responsible Disclosure Program](https://auth0.com/whitehat) details the procedure for disclosing security issues.

## What is Auth0?

Auth0 helps you to easily:

- implement authentication with multiple identity providers, including social (e.g., Google, Facebook, Microsoft, LinkedIn, GitHub, Twitter, etc), or enterprise (e.g., Windows Azure AD, Google Apps, Active Directory, ADFS, SAML, etc.)
- log in users with username/password databases, passwordless, or multi-factor authentication
- link multiple user accounts together
- generate signed JSON Web Tokens to authorize your API calls and flow the user identity securely
- access demographics and analytics detailing how, when, and where users are logging in
- enrich user profiles from other data sources using customizable JavaScript rules

[Why Auth0?](https://auth0.com/why-auth0)

## License

This project is licensed under the MIT license. See the [LICENSE](./LICENSE) file for more info.
