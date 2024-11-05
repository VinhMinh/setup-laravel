FROM php:8.2

RUN docker-php-ext-install mysqli  && docker-php-ext-enable mysqli

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install xdebug && docker-php-ext-enable xdebug

# RUN apt-get update \
# 	cron \
#     && apt-get install -y zlib1g-dev \
#     && docker-php-ext-install zip

# Copy mã nguồn Laravel vào container
COPY . /app:/app

WORKDIR /app:/app

CMD cron && php-fpm