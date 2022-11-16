# Исправление локали

    sudo nano /etc/default/locale

меняем:

    LANG="ru_RU.UTF-8"
    LANGUAGE=en_US.UTF-8
    LC_ALL=en_US.UTF-8
    LC_TYPE=en_US.UTF-8

выполняем команды:

    sudo locale-gen "ru_RU.UTF-8"
    sudo dpkg-reconfigure locales
