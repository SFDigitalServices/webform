#!/bin/bash

if [ -z "${CIRCLE_PULL_REQUEST##*/}" ]
then
      MY_SCRIPT_VARIABLE="https://formbuilder-sf-staging.herokuapp.com/"
else
      MY_SCRIPT_VARIABLE="https://formbuilder-sf-staging-pr-${CIRCLE_PULL_REQUEST##*/}.herokuapp.com/"
fi

COMMAND="npx codeceptjs run --override '{ \"helpers\": {\"Puppeteer\": {\"url\": \"'$MY_SCRIPT_VARIABLE'\"}}}'"

eval "$COMMAND"