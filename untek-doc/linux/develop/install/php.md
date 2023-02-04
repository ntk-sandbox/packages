# PHP

## Установка

    sudo add-apt-repository -y ppa:ondrej/php
    sudo apt-get update
    sudo apt-get install php7.2 php7.2-cli php7.2-common

### Установка наиболее часто используемых расширений PHP

    sudo apt-get install php7.2-gmp php7.2-curl php7.2-zip php7.2-gd php7.2-json php7.2-mbstring php7.2-intl php7.2-mysql php7.2-sqlite3 php7.2-xml php7.2-zip php-imagick

### Проверка установки PHP

    php -v

## Настрока

В файле `/etc/php/7.2/apache2/php.ini` меняем:

    short_open_tag=On

## Разное

### Поиск и установка определенных расширений PHP 7.2

    sudo apt search php7.2

### Установить путь исполняемого файла для консольных команд

    sudo update-alternatives --set php /usr/bin/php7.2
