# Тестовое задание

Необходимо реализовать микросервис загрузки курсов валют.

На входе:

* API смежной системы, которое возвращает курсы валют на текущую дату в формате XML. Можно использовать например API
  ЦБ  http://www.cbr.ru/scripts/XML_daily.asp

Нужно:

* Загрузить данные по курсам
* Реализовать RESP JSON API для выгрузки данных по курсам
* Необходимо сохранять историю курсов валют
* Необходимо сократить кол-во запросов в смежную систему

Формат входных и выходных данных предлагается разработать самостоятельно.

Используемые технологии

При выполнении задания требуется использовать следующие технологии:

* веб-сервер Nginx
* язык программирования PHP
* база данных Postgresql
* желательно оформить код по стандартам PSR;
* запрещается использовать различные framework’и
* результаты нужно передать с помощью Docker (необязательно)

# Запуск

1. `docker-compose up -d` - развернуть контейнеры
2. `docker-compose run composer install` - установить зависимости
3. Использовать `dump.sql` для создания таблиц в БД

# Использование

Для получения курса валют, необходимо отправить get запрос на url `/exchange-rate` с параметром `date`

`date` - дата, за которую необходимо получить курсы валют, в формате `день.месяц.год` или `год-месяц-день`

Пример:

```
GET /exchange-rate?date=20.08.2022
```

Ответ:

```json
{
  "data": [
    {
      "value": "40.8839",
      "date": "20/08/2022",
      "name": "Австралийский доллар",
      "code": "AUD",
      "nominal": 1
    },
    {
      "value": "34.7836",
      "date": "20/08/2022",
      "name": "Азербайджанский манат",
      "code": "AZN",
      "nominal": 1
    },
    {
      "value": "70.9763",
      "date": "20/08/2022",
      "name": "Фунт стерлингов Соединенного королевства",
      "code": "GBP",
      "nominal": 1
    },
    ...
  ]
}
```