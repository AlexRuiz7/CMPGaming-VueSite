FROM node:12-buster

RUN apt-get update && apt-get install -y php php-bz2 php-xml zip unzip && mkdir /app
ADD . /app
RUN /app/setup_php.sh
RUN cd /app && npm install && npm run build
WORKDIR /app
ENTRYPOINT ["npm", "run",  "start"]