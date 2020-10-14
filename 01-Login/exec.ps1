docker build -t auth0-laravel-01-login .

docker run --env-file .env -p 3000:3000 -it auth0-laravel-01-login
