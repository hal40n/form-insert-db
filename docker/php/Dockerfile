FROM php:8.2-fpm
EXPOSE 5173

RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libfontconfig1 \
    libxrender1 \
    libzip-dev

RUN apt-get update && apt-get install -y gnupg \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 \
    && apt-get install -y unixodbc-dev \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install pdo_mysql mysqli exif \
    && docker-php-ext-install zip

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php \
    && ln -s /usr/bin/composer.phar /usr/bin/composer

    ENV NODE_VERSION=16.16.0
    RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh | bash
    ENV NVM_DIR=/root/.nvm
    RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
    RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
    RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
    ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
    RUN node --version
    RUN npm --version

COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /src
ADD . /src/storage
RUN chown -R www-data:www-data /src/storage

ENTRYPOINT [ "bash", "-c", "composer install; npm install; exec php-fpm" ]
