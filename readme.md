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
4. You may now access your site at `https://webform.test` (or whatever domain you setup), with the email johndoe@example.com and password johndoe

## Deplopyment to Heroku

A pipeline has been setup for this project on Heroku that connects to the github repo. Every push to the branch you specify here will deploy a new version of this app. 

## License

[MIT license](http://opensource.org/licenses/MIT)

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```
