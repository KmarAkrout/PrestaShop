<?php
/**
 * Created by PhpStorm.
 * User: kmar
 * Date: 04/09/18
 * Time: 15:44
 */

namespace PrestaShop\TestBundle\TestResultsService;

use Symfony\Component\Finder\Finder;

class TestResults
{

    function getReport($type, $date)
    {

        if ("mocha" === $type) {
            chdir("../../../E2E");
            shell_exec('rm -rf TestGenerator/web/assets/mochawesome-report');
            shell_exec('npm run concat-files-report');
            shell_exec("cp -a email_sender/test_report.html TestGenerator/web/assets/mochawesome-report");

        } else {
            chdir('../../../E2E');

            shell_exec('rm -rf TestGenerator/web/assets/screenshots');
            chdir('test');
            /*$out = shell_exec("ls");
            return $out;*/
            shell_exec("cp -a screenshots ../TestGenerator/web/assets/screenshots");
            chdir('../TestGenerator/web/assets/screenshots');
            $output = shell_exec('find -newermt ' . '"' . $date . '"');
            //$images = explode("\n", $output);
            return $output;
        }
    }
}