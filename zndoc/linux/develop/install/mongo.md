# Mongo DB

## Установка

    sudo apt install php7.2-dev
    sudo apt install mongodb-server
    sudo apt-get install php-mongodb

## Настрока

В конфиг `/etc/php/7.2/apache2/php.ini` добавляем:

    extension=mongodb.so
