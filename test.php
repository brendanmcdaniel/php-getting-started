<?php
$tmp = '';

$handler = function($signal) use($tmp){
  echo "\n signal captured!!! Commencing graceful shutdown\n";
  switch($signal) {
    case SIGTERM:
      $cmd = 'pwd';
      echo "SIGTERM IS CAPTURED running command $cmd \n";
      exec($cmd, $output);
      echo "Command executed : \n";
      foreach ($output as $lineNo => $line) {
        echo ($lineNo + 1) . ": $line \n";
      }
      exit(); //no need to do anything else since system is exited
      break;
  }
};

pcntl_signal(SIGTERM, $handler);

//now listen for signals for every 0.25 seconds and then sleep
while(true){
  usleep(25000);
  echo "checking in";
  pcntl_signal_dispatch();
}

?>