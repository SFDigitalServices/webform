# Web Form Builder

This is the source for the web form builder, cloned from https://github.com/krisanalfa/lumen-jwt as a starting point. Decided to not implement jwt at this point.

## Setup

### If you want to use Docker for development
### Prerequisites
You need [Docker](https://www.docker.com/get-started), [docker-compose](https://docs.docker.com/compose/), [Composer](https://getcomposer.org/doc/00-intro.md).

### Setup steps
1. Setup a new project sekeleton from this repository
```
        git clone git@github.com:SFDigitalServices/webform.git webform
        cd webform
        cp .env.example .env
        composer install
```

2. Setup your ip loopback for proper IP resolution with Docker: ./bin/initloopback
```
        cd docker
        ./bin/initloopback

```

3. Start your Docker containers with:
```
        docker-compose up -d
```

*** Docker on Windows alert: you may have to specify the Dockerfile in docker-compose.yml file.
```
        apache_php:
            build:
                context: ./path/to/Dockerfile
                dockerfile: Dockerfile
```

4. Run `scripts/copy_sf_design_system.sh` to copy pattern library stylesheets. (You will need to run this manually whenever a pattern library update is released.)

5. Run `npm run watch`

6. You may now access your site at `https://webform.test` (or whatever domain you setup), with the email johndoe@example.com and password johndoe

### Unit Testing
1. Navigate to the src/docker directory and spin up docker as normal
```
        docker-compose up -d
```
2. List your docker containers and get the id of your db
```
        docker ps
```
3. Inspect your database container and write down the db's IPAddress
```
        docker inspect docker_db_1
```
4. Navigate to the src directory and edit codeception.yml
```
		modules:
			enabled:
				- Db:
					dsn: 'mysql:host=put ip address from earlier here;dbname=webform'
					user: 'root'
					password: 'yourpassword'
```
5. Run bash from your php docker container
```
        docker exec -it docker_apache_php_1 /bin/bash
```
6. From /var/www/html execute unit tests
```
		vendor/bin/codecept run unit
```


## Deployment to Heroku

A pipeline has been setup for this project on Heroku that connects to the github repo. Every push to the branch you specify here will deploy a new version of this app.

## License

[MIT license](http://opensource.org/licenses/MIT)

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```