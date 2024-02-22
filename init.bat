@echo off

cd "./webbrain-api"
start "" php artisan serve --port=8080

cd "../webbrain-web"
start npm start