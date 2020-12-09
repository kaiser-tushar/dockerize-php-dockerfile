FROM php:7.3-apache
#Install git zip unzip
RUN apt-get update && apt-get install -y git zip unzip
#enable apache rewrite 
RUN a2enmod rewrite
#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=. --filename=composer
RUN mv composer /usr/local/bin/
#Map source code for Apache
COPY . /var/www/html/
WORKDIR /var/www/html/
#install dependencies
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist
EXPOSE 80
