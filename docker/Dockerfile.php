FROM ubuntu:16.04

RUN apt-get update
RUN apt-get install -y python-software-properties software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update
ENV PHP_VERSION 7.1
# install php  with laravel dependencies
RUN apt-get --assume-yes install php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-common php${PHP_VERSION}-pdo php${PHP_VERSION}-gd \
    php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-mysql php${PHP_VERSION}-fpm php${PHP_VERSION}-dev php${PHP_VERSION}-zip
# make php-fpm executable without version
RUN ln -fs /usr/sbin/php-fpm${PHP_VERSION} /usr/sbin/php-fpm
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
RUN mkdir /run/php
COPY php-fpm.d /etc/php/${PHP_VERSION}/fpm/pool.d

EXPOSE 9000
CMD ["/usr/sbin/php-fpm", "-F"]
