FROM markoshust/lumen-php-apache:7.2-0

RUN a2enmod rewrite
RUN a2ensite default-ssl
RUN a2enmod ssl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql

ADD . /var/www/html

EXPOSE 80
EXPOSE 443

