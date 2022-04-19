#!/bin/sh

if [ ! -d "vendor" ] && [ -f "composer.json" ]; then
    echo ""
    echo "########################################"
    echo "# vendor directory not found...        #"
    echo "########################################"
    composer install
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
