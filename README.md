Установка:

php artisan migrate:fresh --seed

php artisan serve

Получить токен для пользователя и для администратора(в файле UserSeeder данные для пользователя и для админа)

Импортировать схему из yaml или json файла и протестировать api(В качестве авторизации использовать в строке в swagger - Bearer "**TOKEN"**)

Тесты располагаются в файле CarTest.php, в папке unit