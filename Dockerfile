FROM php:7.3-apache
#Install git zip unzip
RUN apt-get update && apt-get install -y git zip unzip
#enable apache rewrite 
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
WORKDIR /tmp/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

COPY . /var/www/html/
COPY --from=vendor /tmp/vendor/ /var/www/html/vendor/

WORKDIR /var/www/html/
EXPOSE 80
