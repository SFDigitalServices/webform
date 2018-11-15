# Web Form Builder 

This is the source for the web form builder, cloned from https://github.com/krisanalfa/lumen-jwt as a starting point. Decided to not implement jwt at this point.

## Setup

### If you want to use Docker for development
You need [Docker](https://github.com/docker/docker) and [docker-compose](https://github.com/docker/compose).

    1.) Follow the instruction on https://github.com/markoshust/docker-lumen to setup a docker-lumen project.
       
    2.) Update docker-compose.yml to identify the mount point for the web server container's document root, this is under the "Volumn" config.
	```
        mkdir src && cd src
        git clone git@github.com:SFDigitalServices/webform.git
        ```
    3.) Copy the Dockerfile from docker/ folder to the root folder of your docker-lumen project, this file installs additional apache-php extensions that are required.

### Initialize the database resources
    You will need to ssh into the apache-php container
    
    ```
    docker exec -ti [container id] bash
    ```
    and run the command in the document root folder, usually /var/www/html
    ```
    $ php artisan make:migration create_users_table
    ```

    A migration file will be generated under “database/migrations”. If there's already a migration file generated from check-ins, you may see a warning, in this case, proceed to the next command:
    
    ```
    $ php artisan migrate
     ```
    This will execute the commands in the create_users_table migration file.

    To populate the tables with data, take a look at the database\seeds\UserTableSeeder.php file. Execute the following command will insert data into the tables.
    ```
    $ php artisan db:seed
     ```


## Deplopyment to Heroku

A pipeline has been setup for this project on Heroku that connects to the github repo. Every push to the branch you specify here will deploy a new version of this app. 

## License

[MIT license](http://opensource.org/licenses/MIT)

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```
