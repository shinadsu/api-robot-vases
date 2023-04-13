<?php

// Установить URL API Центробанка
$url = 'http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=';

// Получить текущую дату и дату 90 дней назад
$today = date('d/m/Y');
$startDate = date('d/m/Y', strtotime('-90 days'));

// Составить URL-адрес для получения данных за последние 90 дней
$url .= $startDate . '&date_req2=' . $today;

// Загрузить данные из URL-адреса
$xml = simplexml_load_file($url);


// Инициализировать переменные для хранения максимального и минимального значений курса
$maxRate = 0;
$maxRateName = '';
$maxRateDate = '';
$minRate = PHP_INT_MAX;
$minRateName = '';
$minRateDate = '';
$totalRate = 0;
$numRates = 0;

// Перебрать все элементы <Valute>
foreach ($xml->Valute as $valute) {
    // Получить значения курса, названия и даты для текущей валюты
    $rate = (float) str_replace(',', '.', $valute->Value);
    $name = (string) $valute->Name;
    $date = (string) $xml['Date'];

    // Обновить максимальное значение, если текущее значение больше текущего максимума
    if ($rate > $maxRate) {
        $maxRate = $rate;
        $maxRateName = $name;
        $maxRateDate = $date;
    }

    // Обновить минимальное значение, если текущее значение меньше текущего минимума
    if ($rate < $minRate) {
        $minRate = $rate;
        $minRateName = $name;
        $minRateDate = $date;
    }

    // Добавить значение курса в общую сумму для вычисления среднего значения
    $totalRate += $rate;
    $numRates++;
}

// Вычислить среднее значение курса
$avgRate = $totalRate / $numRates;

// Вывести результаты
echo "Максимальный курс валюты: $maxRateName ($maxRate) на дату $maxRateDate\n";
echo "Минимальный курс валюты: $minRateName ($minRate) на дату $minRateDate\n";
echo "Средний курс рубля за весь период: $avgRate\n";
