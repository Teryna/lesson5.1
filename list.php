<?php
require __DIR__ . '/vendor/autoload.php';

$api = new \Yandex\Geo\Api();

// Можно искать по точке
//$api->setPoint(21.720527, 57.181734 );
if (!empty($_POST['address'])) {
// Или можно икать по адресу
    $address = strip_tags($_POST['address']);
    $api->setQuery("$address");

// Настройка фильтров
    $api
    ->setLimit(15) // кол-во результатов
    ->setLang(\Yandex\Geo\Api::LANG_RU) // локаль ответа
    ->load();

    $response = $api->getResponse();
    $response->getFoundCount(); // кол-во найденных адресов
    $response->getQuery(); // исходный запрос
    $response->getLatitude(); // широта для исходного запроса
    $response->getLongitude(); // долгота для исходного запроса

// Список найденных точек
    $collection = $response->getList();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Список найденых адресов</title>
</head>
<body>
<div>
    <table>
        <thead>
            <tr>
                <th>Адрес</th>
                <th>Широта</th>
                <th>Долгота</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($collection)) :
                foreach ($collection as $item) : ?>
            <tr>
                <td><a href="map.php?lat=<?=$item->getLatitude()?>
            &lon=<?=$item->getLongitude()?>
            &address=<?=$address?>"><?=$item->getAddress()?></a></td>
                <td><?=$item->getLatitude()?></td>
                <td><?=$item->getLongitude()?></td>
            </tr>
            <?php endforeach; ?>
             
            <?php else : ?>
                <h3>Вы не ввели данные</h3><a href="index.php"><br>Вернуться на главную</a>              
            <?php endif;
             //var_dump ($item);
            ?>                    
        </tbody>
    </table>
</div>
</body>
</html>