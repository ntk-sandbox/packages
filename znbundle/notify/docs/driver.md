# Драйвера шлюзов

## Введение

У каждого типа уведомлений есть несколько драйверов,
их как минимум 2:

* Боевой драйвер
* Драйвер для разработки

## Драйвер для разработки

Драйвера `dev` используются для разработки.

Отправленные сообщения хранятся в папке `var/data/notify`.

## Боевой драйвер

Боевой драйвер выполняет реальную отправку.

## Конфигурация

Конфигурация драйвера делается в файле `config/services.yaml`:

```yaml
services:
    ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface:
        class: ZnBundle\Notify\Domain\Repositories\Dev\EmailRepository
        public: true
```

Тут мы указываем драйвер для отправки почты.
