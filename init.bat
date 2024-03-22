@echo off

cd "./webbrain-api"
start php -S localhost:8080

cd "../webbrain-web"
start npm start