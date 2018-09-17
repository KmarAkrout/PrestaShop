<?php

namespace PrestaShop\TestBundle\ExecCommand;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;


class CommandExec
{


    public function ExecComm($cmd, $path)
    {
        chdir($path);
        set_time_limit(400000);
        ob_implicit_flush(true);
        $desc = array(
            0 => array('pipe', 'r'),
            1 => array('pipe', 'w'),
            2 => array('file', 'error-output.txt', 'a')
        );

        $process = proc_open($cmd . ' --color always', $desc, $pipes);
        $s = proc_get_status($process);

        $myfile = fopen("TestGenerator/web/proc_stat.txt", "w") or die("Unable to open file!");
        $execFile = fopen("TestGenerator/web/execution.html", "w") or die("Unable to open file!");
        fwrite($myfile, $s['pid']);

        fclose($myfile);
        $converter = new AnsiToHtmlConverter();
        if (is_resource($process)) {

            while (!feof($pipes[1])) {
                $return_message = fgets($pipes[1], 1024);
                if (strlen($return_message) == 0) break;
                print "<h4 style='font-family: Ubuntu Mono'>" . $converter->convert($return_message) . "</h4>";
                fwrite($execFile,"<h4 style='font-family: Ubuntu Mono'>" . $converter->convert($return_message) . "</h4>" );
                 ob_flush();
                 flush();
             }
        }

        fclose($execFile);
        fclose($pipes[1]);

        proc_close($process);

    }

}
