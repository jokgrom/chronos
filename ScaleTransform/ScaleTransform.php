<?php
class ScaleTransform implements ImageTransform
{

  function apply($transformType)
  {
  }

  public function scale_1x2($Imagick, $width, $height)
  {
    $width = (int)$width * 2;
    $height = (int)$height * 2;
    if ($Imagick->scaleImage($width, $height, true)) {
      echo "Изображение увеличено \r\n";
    }
    return $Imagick;
  }


  public function scale_05x1($Imagick, $width, $height)
  {
    $width = (int)$width / 2;
    $height = (int)$height / 2;
    if ($Imagick->scaleImage($width, $height, true)) {
      echo "Изображение уменьшено \r\n";
    }
    return $Imagick;
  }

  public function scale_wh($Imagick, $width, $height)
  {
    if ($Imagick->scaleImage($width, $height, false)) {
      echo "Размер изображения изменён \r\n";
    }
    return $Imagick;
  }
}
