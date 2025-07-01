# Étape 1 : Image de base avec PHP 8.2 (recommandé pour Laravel 12)
FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP requises
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip unzip curl git vim \
    libonig-dev libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring bcmath gd

# Installer Composer depuis image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www

# Copier les fichiers du projet Laravel
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donner les permissions nécessaires à Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# Exposer le port PHP-FPM
EXPOSE 9000

# Lancer PHP-FPM au démarrage
CMD ["php-fpm"]
