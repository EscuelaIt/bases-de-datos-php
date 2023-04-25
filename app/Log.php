<?php
namespace App;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log  {

  private static $logChanel;

  private static function getLog() {
    if(! self::$logChanel) {
      // create a log channel
      self::$logChanel = new Logger('default');
      self::$logChanel->pushHandler(new StreamHandler('../logs/app.log', Level::Warning));
    }
    return self::$logChanel;
  }

  public static function log($text) {
    $log = self::getLog();
    $log->warning($text);
  }
}
