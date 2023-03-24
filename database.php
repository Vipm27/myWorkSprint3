<?php
$db = new PDO('mysql:host=localhost;dbname=bd_project_startup', 'root', 'qwerty123');
$dataRecommend = $db->query("SELECT * FROM recommendation")->fetchAll(PDO::FETCH_ASSOC);
$dataData = $db->query("SELECT * FROM data ")->fetchAll(PDO::FETCH_ASSOC);
$dataModule = $db->query("SELECT * FROM module ")->fetchAll(PDO::FETCH_ASSOC);

for( $i=0; $i < count($dataModule); $i++){

    $idModule = $dataModule[$i]["id"];
    $temperatureNow = 0;
    $humidityNow = 0;
    $illuminationNow = 0;

    foreach ($dataData as $k){
        if($k['module_id'] == $idModule)
        {
            $temperatureNow = $k['temperature'];
            $humidityNow = $k['humidity'];
            $illuminationNow = $k['illumination'];
            $dateOrg = $k['measurements_date'];
        }
    }
    $temperatureMax = $dataRecommend[$idModule]['temperature_max'];
    $temperatureMin = $dataRecommend[$idModule]['temperature_min'];
    $humidityMax = $dataRecommend[$idModule]['humidity_max'];
    $humidityMin = $dataRecommend[$idModule]['humidity_min'];
    $illuminationMax = $dataRecommend[$idModule]['illumination_max'];
    $illuminationMin = $dataRecommend[$idModule]['illumination_min'];

    if($dataRecommend[$idModule]['temperature_max'] < $temperatureNow)
    {
        echo "У Вашего горшка под номером $idModule проблема с температурой, она слишком большая, охладите растение (рекомендауемая температура $temperatureMin - $temperatureMax, текущая температура $temperatureNow). $dateOrg <br>";
    }

    if($temperatureNow < $dataRecommend[$idModule]['temperature_min'])
    {
        echo "У Вашего горшка под номером $idModule проблема с температурой, она слишком маленькая, поставьте его в теплое место (рекомендауемая температура $temperatureMin - $temperatureMax, текущая температура $temperatureNow). $dateOrg <br>";
    }

    if($dataRecommend[$idModule]['humidity_max'] < $humidityNow )
    {
        echo "У Вашего горшка под номером $idModule проблемы с влажность,она слишком высокая, пока не поливайте растение (рекомендуемая влажность $humidityMin - $humidityMax, текущая влажность $humidityNow). $dateOrg <br>";
    }

    if($humidityNow < $dataRecommend[$idModule]['humidity_min'])
    {
        echo "У Вашего горшка под номером $idModule проблемы с влажность,она слишком маленькая, ПОЛЕЙТЕ РАСТЕНИЕ! (рекомендуемая влажность $humidityMin - $humidityMax, текущая влажность $humidityNow). $dateOrg  <br>";
    }

    if($dataRecommend[$idModule]['illumination_max'] < $illuminationNow)
    {
        echo "У Вашего горшка под номером $idModule проблемы с освещенностью, она слишком высокая, поставьте растение в тенек (рекомендуемая освещенность $illuminationMin - $illuminationMax, текущая освещенность $illuminationNow). $dateOrg  <br>";
    }

    if($illuminationNow < $dataRecommend[$idModule]['illumination_min'])
    {
        echo "У Вашего горшка под номером $idModule проблемы с освещенностью, она слишком маленькая, поставьте растение на солнце. (рекомендуемая освещенность $illuminationMin - $illuminationMax, текущая освещенность $illuminationNow). $dateOrg  <br>";
    }
}

