<?php
// Использование Web-сервиса
// "Currency Exchange Rate" от xmethods.com

// Создание SOAP-клиента по WSDL-документу
//$client = new SoapClient("http://speller.yandex.net/services/spellservice?WSDL");

$client = new SoapClient("yandex.wsdl");

// Поcылка SOAP-запроса и получение результата
$result = $client->checkTexts('мошина');

echo 'Текущий курс доллара: ', $result, ' рублей';
var_dump
    
?>