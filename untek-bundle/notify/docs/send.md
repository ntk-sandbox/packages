# Отправка уведомлений

## Отправка письма

```php
/** @var \ZnBundle\Notify\Domain\Interfaces\Services\EmailServiceInterface $emailService */

$email = new EmailEntity;
$email->setFrom('from@mail.ru');
$email->setTo('example@yandex.ru');
$email->setSubject('Subject text');
$email->setBody('Body text');
$emailService->push($email);
```

## Отправка SMS-сообщения

```php
/** @var \ZnBundle\Notify\Domain\Interfaces\Services\SmsServiceInterface $smsService */

$sms = new SmsEntity;
$sms->setPhone('77051112233');
$sms->setMessage('text of message');
$smsService->push($sms);
```

Заметьте, что для SMS и Email сообщения не отправляется сразу,
а добавляется в очередь задач.

Подробнее об очередях [тут](https://github.com/php7bundle/queue/blob/master/docs/README.md).
