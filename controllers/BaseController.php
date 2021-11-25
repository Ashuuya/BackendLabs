<?php
// класс абстрактный, чтобы нельзя было создать экземпляр
abstract class BaseController {
    // так как все вертится вокруг данных, то заведем функцию,
    // которая будет возвращать контекст с данными
    public function getContext(): array {
        return []; // по умолчанию пустой контекст
    }
    
    // с помощью функции get будет вызывать непосредственно рендеринг
    // так как рендерить необязательно twig шаблоны, а можно, например, всякий json
    // то метод сделаем абстрактным, ну типа кто наследует BaseController
    // тот обязан переопределить этот метод
    abstract public function get();
}