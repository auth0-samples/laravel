#!/usr/bin/env bash

docker build -t auth0-laravel-01-login .

docker run \
  --name auth0-laravel-01-login \
  --rm \
  --env-file .env \
  -p 3000:3000 \
  -it \
  auth0-laravel-01-login;
