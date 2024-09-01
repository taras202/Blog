# Вибір базового образу PHP
FROM php:8.1-fpm

# Використовуємо root для встановлення системних пакетів
USER root

# Оновлення пакетів та встановлення бібліотек
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libicu-dev \
    && apt-get clean

# Налаштування та встановлення розширення gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Встановлення інших PHP-розширень
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Перехід назад до користувача www-data
USER www-data

# Копіювання додаткових файлів проекту (якщо є)
COPY . /var/www

# Встановлення робочої директорії
WORKDIR /var/www

# Виставлення команд для запуску
CMD ["php-fpm"]
