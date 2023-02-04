Аутентификация
===

Токен отправляется в виде заголовка `Authorization`.

Например:

```json
{
	"Authorization": "jwt eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImtpZCI6ImM4NGQyYTU0LTgyY2ItNGY5Ny1hYjJhLWE5MmFmNjM2ZmY1OCJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkueXVuZXdzLnByb2plY3RcL3YxXC9hdXRoIiwic3ViamVjdCI6eyJpZCI6MTQ2fSwiYXVkIjpbImh0dHA6XC9cL2FwaS55dW5ld3MucHJvamVjdCJdLCJleHAiOjE1NDU4MzAwNjV9.iGOF9CzAUH2ZEoZzw__JkdGrWO0kH9zTh-HzP9hxrfk"
}
```

Если в ответ получаем статус-код [401](http-code/401.md), это означает,
что токен не актуальный.
В этом случае, получаем новый токен.
