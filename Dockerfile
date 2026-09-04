FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    chromium \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js 20
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www

# Copy package files first
COPY package*.json ./

# Install Node dependencies
RUN npm ci

# Copy Composer files
COPY composer.json composer.lock ./

# Install PHP dependencies without running Laravel scripts yet
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts

# Copy the remaining project files
COPY . .

# Remove development Laravel caches
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php

# Generate optimized autoload files
RUN composer dump-autoload --optimize --no-scripts

# Build frontend assets
RUN npm run build

# Set Laravel permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 10000

CMD ["/start.sh"]