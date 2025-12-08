FROM php:8.3-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Copy production env file if exists, otherwise use example
RUN if [ -f .env.production ]; then cp .env.production .env; else cp .env.example .env; fi

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key if not set
RUN php artisan key:generate --force

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start Laravel server
CMD php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
