### How do I run the project? ###
* cd into directory and run composer install to install packages
* run php artisan db:migrate
* run php artisan db:seed
* run local web server by running php artisan serve --port=8000


### API Endpoints
#### http://localhost:8000/api/balance/           [GET]
#### http://localhost:8000/api/deposit/           [POST]
#### http://localhost:8000/api/withdraw/          [POST]

### Executing API calls using Curl

* curl http://localhost:800/balance/ 
* curl -H "Content-Type: application/json" -X POST -d '{"account": 12345678, "amount": amount}' http://localhost:8000/deposit/
* curl -H "Content-Type: application/json" -X POST -d '{"account": 12345678, "amount": amount}' http://localhost:8000/withdraw/
* replace amount with your figure



* curl -H "Content-Type: application/json" -X POST http://localhost:8585/deposit/ -d "{\"amount\":400}"

### How to run the tests
* Execute phpunit on the root folder
* Install phpunit using composer if you don't have it already
composer global require phpunit/phpunit
composer global require phpunit/dbunit

