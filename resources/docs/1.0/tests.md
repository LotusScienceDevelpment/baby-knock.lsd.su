# Тестовые данные

---

- [Аккаунт Мамы](#section-1)
- [Аккаунт Врача](#section-2)
- [QR-код для добавления врачу](#section-3)



<a name="section-1"></a>
## Аккаунт мамы
Для авторизации используйте следующие данные
```text
Login: +79181321819
Password: 12345
AccountType: mom
```

<a name="section-3"></a>
## Аккаунт Врача
Для авторизации используйте следующие данные
```text
Login: +79181321919
Password: 12345
AccountType: doctor
```

<a name="section-3"></a>
## QR-код для добавления врачу
QR-код, чтобы проверить добавление аккаунта к врачу
В нем храниться ID-устройства в виде строки: `123e4567-e89b-12d3-a456-426655440000`

После сканирования эту строку нужно отправлять на метод `POST /api/v1/patients/afterScan`.


[Описание метода](http://194.58.121.186/docs/1.0/methods/patients#section-3)



![image](/storage/websiteplanet-qr%201.png)


