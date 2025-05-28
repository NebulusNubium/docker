# Précise quelle version de php utiliser
FROM php:8.2-apache

# Permet d'installer dépendances système
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Copie le fichier vhost.conf
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

# Active mod_rewrite pour Symfony
RUN a2enmod rewrite

# xdebug pour l'afffichage des erreurs
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug