1) Установка лары:
 composer install

2) Миграции:
php artisan migrate

3) Добавление тестовых данных:

php artisan db:seed --class=RunSeeder

4) установка предис (работа локальная на windows, дял работы с редис нужен был этот пакет) 
composer require predis/predis
