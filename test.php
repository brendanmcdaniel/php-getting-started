<?php
  
$handler = function($signal) {
    
  //echo "Signal captured!!! Commencing graceful shutdown\n";
  file_put_contents("php://stderr",  "Signal captured!!! Commencing graceful shutdown\n");
  
  switch($signal) {
    case SIGTERM:
        
      $cmd = 'pwd';
        
      //echo "SIGTERM IS CAPTURED running command $cmd \n";
      file_put_contents("php://stderr",  "SIGTERM IS CAPTURED running command $cmd \n");
      
      exec($cmd, $output);
      file_put_contents("php://stderr",  "Command executed : \n");
      //echo "Command executed : \n";
      foreach ($output as $lineNo => $line) {
      file_put_contents("php://stderr",  ($lineNo + 1) . ": $line \n");
      //echo ($lineNo + 1) . ": $line \n";
      }
      exit(); //no need to do anything else since system is going down!
      break;
  }
};

pcntl_signal(SIGTERM, $handler);
//echo "Now Listening for SIGTERM signal \n";
file_put_contents("php://stderr",  "Now Listening for SIGTERM signal \n");

//now listen for signals for every 0.25 seconds
while(true){
  usleep(25000);
  pcntl_signal_dispatch();
}

?>