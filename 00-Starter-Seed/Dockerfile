FROM php:7.2-rc-alpine

WORKDIR /home/app

ADD . /home/app

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN php composer.phar --no-plugins --no-scripts install

# Migrate the database
RUN php artisan migrate

CMD php artisan serve --host=0.0.0.0

EXPOSE 8000
