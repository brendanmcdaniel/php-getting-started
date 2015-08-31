<?php

$handler = function($signal) {
  echo "\nSignal captured!!! Commencing graceful shutdown\n";
  switch($signal) {
    case SIGTERM:
      $cmd = 'pwd';
      echo "SIGTERM IS CAPTURED running command $cmd \n";
      exec($cmd, $output);
      echo "Command executed : \n";
      foreach ($output as $lineNo => $line) {
        echo ($lineNo + 1) . ": $line \n";
      }
      exit(); //no need to do anything else since system is going down!
      break;
  }
};

pcntl_signal(SIGTERM, $handler);

//now listen for signals for every 0.25 seconds
while(true){
  usleep(25000);
  pcntl_signal_dispatch();
}

?>