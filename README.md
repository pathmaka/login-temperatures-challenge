# Login-Temperatures-Challenge

The task is to implement a small webapp that will store the current temperature of two cities when a user logs in, and display a historical list of the users login temperatures. 

> Technologies:<br />

    PHP (Laravel 8.x)
    SQLite
    Vue.js
    Open Weather API / https://openweathermap.org/api/one-call-api
    
    (this is a small webapp then I have used Vue/Laravel mix build) 
    
## API
Rest API authentication: Sanctum
```
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
| Domain | Method   | URI                 | Name | Action                                                     | Middleware                               |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
|        | GET|HEAD | /                   |      | Closure                                                    | web                                      |
|        | POST     | api/login           |      | App\Http\Controllers\API\AuthController@login              | api                                      |
|        | POST     | api/logout          |      | App\Http\Controllers\API\AuthController@logout             | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | api/profile         |      | Closure                                                    | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/register        |      | App\Http\Controllers\API\AuthController@register           | api                                      |
|        | POST     | api/savetemp        |      | App\Http\Controllers\API\AuthController@saveTemperature    | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | POST     | api/temperatures    |      | App\Http\Controllers\API\AuthController@temperatures       | api                                      |
|        |          |                     |      |                                                            | App\Http\Middleware\Authenticate:sanctum |
|        | GET|HEAD | sanctum/csrf-cookie |      | Laravel\Sanctum\Http\Controllers\CsrfCookieController@show | web                                      |
+--------+----------+---------------------+------+------------------------------------------------------------+------------------------------------------+
```
## Installation
1. Clone the repository
2. Update `.env` file with the config details 
3. Run the migration
4. Install/Update all the dependencies (npm)
5. Run the Laravel project `php artisan serve`

.env SQLite DB configuration<br />

    DB_CONNECTION=sqlite
    DB_HOST=127.0.0.1
    DB_PORT=3306
    


## References
[Laravel docs](https://laravel.com/docs/4.2/)<br />
[Vue.js](https://vuejs.org/guide/introduction.html/)<br />
[Composer (A Dependency Manager )](https://getcomposer.org/)<br />

