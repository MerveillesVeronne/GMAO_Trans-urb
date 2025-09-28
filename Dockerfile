# Dockerfile pour GMAO Trans'urb
FROM php:8.2-fpm-alpine

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances système et PHP
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    mysql-client \
    sqlite \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        zip \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        pdo_sqlite \
        intl \
        mbstring \
        opcache

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers de configuration et scripts
COPY docker/ /tmp/docker-config/
RUN if [ -f /tmp/docker-config/nginx/default.conf ]; then cp /tmp/docker-config/nginx/default.conf /etc/nginx/http.d/default.conf; fi && \
    if [ -f /tmp/docker-config/nginx/nginx.conf ]; then cp /tmp/docker-config/nginx/nginx.conf /etc/nginx/nginx.conf; fi && \
    if [ -f /tmp/docker-config/php/php.ini ]; then cp /tmp/docker-config/php/php.ini /usr/local/etc/php/conf.d/99-app.ini; fi && \
    if [ -f /tmp/docker-config/php/opcache.ini ]; then cp /tmp/docker-config/php/opcache.ini /usr/local/etc/php/conf.d/10-opcache.ini; fi && \
    if [ -f /tmp/docker-config/supervisor/supervisord.conf ]; then cp /tmp/docker-config/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf; fi && \
    if [ -f /tmp/docker-config/scripts/entrypoint.sh ]; then cp /tmp/docker-config/scripts/entrypoint.sh /usr/local/bin/entrypoint.sh && chmod +x /usr/local/bin/entrypoint.sh; fi && \
    rm -rf /tmp/docker-config

# Créer l'utilisateur www-data avec les bonnes permissions
RUN addgroup -g 1000 www && \
    adduser -u 1000 -G www -s /bin/sh -D www

# Copier les fichiers de l'application
COPY --chown=www:www . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Installer les dépendances Node.js et construire les assets
RUN npm ci && npm run build && npm prune --production

# Créer les répertoires nécessaires et définir les permissions
RUN mkdir -p storage/app/public \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
    && chown -R www:www storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Le script d'entrée a déjà été copié plus haut

# Exposer le port
EXPOSE 80

# Définir l'utilisateur
USER www

# Point d'entrée
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
