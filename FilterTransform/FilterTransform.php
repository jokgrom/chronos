<?php
class FilterTransform implements ImageTransform
{
  function apply($transformType)
  {
  }
  public function blurImage($Imagick)
  {
    if ($Imagick->blurImage(5, 9)) {
      echo "Фильтр применён \r\n";
    }
    return $Imagick;
  }
}
