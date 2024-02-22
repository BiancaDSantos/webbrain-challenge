@echo off

cd "./webbrain-api"
start "" php artisan migrate --force

cd "../webbrain-web"
start npm install