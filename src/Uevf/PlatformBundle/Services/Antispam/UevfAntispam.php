<?php
namespace Uevf\PlatformBundle\Services\Antispam;

class UevfAntispam{

  public function isSpam($text){
    return strlen($text) <50;
  }
}
