# PHP Storm

## Установка через Snap

    sudo snap install phpstorm --channel=2019.3/stable --classic

## Установка из официального источника

    wget https://download.jetbrains.com/webide/PhpStorm-2019.3.4.tar.gz

После завершения загрузки распакуйте содержимое архива в папку /opt/:

    sudo tar xf ~/PhpStorm-2019.3.4.tar.gz -C /opt/

Осталось создать ссылку на исполняемый файл программы в каталоге /usr/local/bin/, чтобы она была доступна в системе:

    sudo ln -s /opt/PhpStorm-2019.3.4/bin/phpstorm.sh /usr/local/bin/phpstorm

Запуск:

    phpstorm
