#!/usr/bin/env bash
docker build -t auth0-laravel-web-app .
docker run --env-file .env -p 8000:8000 -it auth0-laravel-web-app
