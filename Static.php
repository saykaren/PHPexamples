<?php

class Weather {
    public $tempConditions = ['cold', 'mild', 'warm'];

    public function celsiusToFarenheit($c)
    {
        return $c * 9 / 5 + 32;
    }

    public function determineTempCondition($f)
    {
        switch ($f) {
            case ($f < 40):
                return 'cold';
                break;
            case ($f > 80):
                return 'warm';
                break;
            default:
                return 'mild';
        }
    }

}

$weatherInstance = new Weather();
// print_r($weatherInstance->tempConditions);

$weatherCelsius = $weatherInstance->celsiusToFarenheit(20);
echo "{$weatherCelsius} F \n";

$weatherDetermine = $weatherInstance->determineTempCondition(75);
echo "{$weatherDetermine} weather outside \n";

// class with static methods

class WeatherStatic {
    public static $tempConditions = ['cold', 'mild', 'warm'];

    public static function celsiusToFarenheit($c)
    {
        return $c * 9 / 5 + 32;
    }

    public static function determineTempCondition($f)
    {
        switch ($f) {
            case ($f < 40):
                return 'cold';
                break;
            case ($f > 80):
                return 'warm';
                break;
            default:
                return 'mild';
        }
    }

}
// if static then we can access them directly instead of creating an instance (new Weather()) first
// print_r(WeatherStatic::$tempConditions);
$staticCelsius = WeatherStatic::celsiusToFarenheit(20);
echo "Status method used - {$staticCelsius}  \n";
$staticTemp = WeatherStatic::determineTempCondition(75);
echo "Status method used - {$staticTemp} \n";
?>