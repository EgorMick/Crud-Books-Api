## 1. Клоинруйте проект с github:
```bash
git clone https://github.com/EgorMick/CRUD_BOOKS
cd CRUD_BOOKS
```

## 2. Создайте env файл:
```bash
cp .env.example .env
```

## 3. Настройте переменные окружения
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=user
DB_PASSWORD=password
```

## 4. Установите зависимости:
```bash
composer install
```
## 5. Создайте ключ приложения:
```bash
php artisan key:generate
```

## 6. Перейдите в папку:
```bash
cd docker_s
```

## 7. Создайте env файл
```bash
touch .env
```

## 8. Настройте переменные окружения docker_s/.env:
```bash
PROJECT_NAME=crud
NGINX_PORT=92
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=user
DB_PASSWORD=password
```

## 9. Запустите контейнеры:
```bash
docker-compose up -d
```

## 10. Зайдите внутрь контейнера php-fpm:
```bash
docker-compose exec php-fpm bash
```
## 11. Выполните миграции:
```bash
php artisan migrate
```

## 12. Заполните базу данных тестовыми данными:
```bash
php artisan db:seed
```

## 13. Зайдите в Postman и перенесите туа коллекцию: Api Books.postman_collection.json: которая располагается в корне проекта

## 14. Зарегистрируйтесь через Postman через: RegisterUser

## 15. Скоипруйте token и используйте его в других запросах в коллекции
