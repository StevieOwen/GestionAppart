# ==========================================
# STAGE 1: Build Tailwind CSS / Frontend Assets
# ==========================================
FROM node:20-alpine AS frontend-builder
WORKDIR /app

# Copy frontend dependency files
COPY package.json package-lock.json vite.config.js ./
RUN npm ci

# Copy tailwind config and resource files
COPY resources/ ./resources/
COPY public/ ./public/
COPY tailwind.config.js* postcss.config.js* ./

# Compile assets (Vite / Tailwind)
RUN npm run build

# ==========================================
# STAGE 2: PHP 8.4 & Web Server Runtime
# ==========================================
FROM php:8.4-apache AS runtime

# Install system dependencies and required PHP extensions for Laravel, MySQL, & PostgreSQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql pgsql gd zip bcmath opcache \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Change Apache's Document Root to Laravel's /public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer globally
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy application source code
COPY . .

# Copy compiled Tailwind assets from Stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Install production PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Set correct permissions for Laravel storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 for Render
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]