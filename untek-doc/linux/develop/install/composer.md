# Composer

## Установка

    sudo apt update

Download Installer

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

Verify Download

    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

Run Composer Installer

    php composer-setup.php

Remove the Composer Installer

    php -r "unlink('composer-setup.php');"

Move Composer to /usr/bin/composer

    sudo mv ~/composer.phar /usr/bin/composer
