<?php
namespace PrestaShop\TestBundle\ExecCommand;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\StreamedResponse;
class CommandExec {

  public function ExecComm($cmd,$path){

    $move_to_project = '/home/kmar/www/PrestaShop/tests/E2E';
    $response = new StreamedResponse();
    $res='';

    //$script='npm test -- --URL=localhost/www/PrestaShop';
    $script='ping -c 5 www.google.fr';
    $process = new Process($script);
    $process->setWorkingDirectory($move_to_project);
    $process->setTimeout(60000000000000);
    $response->setCallback(function() use ($process) {
          $process->run(function ($type, $buffer) {
              if (Process::ERR === $type) {
                  echo 'ERR > '.$buffer;
              } else {
                  echo $buffer;
                  ob_flush();
                  flush();
                  echo '<br>';
              }
          });
      });

      //echo $response;
      $response->setStatusCode(200);
      return $response;

//04_create_order_in_FO
  }
}
