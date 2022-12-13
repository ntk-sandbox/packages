# Postgres SQL

## Установка

    sudo apt install php7.2-pgsql
    sudo sh -c 'echo "deb http://apt.postgresql.org/pub/repos/apt/ `lsb_release -cs`-pgdg main" >> /etc/apt/sources.list.d/pgdg.list'
    wget -q https://www.postgresql.org/media/keys/ACCC4CF8.asc -O - | sudo apt-key add -
    sudo apt-get update
    sudo apt-get install postgresql postgresql-contrib

## Настрока

    sudo -u postgres psql
    \password postgres
    \q

Редактируем конфиг `/etc/postgresql/14/main/pg_hba.conf` меняем `peer` на `md5`:

    local   all             all                                     peer

to:

    local   all             all                                     md5

Рестарт:

    sudo service postgresql restart

## Ссылки

* https://losst.ru/ustanovka-postgresql-ubuntu-16-04
* https://stackoverflow.com/questions/12720967/how-to-change-postgresql-user-password
