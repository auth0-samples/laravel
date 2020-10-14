FROM php:7.3-cli-alpine
WORKDIR /home/app
ADD composer.json /home/app
RUN mkdir /home/app/database
RUN mkdir /home/app/database/seeds
RUN mkdir /home/app/database/factories
RUN mkdir /home/app/tests
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN php composer.phar --no-plugins --no-scripts install
ADD . /home/app
RUN php artisan key:generate
RUN php artisan config:cache
CMD php artisan serve --host=0.0.0.0 --port=3000
EXPOSE 3000
