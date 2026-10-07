#!/bin/sh

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automatically safely in production
php artisan migrate --force

# Execute the main container command (Apache)
exec "$@"