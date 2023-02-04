# GPG

## О PGP

* PGP (Pretty Good Privacy) является продуктом и торговой маркой Symantec Corporation (они купили его несколько лет назад).
* OpenPGP – это стандарт, используемый PGP.
* GnuPG (Gnu Privacy Guard) представляет собой бесплатную реализацию PGP с открытым исходным кодом.

## Команды

Генерация

    gpg --full-generate-key

Список ключей

    gpg --list-secret-keys --keyid-format LONG

Посмотреть публичный ключ

    gpg --armor --export 545166771694DE62

Расшифровать файл

    gpg --output ~/xxx/xxx.txt --decrypt ~/xxx/xxx.gpg

Зашифровать файл

    gpg --encrypt --recipient xxx@mail.com ~/xxx/xxx.txt
