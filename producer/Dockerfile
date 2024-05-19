# Use official PHP 8.2 image
FROM php:8.2-fpm-alpine

# Install common PHP extension dependencies and development tools
RUN apk --no-cache add \
    build-base \
    autoconf \
    freetype-dev \
    jpeg-dev \
    libpng-dev \
    zip \
    git \
    curl \
    oniguruma-dev \
    librdkafka-dev \
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip exif pcntl gd

# Install PECL extensions
RUN pecl install rdkafka \
    && docker-php-ext-enable rdkafka

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/producer

# Copy only necessary files for composer installation
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy the rest of the application
COPY . .

# Set permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/producer/storage /var/www/producer/bootstrap/cache \
    && chmod -R 775 /var/www/producer/storage \
    && chmod -R 775 /var/www/producer/bootstrap/cache

# Expose the necessary port (default php-fpm port)
EXPOSE 9000

# Set the default command to run php-fpm
CMD ["php-fpm"]