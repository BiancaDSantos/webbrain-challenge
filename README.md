<h1 align="center"> Web Brain Tecnlogia - Formulário de contato </h1>

<p align="center">
  <a href="#-stack">Stack</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-How to test">How to test</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
</p>

## Stack

<h3>Back-end</h3> 

- PHP with Laravel framework
- Rest architectural style 
- Artisan command line

<h3>Front-end</h3> 

- javascript with React library
- axios for API calls
- bootstrap and react-bootstrap for UI
- react-router-dom for routing between pages
- validations in pure javascript

<h3>Database</h3>

- MySQl


## How to test 

- Install MySQL [Download](https://dev.mysql.com/downloads/mysql/)
- Install Node and NPM [Download](https://nodejs.org/en)
- Install PHP [Download](https://www.php.net/downloads.php)
- Configure the database conection in the [.env](./webbrain-api/.env) back-end file
- - The database schema will be automatically created when the back-end start
- Initializing
- - Windowns
- - - Execute the [configure.bat](./configure.bat) file 
- - - Then execute then [init.bat](./init.bat) file 
- - Others OS
- - - Run the following commands in the terminal
- - - - cd ./webbrain-api
- - - - php artisan migrate --force
- - - - php artisan serve --port=8080
- - - - cd ../webbrain-web
- - - - npm install
- - - - npm start