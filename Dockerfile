FROM ubuntu:16.04

RUN apt-get install curl mysql-server php php-mysql php-mcrypt
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

ADD . /wingify
WORKDIR /wingify

RUN mysql -uroot < sql/dump.sql
RUN composer dump-autoload

CMD ["php -S localhost:8000 index.php"]
