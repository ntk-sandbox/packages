# RPC

## Подпись и верификация запроса/ответа

Шаги верификации:

* проверка сертификата на отозванность (не сделано)
* верификация сертификата с УЦ (проверка подписи сертификата корневым сертификатом)
* проверка дата истечения срока действия сертификата
* канонизация JSON (внедрить метод канонизации в meta "c14nMethod")
* вычисление и сверка Digest из канонизированного JSON
* верификация подписи бинарного Digest по публичному ключу из сертификата

Шаги канонизации JSON:

* рекурсивная сортировка по ключу вложенных данных
* приведение к unicode
* кодирование в HEX
