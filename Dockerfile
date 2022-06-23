FROM php8.0

RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl
RUN composer install

WORKDIR /app
COPY . /app

CMD php artisan serve --host=127.0.0.1 --port=8000
EXPOSE 8000
