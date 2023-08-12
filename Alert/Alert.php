<?php
class Alert
{
  public function __construct()
  {
    echo "Добро пожаловать в редактор изображений \r\n";
  }


  public function getPathImage() // получить путь к изображению 
  {
    $pathImage = readline("Укажите путь к исходному изображению: \r\n");
    if (!self::_checkPathImage($pathImage)) {
      echo "Файл не найден \r\n";
      self::getPathImage();
    }
    return $pathImage;
  }
  private function _checkPathImage($pathImage) //проверяем наличие файла
  {
    return file_exists($pathImage);
  }


  function getTransformType() // получить тип операции над изображением
  {
    $txt_alert = "Выберите тип операции: \r\n[1]Масштабирование изображения\r\n[2]Поворот изображения\r\n[3]Примененить фильтр к изображению \r\n[0]Сохранить изображение \r\n[-1]Закончить редактирование \r\n";
    $transformType = readline($txt_alert);
    if (!self::_checkTransformType($transformType)) {
      self::getTransformType();
    }
    return $transformType;
  }
  private function _checkTransformType($transformType)
  {
    $array = ["-1", "0", "1", "2", "3"]; //список возможных ответов
    if (in_array($transformType, $array)) {
      return true;
    }
    echo "Тип операции не найден \r\n";
    return false;
  }



  // получить путь к каталогу для сохранения изображения
  function getOutPath()
  {
    $outPath = readline("Укажите путь куда сохранить изображение: \r\n");
    if (!self::_checkPathImage($outPath)) {
      echo "Будет создано новое изображение \r\n";
      // self::getOutPath();
    }
    return $outPath;

    // if (!self::_checkPathImage($outPath)) { //если найден файл или папка
    //   echo "Файл не найден \r\n";
    //   // if (self::_checkOutPathFolder($outPath)) { //если был указан каталог
    //   //   if (substr($outPath, -1) == "\\") {
    //   //     $outPath .= "myNewImage.jpeg \r\n";
    //   //   } else {
    //   //     $outPath .= "\myNewImage.jpeg \r\n";
    //   //   }
    //   // }
    //   return $outPath;
    // }
    // echo "Не корректно указан путь \r\n";
    // self::getOutPath();
  }
  // private function _checkOutPathFolder($pathFolder) //проверяем директорию
  // {
  //   return is_dir($pathFolder);
  // }


  function getScaleTransformType()
  {
    $txt_alert = "Выберите маштабирование: \r\n[1]Масштабирование 1:2\r\n[2]Масштабирование 0.5:1\r\n[3]Указать своё значение \r\n";
    $scaleTransformType = readline($txt_alert);
    if (!self::_checkScaleTransformType($scaleTransformType)) {
      self::getScaleTransformType();
    }
    return $scaleTransformType;
  }
  private function _checkScaleTransformType($scaleTransformType)
  {
    $array = ["1", "2", "3"]; //список возможных ответов
    if (in_array($scaleTransformType, $array)) {
      return true;
    }
    echo "Тип маштабирования не найден \r\n";
    return false;
  }


  function getScaleSize($width, $height)
  {
    $image_sizes = [];
    $txt_alert = "Изображение имеет размер:" . $width . "px на" . $height . "px] \r\n";
    $txt_alert = "Введите нужную Ширину и Высоту в пикселях \r\n";
    $answer = readline($txt_alert);
    if (!empty($answer)) {
      $image_sizes = explode(" ", $answer);
    }
    if (!self::_checkScaleSize($image_sizes)) {
      self::getScaleSize($width, $height);
    } else {
      return array($image_sizes[0], $image_sizes[1]);
    }
  }
  private function _checkScaleSize($image_sizes)
  {
    if (is_array($image_sizes) and count($image_sizes) >= 0 and (int)$image_sizes[0] > 0 and (int)$image_sizes[1] > 0) {
      return true;
    }
    echo "Не корректно указаны размеры изображения \r\n";
    return false;
  }


  function getRotate_degrees()
  {
    $degrees = readline("Укажите угол поворота: \r\n");
    if (!self::_checkRotate($degrees)) {
      self::getRotate_degrees();
    }
    return $degrees;
  }
  function _checkRotate($degrees)
  {
    $degrees = preg_replace('/[^0-9\-]/u', '', $degrees);
    if (is_numeric($degrees)) {
      return true;
    }
    echo "Не корректно указан угол поворота \r\n";
    return false;
  }


  // function getFilterTransformType()
  // {
  //   $txt_alert = "Выберите фильтр: \r\n[1]Масштабирование 1:2\r\n[2]Масштабирование 0.5:1\r\n[3]Указать своё значение";
  //   $scaleTransformType = readline($txt_alert);
  //   if (!self::_checkFilterTransformType($scaleTransformType)) {
  //     self::getFilterTransformType();
  //   }
  //   return $scaleTransformType;
  // }
  // private function _checkFilterTransformType($scaleTransformType)
  // {
  //   $array = ["1", "2", "3"]; //список возможных ответов
  //   if (in_array($scaleTransformType, $array)) {
  //     return true;
  //   }
  //   echo "Тип фильтра не найден.\r\n";
  //   return false;
  // }
}
