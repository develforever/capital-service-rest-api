
# Capital Service - REST JSON API

Job interview task.

## Requirements

Docker with Docker Compose 
PHP 8.1 (phpenv or brew)
PHP Composer

## Run

Run compose install

```
compose install
```

Run and build containers
```
dockere compose up -d --build
```

Open address for Swagger UI.

```
http://localhost:9080/
```

On container `app` run

```
php bin/console doctrine:migrations:migrate
php bin/console app:user-create johndoe test
```


Get JWT Token by running command:

```
curl --location 'http://localhost:9000/api/v1/login_check' \
--header 'Content-Type: application/json' \
--header 'Cookie: PHPSESSID=67aefa5fb6aaf4d06be786a7d7cc5a38' \
--data '{
    "username": "johndoe",
    "password": "test"
}'
```
this token is used for secured api endpoints by header `Authorization: Bearer <token_from_curl_command_above>`

API public endpoints:

```
- { path: ^/api/v1/login, roles: PUBLIC_ACCESS }
- { path: ^/api/v1/loan, roles: PUBLIC_ACCESS }
- { path: ^/api/v1, roles: PUBLIC_ACCESS }
- { path: ^/api/v1/doc.json, roles: PUBLIC_ACCESS }
```



