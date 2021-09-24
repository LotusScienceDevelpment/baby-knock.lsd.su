# Доступные методы

---

- [Пользователи](#section-1)
- [Звуки](#section-2)
- [Мама](#section-3)
- [Профиль](#section-4)
- [Пациенты](#section-5)

<a name="section-1"></a>
## [Пользователи (users)](/{{route}}/{{version}}/methods/users)
Позволяет управлять пользователями. На данный момент только авторизация.

> {info} API Request: `/api/v1/users/<method>`

|Метод|Описание|
|--|--|
|login|Войти в учетную запись

<a name="section-2"></a>
## [Звуки (sounds)](/{{route}}/{{version}}/methods/sounds)
Позволяет управлять API от Python. Отправить пакеты с устройства и сохранить запись

> {info} API Request: `/api/v1/sounds/<method>`

|Метод|Описание|
|--|--|
|stream|Отправить данные с устройства каждые 5 секунд
|save|Сохранить запись в базе данной

<a name="section-3"></a>
## [Мама (mothers)](/{{route}}/{{version}}/methods/mothers)
Управление записями мамы (а именно получить все сохраненные записи и управление ими)

> {info} API Request: `/api/v1/mothers/<method>`

|Метод|Описание|
|--|--|
|get|Получить все записи
|view|Получить определенную запись
|rename|Изменить имя записи
|delete|Удалить запись


<a name="section-4"></a>
## [Мой профиль (profile)](/{{route}}/{{version}}/methods/profile)
Управление аккаунтом мамы

> {info} API Request: `/api/v1/profile/<method>`

|Метод|Описание|
|--|--|
|get|Получить информацию о себе
|change|Изменить информацию о себе


<a name="section-5"></a>
## [Пациенты (patients)](/{{route}}/{{version}}/methods/patients)
Методы для врача

> {info} API Request: `/api/v1/patients/<method>`

|Метод|Описание|
|--|--|
|get|Получить всех своих пациентов
|view|Посмотреть конкретного пациента
|afterScan|Сканировать QR-код для добавления в список пациентов

