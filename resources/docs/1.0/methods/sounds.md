# Звуки (sounds)

---

- [sounds/stream](#section-1)
- [sounds/save](#section-2)


<a name="section-1"></a>
## Stream
Отправка звуков на сервер. Собирает данные на протяжение всей записи.


> {warning} Обязательно! После остановки записи необходимо отправить запрос `sounds/save`!
> Отправлять данные нужно ***каждые 5 секунд***.
> Если не сохранить, перед новым запуском, то предыдущие данные будут затерты новыми

### Тип запроса: `POST`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/sounds/stream`

### Доступные поля
Полей нет, поэтому нужно отправлять поток в Body

### Успешный ответ
```json
{
    "success": true,
    "message": "Data pushed",
    "payload": {
        "user_id": "<id-пользователя|integer>"
    },
    "requestCode": 0
}
```

### Ответ с ошибкой
Без обработки ошибок

<a name="section-2"></a>
## Save
Сохранить звук. Данный метод объединяет потоки и возвращает уже готовый звук. 
Также добавляет его в базу данных.

### Тип запроса: `POST|GET`

### Авторизация: `Да`


### Запрос
> {info} API Request: `POST /api/v1/sounds/save`

### Доступные поля
Поля не принимает

### Успешный ответ
```json
{
    "success": true,
    "message": "Hearth Bit successfully saved",
    "payload": {
        "path": "./final/user2/22-09-2021-13-58.wav",
        "seconds": 183.2,
        "graphic": "graphic.png",
        "deviations": false,
        "deviations_type": 0,
        "user_id": 2
    },
    "requestCode": 0
}
```

### Ответ с ошибкой
Без обработки ошибок
