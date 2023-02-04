# Генерация SSH-ключа для GIT

Генерация ключа

    ssh-keygen -t rsa -b 2048 -C "my@example.com"

Вводим путь к ключу:

    ~/.ssh/my-gitlab

Открыть публичный ключ

    nano ~/.ssh/my-gitlab.pub

Добавить назначение ключа хосту.
Открываем файл `/home/vitaliy/.ssh/config` и добавляем код:

    Host github.com
     IdentityFile /home/vitaliy/.ssh/my-github
    Host gitlab.com
     IdentityFile /home/vitaliy/.ssh/my-gitlab

Запустить агент:

    eval $(ssh-agent)

Добавить ключ

    ssh-add ~/.ssh/my-gitlab

## Разное

Список ключей

    ssh-add -l
