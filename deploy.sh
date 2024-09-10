#!/bin/bash

# chmod +x deploy.sh
# sudo systemctl stop apache2

# I assume that docker is installed
docker-compose up -d --build

# Function to wait for PostgreSQL to be ready
echo "Waiting for PostgreSQL in container yii_postgres to be ready..."

until docker exec -it yii_postgres pg_isready; do
    sleep 2
    echo "Waiting for PostgreSQL to accept connections..."
done

echo "PostgreSQL is ready."

# Run migrations
docker exec -it yii_php php yii-project/yii migrate --interactive=0