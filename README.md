# Песочница для отладки Symfony Expression Language выражений

## Установка

Установка зависимостей:  
```shell
composer install
```

## Запуск  

С помощью встроенного веб-сервера PHP (для отладки):

```shell
php -S localhost:8080 -t ./public
```

## Пример использования

**Данные в формате JSON:** 
```json
{
    "debtCase": {
        "article": "codexKoapRF",
        "articleNumber": "Ст.20.25, Ч.1",
        "caseNumber": "05-1111/222/2023",
        "caseUUID": "d5936d48-a79b-4e91-a31c-de30343083f0",
        "currentCaseStatus": {
            "caseStatusChangeDate": "2023-05-25T12:30:00Z",
            "caseStatusKind": "CAME_INTO_FORCE"
        },
        "debtReminder": 15000,
        "debtSum": 30000
    },
    "debtor": {
        "debtorCases": [
            {
                "article": "codexKoapRF",
                "articleNumber": "Ст.20.25, Ч.1",
                "caseNumber": "05-1111/222/2023",
                "caseUUID": "d5936d48-a79b-4e91-a31c-de30343083f0",
                "currentCaseStatus": {
                    "caseStatusChangeDate": "2023-05-25T12:30:00Z",
                    "caseStatusKind": "CAME_INTO_FORCE"
                },
                "debtReminder": 15000,
                "debtSum": 30000
            }
        ],
        "debtorPersonInfo": {
            "firstName": "Иван",
            "phones": [
                "9001234567"
            ]
        },
        "debtorStatus": "APPROVED",
        "debtorUUID": "fbaf22e5-bf22-222b-bbc2-a005ef5dc22e"
    },
    "dialerProcessOfCalling": false,
    "phones": [
        "9001234567"
    ]
}
```

**Выражение:**  
```js
debtor["debtorCases"][0]["currentCaseStatus"]["caseStatusKind"]
```

**Результат:**
```
CAME_INTO_FORCE
```