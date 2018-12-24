<?php
namespace LogSystem;
class LogSystem {
  public function write($message){
    $date = date('Y-m-d');
    $root= realpath($_SERVER["DOCUMENT_ROOT"]);
    $logpath= $root.'/panel/admin/log/';
    $filename = 'log-'.$date.'.log';
    $heure = date('H:i:s');
    $file = fopen($logpath.$filename, "a+");
    if (flock($file, LOCK_EX)) {
      fwrite($file,"\n".$heure." : ".$message);
      flock($file, LOCK_UN);
    } else {
      //print "Could not lock $filename!\n";
    }
  }

  public function remove($date){
    $root= realpath($_SERVER["DOCUMENT_ROOT"]);
    $logpath= $root.'/panel/admin/log/';
    $filename = "log-".$date.".log";
    $filepath = $logpath.$filename;
    if (file_exists($logpath.$filename)){
      unlink($filepath);
    }
    else {
      print "It seems that the file you specified doesn't exist.";
    }
  }

}
?>
