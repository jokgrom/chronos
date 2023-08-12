<?php
class RotateTransform implements ImageTransform
{
  function apply($transformType)
  {
  }

  public function rotate($Imagick, $degrees)
  {
    if ($Imagick->rotateImage("#ffffff50", $degrees)) {
      echo "Изображение повернулось \r\n";
    }
    return $Imagick;
  }
}
