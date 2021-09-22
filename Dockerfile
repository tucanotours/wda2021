FROM ubuntu

RUN apt update
RUN DEBIAN_FRONTEND="noninteractive" apt-get -y install tzdata git nginx php-fpm php-cli php-zip wget unzip php-curl php-json php-mysql rsync

COPY docker/bin/start.sh /start.sh
COPY docker/conf/default /etc/nginx/sites-available/

RUN mkdir -p /run/php-fpm/

CMD sh /start.sh