# Web Form Builder 

This is the source for the web form builder, cloned from https://github.com/krisanalfa/lumen-jwt as a starting point.

## Setup

### If you want to use Docker for development
You need [Docker](https://github.com/docker/docker) and [docker-compose](https://github.com/docker/compose).

    1.) Follow the instruction on https://github.com/markoshust/docker-lumen to setup a docker-lumen project.

    2.) Update docker-compose.yml to identify the mount point for the web server container's document root, this is under the "Volumn" config.
	```
        mkdir src && cd src
        git clone git@github.com:SFDigitalServices/webform.git
        ```

## Deplopyment to Heroku

A pipeline has been setup for this project on Heroku that connects to the github repo. Every push to the branch you specify here will deploy a new version of this app. 

## License

[MIT license](http://opensource.org/licenses/MIT)

```
Laravel and Lumen is a trademark of Taylor Otwell
Sean Tymon officially holds "Laravel JWT" license
```
