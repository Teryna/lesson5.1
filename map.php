<?php
if (!empty($_GET['lat']) && !empty($_GET['lon']) && !empty($_GET['address'])) {
$latitude = $_GET['lat'];
$longitude = $_GET['lon'];
$address = $_GET['address'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <title>Расположение на карте</title>
</head>
<body>
<p class="map"><a href="index.php">Вернуться к поиску</a></p>
<div id="map" style="width: 750px; height: 500px"></div>
<script type="text/javascript">
    ymaps.ready(init);
    function init(){  
        var myMap = new ymaps.Map("map", {
            center: [<?=$latitude?>, <?=$longitude?>],
            zoom: 8
        });
        
        var myPlacemark = new ymaps.Placemark(
            [<?=$latitude?>, <?=$longitude?>], {
                hintContent: 'Запрашиваемый адрес',
                balloonContent: '<?php echo $address; ?>'
        });
        
    myMap.geoObjects.add(myPlacemark);
    }
</script>   
</body>
</html>