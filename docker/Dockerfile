FROM markoshust/lumen-php-apache:7.2-0

RUN  a2enmod rewrite
RUN  a2ensite default-ssl
RUN  a2enmod ssl
RUN  docker-php-ext-install mysqli
RUN  docker-php-ext-install pdo_mysql

ADD . /var/www/html

RUN  apt-get update -yq \
    &&  apt-get install curl gnupg -yq \
    &&  curl -sL https://deb.nodesource.com/setup_8.x |  bash \
    &&  apt-get install nodejs wget -yq

RUN  wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub |  apt-key add - \
    &&  sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' \
    &&  apt-get update \
    &&  apt-get install -y google-chrome-unstable fonts-ipafont-gothic fonts-wqy-zenhei fonts-thai-tlwg fonts-kacst ttf-freefont \
      --no-install-recommends \
    &&  rm -rf /var/lib/apt/lists/*

RUN npm install codeceptjs
RUN cd /var/www/html/tests/frontend && npm install puppeteer
WORKDIR /var/www/html/tests/frontend
EXPOSE 80
EXPOSE 443

