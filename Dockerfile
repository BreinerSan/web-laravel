FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    && rm -rf /var/cache/apk/*

# Instalar pnpm globalmente
RUN npm install -g pnpm

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear usuario no-root para seguridad
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

# Crear directorio de trabajo
WORKDIR /var/www/html
# Crear directorios necesarios con permisos correctos ANTES de cambiar de usuario
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache \
    && chown -R www:www /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Cambiar a usuario no-root
USER www

# Exponer puerto para desarrollo
EXPOSE 80