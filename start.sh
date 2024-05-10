#!/bin/bash

# Build image and start containers
docker-compose up -d --build

# Install/update dependencies
docker-compose exec web composer update

# Wait for MySQL container to stabilize so we can migrate the tables
echo "Waiting for MySQL container to load completely..."
while ! docker-compose exec mysql mysqladmin ping -h mysql --silent; do sleep 5; done

# Database migrate
docker-compose exec web php artisan migrate

# Start the server
docker-compose exec web php artisan serve --host=0.0.0.0 --port=8000
