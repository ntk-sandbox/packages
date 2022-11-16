Пример запроса:

```json
{
  "jsonrpc": "2.0", //версия JSON-RPC
  "method": "news.oneById", //метод запроса
  "params": {
    "meta": { //meta-параметры
      "Language":"ru",  //язык
      "API key": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx", //Bearer Token
      "Authorization": "jwt xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx", //jwt Token
      "DigestValue": "7DyfHjZpZJZOL5R93KYlhyoykpxvAJ2voaPF1F+/bcU=",
      "SignatureValue": "Vl/gAVDZwUuS4vEJcwanM8Z0z5gDCRbZzDUdetZk9OlHJ6TMOFxZJ6ouwcHRhT2OQyVZkw7JBIHqPPTPeViQwA==",
      "X509Certificate": "MIIE9TCCBJ+gAwIBAg ... i5E2tzM59aZM2PP6Mc4I+W9hbevZDTb9Gbg=="
    },
    "body": { // параметры запроса
      "id": "1234" //id новости
    }
  },
  "id": 1
}
```
