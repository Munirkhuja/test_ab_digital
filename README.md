## Установка и настройка проект

- `composer install`
- `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- `php artisan migrate --seed`
- `php artisan key:generate`
- `php artisan co:ca`
- `chmod -R 775 storage bootstrap/cache`

# 3 task
    в метод register AppServiceProvider-а добавил строки:
    Model::preventLazyLoading(!app()->isProduction());
    Model::preventAccessingMissingAttributes(!app()->isProduction());
    который позволяет понять в каких запросах lazy load и не прописан with для выборки отношонение запроса.
    пример: Article::query()->get() во время того как показываем имя автора будут дубликаты одинаковых запросов,
    в этом случае оптимизировал запрос с добавление with:
    Article::query()->with('author')->get() или Article::query()->withAggregate('author','name')->get()
    другой вариант это добавление JOIN.
    Другие инструменты которых используют для оптимизации запроса это Telescope и Laravel Debugbar
    дают возможность понят какые запросы медленно исполняються.
# API

## Article

- `/api/v1/article` : GET method.
    - Body example:
    ```
    {
        "title" : "Digital",
        "text" : "ab",
        "created_at_from" : "",
        "created_at_to" : "",
        "limit":150,
        "sort":-title,text
    }
    ```
    - Result:
    ```
    [
        {
          "id": ,
          "title": "",
          "text": ""
          "image_path": ""
          "author": ""
          "author_id": ""
          "created_at": ""
          "updated_at": ""
        },
        {
          "id": ,
          "title": "",
          "text": ""
          "image_path": ""
          "author": ""
          "author_id": ""
          "created_at": ""
          "updated_at": ""
        }
    ```

- `/api/v1/article/{id}` : GET method.
    - Body example:
    ```
    ```
    - Result:
    ```
    {
      "id": ,
      "title": "",
      "text": ""
      "image_path": ""
      "author": ""
      "author_id": ""
      "created_at": ""
      "updated_at": ""
    }
    ```
- `/api/v1/article` : POST method.
    - Body example:
    ```
      "title": "",
      "text": ""
      "image": ""
    ```
    - Result:
    ```
    {
      "message": "Статья создана"
    }
    ```
- `/api/v1/article/{id}` : POST method.
    - Body example:
    ```
      "title": "",
      "text": ""
    ```
    - Result:
    ```
    {
      "message": "Статья обновлено"
    }
    ```
  
- `/api/v1/article/{id}` : DELETE method.
    - Body example:
    ```
    ```
    - Result:
    ```
    {
        "message": "Статья удалена"
    }
    ```
