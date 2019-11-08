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
        cd webform/src
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

4. To compile Sass stylesheets, run `npm run watch`

5. You may now access your site at `https://webform.test` (or whatever domain you setup), with the email johndoe@example.com and password johndoe

### JS Unit Testing
1. Make sure docker is running as normal
2. Navigate to src/tests/jasmine
3. Open SpecRunner.html file in your browser

### PHP Unit Testing
1. Make sure docker is running as normal
2. List your docker containers and get the id of your db
```
        docker ps
```
3. Inspect your database container and write down the db's IPAddress
```
        docker inspect docker_db_container_id
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

### End to End Testing
1. Make sure docker is running as normal
2. Navigate to src/tests/frontend
3. Make sure codecept.conf.js puppeteer is pointed to your local environment
```
      Puppeteer: {
        url: process.env.CODECEPT_URL || 'http://your_local_environment',
```
4. Execute codeceptjs tests with npx (can append --steps flag to get more detailed information)
```
        npx codeceptjs run
```

## Deployment to Heroku

A pipeline has been setup for this project on Heroku that connects to the github repo. Every push to the branch you specify here will deploy a new version of this app.

## License

[MIT license](http://opensource.org/licenses/MIT)

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```
