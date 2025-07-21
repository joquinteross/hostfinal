FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crear carpeta de trabajo
WORKDIR /app

# Copiar todo el proyecto Laravel
COPY . .

# Instalar dependencias de Laravel
RUN composer install

# Generar la clave de la app
#RUN php artisan key:generate

# Puerto por defecto
EXPOSE 8000

# Comando para iniciar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
