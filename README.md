# repo
рабочий проект project стартовый файл index.php

стартовая страница index.php
предложение об авторизации
на любой странице происходит проверка аутентифицирован ли пользователь

куки устанавливаются на 300 сек.
после регистрации или авторизации переход на станицу авторизованного пользователя привет, User. Рядом я вывел инфу для отладки cookie_display

- нет доступа к адресу (http://localhost/pages/) (не показывает список страниц)

- при отправке формы авторизации:
    при неверном пароле в консоль браузера выводится "неверный пароль"
    при неверном пользователе в консоль браузера выводится "пользователь не найден" (сначала происходит проверка наличия пользователя в БД затем проверка пароля)
- при отправке формы регистрации:
    проверка на не совпаденеи паролей (password !== confirmPassword) Ошибка при регистрации: Пароли не совпадают

*Когда пользователь авторизовывается, из БД читается id сессии (под которой он заходил в прошлый раз) и его новой сессии назначается этот же идентификатор (так подтягиваются его настройки)

*когда куки истекают остается висеть в Application PHPSESSID. Но при авторизации (если поменять в БД id сессии вручную) он обновится

*при разлоге удаляется все из Application в т.ч. и PHPSESSID
Ошибки при отпарвке формы:
-Обработано Ошибка при регистрации: Пользователь с таким email уже есть
-Ошибка при регистрации: Пароли не совпадают
-Неверный пароль, Пользователь не найден

class Crypto для хэша и шифрования md5

CRUD:
create - создание пользователя
read - метод получения всх пользователей из БД class userDbHandler->getAllUsers()
update - обновление last_visited userDbHandler->updateUser()
delete - кнопка "забыть меня" удаляет информацию о пользователе из БД (в delete_user_process читается $email из куки и передается на метод в удаление)

одинаковые login у пользователей допускаются.
пользователь однозначно идентифицируется по email (проверка на уникальный email в бд)
