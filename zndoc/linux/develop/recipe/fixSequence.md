# Исправление sequence в Postgres

Узнать следующий ID:

```postgresql
SELECT nextval('public.users_id_seq');
```

Узнать максимальный ID:

```postgresql
SELECT MAX(id) FROM public.users;
```

Исправить sequence:

```postgresql
BEGIN;
LOCK TABLE public.users IN EXCLUSIVE MODE;
SELECT setval('public.users_id_seq', COALESCE((SELECT MAX(id)+1 FROM public.users), 1), false);
COMMIT;
```
