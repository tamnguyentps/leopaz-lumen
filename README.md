# leopaz-lumen
## API Server in Leopaz

### Features

1. JWT - Authentication
2. User role management
3. Resource Factor
    1. CRUD
    2. Search
4. File management

# Lumen with JWT Authentication
Basically this is a starter kit for you to integrate Lumen with [JWT Authentication](https://jwt.io/).
If you want to Lumen + Dingo + JWT for your current application, please check [here](https://github.com/krisanalfa/lumen-dingo-adapter).

## What's Added

- [Lumen 5.4](https://github.com/laravel/lumen/tree/v5.4.0).
- [JWT Auth](https://github.com/tymondesigns/jwt-auth) for Lumen Application. <sup>[1]</sup>
- [Dingo](https://github.com/dingo/api) to easily and quickly build your own API. <sup>[1]</sup>
- [Lumen Generator](https://github.com/flipboxstudio/lumen-generator) to make development even easier and faster.
- [CORS and Preflight Request](https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS) support.

> [1] Added via [this package](https://packagist.org/packages/krisanalfa/lumen-dingo-adapter).

## Quick Start

- Clone this repo or download it's release archive and extract it somewhere
- You may delete `.git` folder if you get this code via `git clone`
- Run `composer install`
- Run `php artisan jwt:generate`
- Configure your `.env` file for authenticating via database
- Set the `API_PREFIX` parameter in your .env file (usually `api`).
- Run `php artisan migrate --seed`

## A Live PoC

- Run a PHP built in server from your root project:

```sh
php -S localhost:8000 -t public/
```

Or via artisan command:

```sh
php artisan serve
```

To authenticate a user, make a `POST` request to `/api/auth/login` with parameter as mentioned below:

```
email: johndoe@example.com
password: johndoe
```

Request:

```sh
curl -X POST -F "email=johndoe@example.com" -F "password=johndoe" "http://localhost:8000/api/auth/login"
```

Response:

```
{
  "success": {
    "message": "token_generated",
    "token": "a_long_token_appears_here"
  }
}
```

- With token provided by above request, you can check authenticated user by sending a `GET` request to: `/api/auth/user`.

Request:

```sh
curl -X GET -H "Authorization: Bearer a_long_token_appears_here" "http://localhost:8000/api/auth/user"
```

Response:

```
{
  "success": {
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "johndoe@example.com",
      "created_at": null,
      "updated_at": null
    }
  }
}
```

- To refresh your token, simply send a `PATCH` request to `/api/auth/refresh`.
- Last but not least, you can also invalidate token by sending a `DELETE` request to `/api/auth/invalidate`.
- To list all registered routes inside your application, you may execute `php artisan route:list`

```
⇒  php artisan route:list
+--------+----------------------+---------------------+------------------------------------------+------------------+------------+
| Verb   | Path                 | NamedRoute          | Controller                               | Action           | Middleware |
+--------+----------------------+---------------------+------------------------------------------+------------------+------------+
| POST   | /api/auth/login      | api.auth.login      | App\Http\Controllers\Auth\AuthController | postLogin        |            |
| GET    | /api                 | api.index           | App\Http\Controllers\APIController       | getIndex         | jwt.auth   |
| GET    | /api/auth/user       | api.auth.user       | App\Http\Controllers\Auth\AuthController | getUser          | jwt.auth   |
| PATCH  | /api/auth/refresh    | api.auth.refresh    | App\Http\Controllers\Auth\AuthController | patchRefresh     | jwt.auth   |
| DELETE | /api/auth/invalidate | api.auth.invalidate | App\Http\Controllers\Auth\AuthController | deleteInvalidate | jwt.auth   |
+--------+----------------------+---------------------+------------------------------------------+------------------+------------+
```

## ETC

I made a Postman collection [here](https://www.getpostman.com/collections/1090b93eaa1ece4b09f2).
