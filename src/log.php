<?php
namespace LogSystem;
class LogSystem {
  private $date = date('Y-m-d');
  private $root = realpath($_SERVER["DOCUMENT_ROOT"]);
  private $logpath = $root.'/panel/admin/log/';
  private $filename = 'log-'.$date.'.log';

  public function write($message){
    $heure = date('H:i');
    $file = fopen($logpath.$filename, "a+");
    if (flock($file, LOCK_EX)) {
      fwrite($file,$message);
      flock($file, LOCK_UN); // unlock the file
    } else {
      // flock() returned false, no lock obtained
      print "Could not lock $filename!\n";
    }
  }


}
?>
