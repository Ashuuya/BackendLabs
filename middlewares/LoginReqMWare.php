<?php

class LoginReqMWare extends BaseMIddleware {
    public function apply(BaseController $controller, array $context)
    {
        // заводим переменные под правильный пароль
        $valid_user = "password";
        $valid_password = "user";
        
        // берем значения которые введет пользователь
        $user = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $password = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
        
        // сверяем с корректными
        if ($valid_user != $user || $valid_password != $password) {
            // если не совпали, надо указать такой заголовок
            // именно по нему браузер поймет что надо показать окно для ввода юзера/пароля
            header('WWW-Authenticate: Basic realm="Titles"');
            http_response_code(401); // ну и статус 401 -- Unauthorized, то есть неавторизован
            exit; // прерываем выполнение скрипта
        }
    }
}