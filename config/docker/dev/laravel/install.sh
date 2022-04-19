#!/bin/sh

if [ ! -d "vendor" ] && [ -f "composer.json" ]; then
    echo ""
    echo "########################################"
    echo "# vendor directory not found...        #"
    echo "########################################"
    composer install \
    && php artisan key:generate
    
    if [ ! -f "database/database.sqlite" ]; then
        touch database/database.sqlite
    fi
    
    php artisan migrate --seed
fi

if [ ! -d "node_modules" ] && [ -f "package.json" ]; then
    echo ""
    echo "########################################"
    echo "# node_modules directory not found...  #"
    echo "########################################"
    npm install
    npm run dev
fi

exec "$@"
