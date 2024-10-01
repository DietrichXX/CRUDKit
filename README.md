# CRUDKit:
Пакет для генерации начального набора CRUD файлов:
- Модели
- Контроллера
- Реквеста
- Миграции
- Основных шаблонов

# Установка:
1. composer require dietrichxx/crud-kit
2. регистрация провайдера: 
   ```php
    'providers' => [
         // ...
         Dietrichxx\CrudKit\CRUDKitServiceProvider::class,
    ];
3. php artisan vendor:publish --tag=config --provider="Dietrichxx\CrudKit\CRUDKitServiceProvider"

# Настройка:
В созданом файле config/crudkit.php :
- base_path.controller_base_path — базовый путь для генерации контроллеров
- base_path.request_base_path — базовый путь для генерации request классов.
- base_path.model_base_path — базовый путь для моделей.
- base_path.templates_path — путь к директории с шаблонами, которая будут использоваться при генерации файлов.
- parents.controller — родительский класс для всех сгенерированных контроллеров. По умолчанию используется \App\Http\Controllers\Controller, но вы можете указать свой собственный класс.

Все пути можно изменить под себя и указать свои пути к создаваемым файлам. Это позволяет гибко настраивать структуру вашего проекта и организовывать файлы в соответствии с вашими предпочтениями или требованиями проекта.

# Команды:
Для создания CRUD набора на основе конфиг файла с указаными путями: 
 - php artisan init:crudkit {Название модели}

Для создания CRUD набора на основе опциональных путей:
 - php artisan init:crudkit {Название модели} --optional-path

