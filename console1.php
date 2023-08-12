<?php
header('Content-type: image/jpeg');

if (!empty($_SERVER[REMOTE_ADDR])) { //Ограничение доступа(доступно через консоль)
  die('Доступ закрыт! Откройте файл через консоль.');
}

require_once('MyImage/MyImage.php');
require_once('ImageTransform/ImageTransform.php');
require_once('FilterTransform/FilterTransform.php');
require_once('RotateTransform/RotateTransform.php');
require_once('ScaleTransform/ScaleTransform.php');
require_once('Alert/Alert.php');

$Alert = new Alert();
$MyImage = new MyImage();
$MyImage->path = $Alert->getPathImage();

$Imagick = new Imagick($MyImage->path);
$FilterTransform = new FilterTransform();
$RotateTransform = new RotateTransform();
$ScaleTransform = new ScaleTransform();



$booleanInfinity = true;
$step = 0;
try {
  while ($booleanInfinity) {
    $transformType = $Alert->getTransformType();
    switch ($transformType) {
      case "1": //Масштабирование изображения
        $scaleTransformType = $Alert->getScaleTransformType();
        $MyImage->width = $Imagick->getImageWidth();
        $MyImage->height = $Imagick->getImageHeight();
        switch ($scaleTransformType) {
          case "1": //Масштабирование 1:2
            $Imagick = $ScaleTransform->scale_1x2($Imagick, $MyImage->width, $MyImage->height);
            break;
          case "2": //Масштабирование 0.5:1
            $Imagick = $ScaleTransform->scale_05x1($Imagick, $MyImage->width, $MyImage->height);
            break;
          case "3": //Указать своё значение
            list($newWidth, $newHeight) = $Alert->getScaleSize($MyImage->width, $MyImage->height);
            $Imagick = $ScaleTransform->scale_wh($Imagick, $newWidth, $newHeight);
            break;
        }
        break;
      case "2": //Поворот изображения
        $degrees = $Alert->getRotate_degrees();
        $Imagick = $RotateTransform->rotate($Imagick, $degrees);
        break;
      case "3": //Примененить фильтр к изображению
        $Imagick = $FilterTransform->blurImage($Imagick);
        break;
      case "0": //Сохранить изображение
        $MyImage->writePath = $Alert->getOutPath();
        $MyImage->writeImage($Imagick);
        break;
      case "-1": //Закончить редактирование
        $booleanInfinity = false;
        break 2;
      default:
        $booleanInfinity = false;
    }

    if ($step >= 9) {
      throw new Exception("превышено число возможных операций");
    }
    $step++;
  }
} catch (Exception $e) {
  echo "Ошибка выполнения программы: " . $e->getMessage() . "\r\n";
}

echo "===THE END===";
