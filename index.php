<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="." method="post">
    <textarea name="JSON" cols="60" rows="45" value="" id="JSON" onchange="CheckJSON()">Вставьте JSON</textarea>
    <textarea name="Expression" cols="60" rows="45">Вставьте Выражение</textarea> 
    <input type="submit" value="Выполнить">
    <h1 id="HideText"></h1>
    

    <?php 
        
        require_once 'vendor/autoload.php';

        use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

            if((isset($_POST["JSON"]) && isset($_POST["Expression"])) && ($_POST["JSON"] != "Вставьте JSON" && $_POST["Expression"] != "Вставьте Выражение"))
            {
                $expressionLanguage = new ExpressionLanguage();

                // Пример JSON-строки с вложениями
                $jsonString = $_POST["JSON"];

                // Распарсить JSON-строку и получить объект данных
                $data = json_decode($jsonString);

                // Создать экземпляр класса ExpressionLanguage Symfony
                $expressionLanguage = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();

                // Определить выражение для вычисления значения с учетом вложенности данных
                $expression = $_POST["Expression"];

                // Вычислить значение
                $result = $expressionLanguage->evaluate($expression, ['debtor' => $data->debtor]);

                // Получить результат вычисления
                echo "<h1>Результат: " . $result . "</h1>";

            }
            else{
                echo "<h1>Ожидется ввод данных!</h1>";
            }
    ?>
</body>
<script>
        
        function CheckJSON() {
            // console.log("Check start")
            var json = document.getElementById("JSON").value;
            var label = document.getElementById("HideText");
            console.log(json);
            if(!isJsonString(json)){
                label.innerHTML = "😕😕😕  Некорректный JSON!";
            }else{
                label.innerHTML = "🙂🙂🙂";
            }
        }

        function isJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }
    </script>
</html>