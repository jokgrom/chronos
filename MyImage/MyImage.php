<?php
class MyImage
{
  public $width, $height, $path, $writePath;
  public function writeImage($Imagick)
  {
    if ($Imagick->writeImage($this->writePath)) {
      echo "Изображение сохранено \r\n";
      echo "Путь файла: " . $this->writePath . " \r\n";
    } else {
      echo "Не удалось сохранить изображение \r\n";
    }
  }
}
