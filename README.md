# Users management
Users management via API use JWT

## Build RESTFUL API with Laravel PHP Framework
  This nature is use token to authentication user actions, I know that.
  So I use a framework for this task beacause Laravel FW is best for php:
      - Build API
      - Security
      - Test
      - Documents


## Installation
Env: 
Required: `PHP 7.0.x` or higher
MySQL: `5.6`

Steps:
1. Clone the repository

        git clone git@github.com:doanhkaka/user-management.git
    
2. Switch to the repo folder
   
       cd user-management
   
3. Install all the dependencies using composer
   
       composer install

4. Copy the example env file and make the required configuration changes in the .env file
   
       cp .env.example .env

  Please edit database name, database username, and database password if needed.

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=db_name
        DB_USERNAME=root
        DB_PASSWORD=xxx

5. Run the database migrations (**Set the database connection in .env before migrating**)

        php artisan migrate

6. Run the database seeder and you're done
   
        php artisan db:seed
  
  - This command will create new user with email random and password = `12345678`. 
  - Please check database to get email for `login`.
  - Or use demo account: `example@email.com` and `12345678`.
  - You can use my database: [user_api.sql](https://github.com/doanhkaka/user-management/blob/master/user_api.sql)
  
7. Start the local development server

        php artisan serve

  Laravel development server will start: <http://127.0.0.1:8000>

### API

  http://127.0.0.1:8000/api/v1

You can test the API using [Postman](https://www.getpostman.com/).

| HTTP Method | Path              | Action    | Fields            | Headers|
| -----         | -----             | -----     | -------------     |---------|
| POST           | /login        | login    | email, password|-|
| GET           | /me        | info     |           -       |  token_access |
| PUT           | /me        | update    |  name, age, address, tel|token_access|
| GET           | /logout   | logout      |         -          | token_access|


### Testing
1. Postman
We can use this backup from my Postman:
 [Postman Test](https://github.com/doanhkaka/user-management/blob/master/User-management.postman_collection.json)
2. Unit test
- Create a database for testing, update db name in phpunit.xml

        <env name="DB_DATABASE" value="user_api"/>

- Run this command to test and see the results

      vendor/bin/phpunit
    
Thanks for watching !