FROM ubuntu:16.04 as builder

RUN apt-get update 
RUN apt-get install git --assume-yes
RUN git clone https://github.com/deselbi/Icy-Whisper /icy-whisper
RUN cd /icy-whisper && cp .env.example .env && sed -i 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' .env && chmod 777 -R storage && chmod 777 -R bootstrap/cache


FROM ubuntu:16.04 as phpbuilder

RUN apt-get update
RUN apt-get install -y python-software-properties software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN apt-get update
# install php  with laravel dependencies
RUN apt-get --assume-yes install php7.1 php7.1-cli php7.1-common php7.1-pdo php7.1-gd \
    php7.1-mbstring php7.1-xml php7.1-mysql php7.1-fpm php7.1-dev php7.1-zip
COPY --from=builder /icy-whisper /icy-whisper
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
RUN cd /icy-whisper && /usr/bin/composer install && php artisan key:generate


FROM busybox
COPY --from=phpbuilder /icy-whisper /icy-whisper
VOLUME /home/ivan/project /icy-whisper
