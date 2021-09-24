# Управление Профилем (profile)

---

- [profile/get](#section-1)
- [profile/update](#section-2)


<a name="section-1"></a>
## Get
Получить информацию о своем профиле.

### Тип запроса: `GET`

### Авторизация: `Да`


### Запрос
> {info} API Request: `GET /api/v1/profile/get`

### Доступные поля
Поля не принимает

### Успешный ответ
```json
{
    "success": true,
    "message": "Successfully got profile",
    "payload": {
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
    "requestCode": 0
}
```

### Описание полей, которые возвращает (payload)
|Поле|Описание|Тип данных
|--|--|--|
|id|ID-пользователя|Integer
|first_name|Имя пользователя|String
|last_name|Фамилия пользователя|String
|device_id|ID-девайса|String \| Float
|email|Электронный адрес пользователя|String
|email_verified_at|Когда была подтверждена почта|String
|phone|Номер телефона пользователя|String
|status|Статус пользователя/Его план. Сейчас только Стандарт|String
|account_type|Тип аккаунта. (doctor - врач, mom - мама)|String
|created_at|Дата создания аккаунта|String
|updated_at|Дата последнего обновления аккаунта|String
|doctor_id|ID-врача, который подвязан под маму|Integer

> {info} Если это врач, то у него похожие данные, однако некоторые поля имею значение `NULL`.
> Такие поля: `device_id`, `status`, `doctor_id`


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
## Update
Изменить настройки профиля

### Тип запроса: `POST`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/profile/update`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|first_name|Имя пользователя|String|Нет*
|last_name|Фамилия пользователя|String|Нет*

> {warning} `*` - означает, что необходимо указать хотя бы одно поле, чтобы запрос был успешен.

### Успешный ответ
Возвращает те поля в `payload`, которые были изменены
```json
{
    "success": true,
    "message": "Profile successfully updated",
    "payload": {
        "first_name": "Мария"
    },
    "request_code": 0
}
```

### Ответ с ошибкой
Данная ошибка возвращается в случае, если не было указано ни одно поле.
```json
{
    "success": false,
    "message": "The given data was invalid.",
    "payload": [
        {
            "field": "first_name",
            "message": "The first name field is required when none of last name are present."
        },
        {
            "field": "last_name",
            "message": "The last name field is required when none of first name are present."
        }
    ],
    "request_code": -400
}
```
