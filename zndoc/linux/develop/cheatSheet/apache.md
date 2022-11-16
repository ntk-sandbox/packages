# Apache

## Добавить хост

создать конфиг

    sudo nano /etc/apache2/sites-available/project.dev

добавить в него код

    <VirtualHost *:80>
    ServerName project.dev
    DocumentRoot /var/www/test/dev/project
    </VirtualHost>

включить хост

    sudo a2ensite project.dev

добавить домен в `sudo nano /etc/hosts`:

    127.0.0.1 project.dev

перезапустить сервер

    sudo systemctl restart apache2
