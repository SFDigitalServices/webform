#!/bin/bash

sudo mkdir -p public/assets/sass/sf-design-system/design-tokens public/assets/sass/sf-design-system/layout/ public/assets/sass/sf-design-system/forms/
sudo cp node_modules/sf-design-system/src/components/00-design-tokens/*.scss public/assets/sass/sf-design-system/design-tokens
sudo cp node_modules/sf-design-system/src/components/03-layout/**/*.scss public/assets/sass/sf-design-system/layout/
sudo cp node_modules/sf-design-system/src/components/04-forms/**/*.scss public/assets/sass/sf-design-system/forms/