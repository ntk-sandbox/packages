# Redis

## Установка

    sudo apt install redis-server
    sudo systemctl start redis-server
    sudo apt install php-redis

# Добавить в автозагрузку

    sudo systemctl enable redis-server

## Настрока

Redis запустится и будет нормально работать с конфигурацией 
по умолчанию, но рекомендуется установить объем памяти, 
доступной для программы. 
Для этого откройте файл `/etc/redis/redis.conf` 
и добавьте туда такие строки:

    maxmemory 512mb
    maxmemory-policy allkeys_lfu

## Ссылки

https://losst.ru/ustanovka-redis-v-ubuntu-18-04
