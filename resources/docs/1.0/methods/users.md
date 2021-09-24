# Пользователи (users)

---

- [users/login](#section-1)


<a name="section-1"></a>
## Login
Войти в учетную запись

### Тип запроса: `POST`

### Запрос
> {info} API Request: `POST /api/v1/users/login`

### Доступные поля
|Поля|Описание|Тип данных|Обязательно|
|--|--|--|--|
|phone|Номер телефона. Форматирование телефона происходит автоматически|string|Да
|password|Пароль пользователя|string|Да
|account_type|Тип аккаунта|string|Да

### Успешный ответ
```json
{
    "success": true,
    "message": "You successfully authorized.",
    "payload": {
        "user": {
            "id": 3,
            "first_name": "Доктор",
            "last_name": "Фамилия",
            "device_id": null,
            "email": "danilsidorenko01@gmail.com",
            "email_verified_at": null,
            "phone": "+7 918 132-19-19",
            "status": "Стандарт",
            "account_type": "doctor",
            "created_at": "2021-09-22T09:06:00.000000Z",
            "updated_at": "2021-09-22T09:06:00.000000Z",
            "doctor_id": null
        },
        "accessToken": "eyJ0eXAiOiJKV..."
    },
    "requestCode": 101
}
```

### Ответ с ошибкой
```json
{
    "success": false,
    "message": "Wrong number phone or password.",
    "payload": [],
    "requestCode": 101
}
```
