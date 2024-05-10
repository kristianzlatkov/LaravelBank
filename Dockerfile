FROM ubuntu:latest

# Update package lists
RUN apt-get update

# Install PHP and other required dependencies
RUN apt-get install -y \
    php \
    php-mysql \
    php-mysqli \
    php-cli \
    php-curl \
    php-json \
    php-mbstring \
    php-xml \
    git \
    unzip

# Install Composer
RUN apt-get install -y curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Expose port 80 for web server
EXPOSE 80

# Command to run the PHP development server with custom host and port
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
