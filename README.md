## Развертка проекта

#### Системные требование
* Docker (Compose)

#### Контейнеры

- livestore_psql - СУБД PostgreSQL
- livestore_pgadmin - Веб управравление с СУБД PostgreSQL
- livestore_nginx - Веб сервер Nginx
- livestore_app - Основной контейнер

####  Шаг 1
Из корневой директории выполняем команду `docker-compose up -d` .

> *Внимание перед тем как выполнить команду другие контейнеры желательно должны быть отключены.*

    Creating network "polyarix_default" with the default driver
    Creating livestore_psql ... done
    Creating livestore_pgadmin ... done
    Creating livestore_app     ... done
    Creating livestore_nginx   ... done


####  Шаг 2
Редактируем `hosts` файл в зависимости от ОС это

- `C:\Windows\System32\drivers\etc` - **WINDOWS**
- `/etc/hosts` - **LINUX**

И туда записываем следующие
```
127.0.0.1 web.local
127.0.0.1 api.local
```
####  Шаг 3
Заходим в основной конейнер с помощью команды `docker exec -it livestore_app sh`
```
cd ./server
cp .env.example .env
composer install
php artisan migrate --seed
php artisan test
```

Если всё ок то после ввода `php artisan test` должно вывести
```
   PASS  Tests\Unit\ProductControllerTest
  ✓ for fetch products
  ✓ for search product by name
  ✓ for store product
  ✓ for update product
  ✓ for destroy product

   PASS  Tests\Feature\ExampleTest
  ✓ basic test

  Tests:  6 passed
  Time:   5.22s
```
####  Шаг 4
Открываем на браузере адрес `http://web.local`
