## Установка и настройка проект

- `composer install`
- `php -r "file_exists('.env') || copy('.env.example', '.env');"`
- `php artisan migrate --seed`
- `php artisan key:generate`
- `php artisan co:ca`
- `chmod -R 775 storage bootstrap/cache`

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
