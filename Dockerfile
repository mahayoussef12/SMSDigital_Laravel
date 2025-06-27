FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Set permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

EXPOSE 9000
CMD ["php-fpm"]
