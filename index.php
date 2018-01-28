<?php
$listCity = json_decode(file_get_contents("city.list.json"), true);

$url = "";
$data = null;

$tempMin = null;
$tempMax = null;
$cityName = null;

if ($_POST) {
    $SelectedCityId = $_POST["city"];
    $url = "http://api.openweathermap.org/data/2.5/weather?id=" . $SelectedCityId . "&lang=en&units=metric&APPID=5be588c10cf54d3c45f60e48c226d700";
    $data = file_get_contents($url);
    if ($data != null) {
        $dataJson = json_decode($data, true);
        $temp = $dataJson["main"];

        $tempMin = $temp["temp_min"];
        $tempMax = $temp["temp_max"];
        $cityName = $dataJson["name"];
    } else {
        echo "Not Found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>WaterMap</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3" style="border-right: 2px solid black; height: 40em;">
            <form class="col-md-12" method="post">
                <select class="col-md-10" name="city">
                    <?php for ($item = 0; $item < 20; $item++) : ?>
                        <?php $tmp = $listCity[$item]; ?>
                        <option value="<?php echo $tmp["id"]; ?>">
                            <?php echo $tmp["name"]; ?>
                        </option>
                    <?php endfor; ?>
                </select>
                <input class="col-md-6 btn btn-default" type="submit" value="OK"/>
            </form>
        </div>
        <div class="col-md-8">
            <div class="row">
                <?php if (!is_null($tempMax)) : ?>
                    <h5 class="col-md-6">Температура максимальная :</h5>
                    <h5 class="col-md-2"><?php echo $tempMax; ?></h5>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php if (!is_null($tempMin)) : ?>
                    <h5 class="col-md-6">Температура минимальная :</h5>
                    <h5 class="col-md-2"><?php echo $tempMin; ?></h5>
                <?php endif; ?>
            </div>
            <div class="row">
                <?php if (!is_null($cityName)) : ?>
                    <h5 class="col-md-4">Город :</h5>
                    <h5 class="col-md-7"><?php echo $cityName; ?></h5>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>


