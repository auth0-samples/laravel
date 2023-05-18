![Auth0 Laravek SDK](https://cdn.auth0.com/website/sdks/banners/laravel-auth0-banner.png)

This is a sample project demonstrating how to integrate [the Auth0 Laravel SDK](https://github.com/auth0/laravel-auth0) into a Laravel 9+ application.

For more information on how to integrate Auth0 into your Laravel application, please refer to the following documentation:

-  [Auth0 Laravel SDK Readme](https://github.com/auth0/laravel-auth0/blob/master/README.md)
-  [Auth0 Laravel SDK Session Authentication Quickstart](https://auth0.com/docs/quickstart/webapp/laravel)
-  [Auth0 Laravel SDK Token Authorization Quickstart](https://auth0.com/docs/quickstart/webapp/laravel)

## Getting Started

Clone this repository:

```bash
git clone https://github.com/auth0-samples/laravel auth0-laravel-quickstart
```

Install the dependencies:

```bash
composer install
```

Download the Auth0 CLI:

```bash
curl -sSfL https://raw.githubusercontent.com/auth0/auth0-cli/main/install.sh | sh -s -- -b .
```

Login to Auth0 with the CLI:

```bash
./auth0 login
```

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
