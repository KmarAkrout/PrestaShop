<?php
/**
 * Created by PhpStorm.
 * User: kmar
 * Date: 04/09/18
 * Time: 15:44
 */

namespace PrestaShop\TestBundle\MochaAwesomeReportService;

use Symfony\Component\Finder\Finder;

class MochaAwesomeReport
{

    function getReport()
    {
        chdir("../../..");
        shell_exec('rm -rf TestGenerator/web/assets/mochawesome-report');
        shell_exec("cp -a mochawesome-report TestGenerator/web/assets/mochawesome-report");
    }
}