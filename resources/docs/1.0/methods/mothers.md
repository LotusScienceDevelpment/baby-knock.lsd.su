# Мама (mothers)

---

- [mothers/get](#section-1)
- [mothers/rename](#section-2)
- [mothers/delete](#section-3)


<a name="section-1"></a>
## Get
Получить все записи звуков мамы. 

### Тип запроса: `GET`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/mothers/get`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|limit|Устанавливает ограничение по выводу записей|Integer|Нет
|offset|Устанавливает с какой записи начинать|Integer|Нет

### Успешный ответ
```json
{
    "success": true,
    "message": "Hearths successfully got",
    "payload": [
        {
            "id": 3,
            "name": "Тест",
            "path": "./final/user2/22-09-2021-11-22.wav",
            "seconds": "143.5",
            "graphic": "graphic.png",
            "deviations": false,
            "deviations_type": 0,
            "created_at": "2021-09-22T08:22:17.000000Z",
            "updated_at": "2021-09-22T08:47:02.000000Z"
        },
        ...
    ],
    "requestCode": 0
}
```

### Описание полей, которые возвращает (payload)
|Поле|Описание|Тип данных
|--|--|--|
|id|ID-записи|Integer
|name|Название записи. По умолчанию задается дата записи|String
|path|Путь до файла со звуком|String
|seconds|Сколько идет запись (в секундах)|String \| Float
|graphic|Путь до графика звука. Для мамы оно не нужно.|String
|deviations|Есть ли какие-либо отклонения|Boolean
|deviations_type|Тип отклонения|Integer
|created_at|Дата создания записи|String
|updated_at|Дата последнего изменения записи|String

### Ответ с ошибкой
Без обработки ошибок, если записей нет, то `payload` будет пустой `[]`

<a name="section-2"></a>
## Rename
Переименовать запись

### Тип запроса: `POST`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/mothers/rename`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|hearth_id|ID-записи|Integer|Да
|name|Название на которую хотят изменить|String|Да

### Успешный ответ
```json
{
    "success": true,
    "message": "Hearth successfully renamed",
    "payload": [],
    "requestCode": 0
}
```

### Ответ с ошибкой
```json
{
    "success": false,
    "message": "Perhaps the hearth doesn't belong to you or doesn't exist",
    "payload": [],
    "requestCode": 0
}
```

<a name="section-3"></a>
## Rename
Удалить запись. При удалении, записи не удаляется полностью, а храниться на сервере.

### Тип запроса: `DELETE`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/mothers/delete`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|hearth_id|ID-записи|Integer|Да
|name|Название на которую хотят изменить|String|Да

### Успешный ответ
```json
{
    "success": true,
    "message": "Hearth successfully deleted",
    "payload": [],
    "requestCode": 0
}
```

### Ответ с ошибкой
```json
{
    "success": false,
    "message": "Perhaps the hearth doesn't belong to you or doesn't exist",
    "payload": [],
    "requestCode": 0
}
```
