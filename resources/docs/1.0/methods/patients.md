# Пациенты (profile)

---

- [profile/get](#section-1)
- [profile/view](#section-2)
- [profile/afterScan](#section-3)


<a name="section-1"></a>
## Get
Получить информацию о всех пациентах.

### Тип запроса: `GET`

### Авторизация: `Да`


### Запрос
> {info} API Request: `GET /api/v1/patients/get`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|offset|С какой записи начинать|Integer|Нет
|limit|Сколько записей выводить|Integer|Нет
|deviations|Показывать пациентов по критериям. (Критерии: 1 - только с нарушениями, 2 - только здоровые, 3 - показывать всех или не указывать данное поле, тогда по умолчанию будет отображать всех)|Integer|Нет
|search|Поиск по имени и фамилии|String|Нет

### Успешный ответ
```json
{
    "success": true,
    "message": "Patients successfully loaded",
    "payload": [
        {
            "id": 2,
            "first_name": "Мария",
            "last_name": "Фамилия",
            "deviations": false,
            "last_hearth": "22.09.2021 в 10:58"
        },
        ...
    ],
    "request_code": 0
}
```

### Описание полей, которые возвращает (payload)
|Поле|Описание|Тип данных
|--|--|--|
|id|ID-пользователя|Integer
|first_name|Имя пользователя|String
|last_name|Фамилия пользователя|String
|deviations|Есть ли нарушения|Boolean
|last_hearth|Дата последней записи сердечного ритма|String


### Ответ с ошибкой
Ошибка может быть только в случае, если пользователь не авторизован.
```json
{
    "success": false,
    "message": "Unauthenticated",
    "payload": {
        "logged": false
    },
    "request_code": -401
}
```
#### HTTP-Status Code: 401 Unauthorized

<a name="section-2"></a>
## View
Получить информацию о пациенте подробнее

### Тип запроса: `GET`

### Авторизация: `Да`


### Запрос
> {info} API Request: `GET /api/v1/patients/view`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|id|ID-пользователя|Integer|Да

### Успешный ответ
Возвращает в `payload` два объекта. Первый объект `user` рассказывает о пользователе, которого просматривают, а
второй `hearths` массив объектов с описанием записи сердечного ритма.

```json
{
    "success": true,
    "message": "Patient successfully got",
    "payload": {
        "user": {
            "id": 2,
            "first_name": "Мария",
            "last_name": "Фамилия",
            "device_id": null,
            "email": "danilsidorenko00@gmail.com",
            "email_verified_at": null,
            "phone": "+7 918 132-18-19",
            "status": "Стандарт",
            "account_type": "mom",
            "created_at": "2021-09-21T19:05:51.000000Z",
            "updated_at": "2021-09-22T08:59:49.000000Z",
            "doctor_id": 3
        },
        "hearths": [
            {
                "id": 4,
                "name": "Тест",
                "path": "./final/user2/22-09-2021-11-22.wav",
                "seconds": "143.54371584699",
                "graphic": "graphic.png",
                "deviations": false,
                "deviations_type": 0,
                "created_at": "2021-09-22T08:22:17.000000Z",
                "updated_at": "2021-09-22T08:47:02.000000Z",
                "user_id": 2,
                "deleted_at": null
            },
            ...
        ]
    },
    "request_code": 0
}
```
Подробное описание полей находится в `mothers` (про записи) и `profile` (про пользователя)

### Ответ с ошибкой
Данная ошибка возвращается, если пользователь не был найден. Если нет записи про сердечный ритм, то
метод вернет объект с `hearths: []`
```json
{
    "success": false,
    "message": "User not found.",
    "payload": [],
    "request_code": 0
}
```

<a name="section-3"></a>
## afterScan
Получить информацию о пациенте подробнее

### Тип запроса: `POST`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/patients/afterScan`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|device_id|ID-устройства после сканирования QR-кода|String|Да

### Успешный ответ
Возвращает в `payload` объект с пользователем, который был добавлен

```json
{
    "success": true,
    "message": "User successfully added.",
    "payload": {
        "id": 2,
        "first_name": "Мария",
        "last_name": "Фамилия",
        "device_id": "123e4567-e89b-12d3-a456-426655440000",
        "email": "danilsidorenko00@gmail.com",
        "email_verified_at": null,
        "phone": "+7 918 132-18-19",
        "status": "Стандарт",
        "account_type": "mom",
        "created_at": "2021-09-21T19:05:51.000000Z",
        "updated_at": "2021-09-24T15:08:59.000000Z",
        "doctor_id": 3
    },
    "request_code": 0
}
```
Подробное описание полей находится в `profile` (про пользователя)

[comment]: <> (123e4567-e89b-12d3-a456-426655440000)
### Ответ с ошибкой
Данная ошибка возвращается, если пользователь не был найден по ID устройства.
```json
{
    "success": false,
    "message": "User with this device id was not found",
    "payload": [],
    "request_code": 0
}
```
