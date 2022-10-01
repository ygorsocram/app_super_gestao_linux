FROM php:8.1-fpm-alpine

# Install dependencies
RUN apk update && apk add --no-cache \
    gettext-dev \
    jpegoptim optipng pngquant gifsicle \
    nano \
    bash \
    libxml2-dev \
    libzip-dev \
    zip \
    bzip2-dev \
    libxslt-dev \
    curl

#################################################################
RUN apk add --no-cache freetype autoconf libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
  NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
  docker-php-ext-install -j$(nproc) gd
#################################################################


#################################################################
# imagick
#RUN apk add --update --no-cache autoconf g++ imagemagick imagemagick-dev libtool make pcre-dev \
#    && pecl install imagick \
#    && docker-php-ext-enable imagick \
#    && apk del autoconf g++ libtool make pcre-dev
#################################################################


#################################################################
# Install PHP extensions
RUN docker-php-ext-install pdo mysqli pdo_mysql exif pcntl sockets soap bcmath zip
RUN docker-php-ext-install bz2 calendar gettext xsl
RUN docker-php-ext-enable pdo_mysql
#################################################################


#################################################################
# delete non needed apks
RUN apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev autoconf
#################################################################


#################################################################
# Copy and give permission to the Docker Entrypoint
COPY ./docker/php/fpm-entrypoint.sh /home/fpm-entrypoint.sh
RUN chmod +x /home/fpm-entrypoint.sh
#################################################################


#################################################################
# php.ini - Production OR Development
COPY ./docker/php/conf.d/php-production.ini /home/php-ini/php-production.ini
COPY ./docker/php/conf.d/php-development.ini /home/php-ini/php-development.ini
#################################################################


#################################################################
# XDEBUG - Enable / Disable
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install xdebug-3.1.5 \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

COPY ./docker/php/xdebug/xdebug.on.unix.ini /home/xdebug/xdebug.on.unix.ini
COPY ./docker/php/xdebug/xdebug.on.windows.ini /home/xdebug/xdebug.on.windows.ini
COPY ./docker/php/xdebug/xdebug.off.ini /home/xdebug/xdebug.off.ini
#################################################################


#################################################################
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#################################################################


#################################################################
# Create a group and user
RUN addgroup -g 1000 -S www && adduser -S www -G www -u 1000
#################################################################


# Expose port 9000 and start php-fpm server
EXPOSE 9000

#CMD ["php-fpm"]
ENTRYPOINT ["/home/fpm-entrypoint.sh"]