<?php
namespace Uevf\PlatformBundle\Services\Authentication;

class Authentication{

  public function passwordEncryption($pwd){
    $salt = substr(sha1(date('r')), rand(0,17),22);
    $cost = 10;
    $hash = '$2y$' . $cost . '$' . $salt;
    return crypt($pwd,$hash);
  }

  public function passwordMatching($pwd,$pwdCrypt){
    return ($pwdCrypt == crypt($pwd,$pwdCrypt));
  }
  
}
