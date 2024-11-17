# Используем базовый образ PHP 8.2 с FPM на Alpine
FROM php:8.2-fpm-alpine

# Установка системных зависимостей
RUN apk add --no-cache \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем рабочую директорию
WORKDIR /var/php/laravel_project_table

# Копирование файлов проекта
COPY . .

# Установка зависимостей проекта с помощью Composer
RUN composer install --optimize-autoloader --no-dev

# Установка прав доступа к директории storage и bootstrap/cache для работы с ними
RUN chown -R www-data:www-data storage bootstrap/cache

# Запуск PHP-FPM
CMD ["php-fpm"]
