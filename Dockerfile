FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Crear carpeta de trabajo
WORKDIR /app

# Copiar el código del proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install

# Instalar dependencias de Node (Vite)
RUN npm install

# Ejecutar build de Vite
RUN npm run build

# Generar la clave de la app
RUN php artisan key:generate

# Exponer el puerto
EXPOSE 8000

# Iniciar servidor Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
