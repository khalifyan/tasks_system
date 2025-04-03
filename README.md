# Tasks

### Установка и запуск
* composer install
* php artisan sail:install
*  ./vendor/bin/sail up
* php artisan migrate
* php artisan db:seed


### Запросы

##### `Users`
* POST api/register - регистрация пользователя
* POST api/login - логин, полчение токена

Authorization: Bearer {token}

* POST api/logout - выход из системы
* POST api/refresh - обновление bearer токена

##### `Tasks`
Authorization: Bearer {token}
* GET api/tasks - список задач
* POST api/tasks - создание задачи
* PUT api/tasks/{id} - обновление задачи по ID
* DELETE api/tasks/{id} - удаление задачи по ID


### Тесты  
Authorization: Bearer {token}
* TaskControllerIndexTest -  тест списка задач
* TaskControllerStoreTest -  тест создания задачи
* TaskControllerUpdateTest -  тест обновления задачи
* TaskControllerDestroyTest -  тест удаления задачи
