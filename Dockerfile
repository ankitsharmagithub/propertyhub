# Vercel Serverless PHP Runtime
FROM php:8.2-cli

# Working directory
WORKDIR /var/www/html

# System dependencies install karo
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# PHP extensions install karo
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer install karo
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Project files copy karo
COPY . .

# Composer dependencies install karo (production)
RUN composer install --no-dev --optimize-autoloader

# Vite build karo
RUN npm install && npm run build

# Laravel cache banao
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Port expose karo
EXPOSE 8080

# PHP server start karo
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public"]
