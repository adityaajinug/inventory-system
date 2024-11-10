# Gunakan base image PHP 8.2 dengan ekstensi-fpm untuk Laravel
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh aplikasi Laravel (jika sudah ada) atau siapkan untuk pengembangan
COPY --chown=www-data:www-data ./src /var/www

# Permissions untuk storage dan cache Laravel
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/storage \
    && chmod -R 755 /var/www/bootstrap/cache

# Jalankan perintah php artisan serve ketika container dijalankan
CMD php artisan serve --host=0.0.0.0 --port=8000

# Buka port 8000
EXPOSE 8000
