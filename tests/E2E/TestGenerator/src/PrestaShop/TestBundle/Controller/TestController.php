<?php

namespace PrestaShop\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TestController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrestaShopTestBundle:Test:index.html.twig');
    }

    //************** Regular Test **************//
    public function regularAction()
    {
        chdir('../../test/campaigns/regular');
        return $this->render('PrestaShopTestBundle:Test:regular.html.twig');
    }

    //************** Install upgrade Test **************//
    public function installAction()
    {
        chdir('../../test/campaigns/install_upgrade');
        return $this->render('PrestaShopTestBundle:Test:install.html.twig');
    }

    //************** High Test **************//
    public function highAction()
    {
        chdir('../../test/campaigns/high');
        return $this->render('PrestaShopTestBundle:Test:high.html.twig');
    }

    //************** Full Test **************//
    public function fullAction()
    {
        chdir('../../test/campaigns/full');
        return $this->render('PrestaShopTestBundle:Test:full.html.twig');
    }

    //************** Display Execution of Test *********/
    public function displayAction()
    {
        return $this->render('PrestaShopTestBundle:Test:displayExec.html.twig');
    }

    //************** Launch Tests **************//
    public function launchTestAction(Request $request)
    {
        $testType = $request->get("testType");
        $folder = $request->get('folder');
        $file = $request->get('file');
        $params = $request->query->all();
        $param = $this->get("prestaShop_test.ManageParams")->ManageParam($params);
        $cmd = '';
        $test = '';
        for ($j = 1; $j < count($param) - 1; $j++) {
            if ($param[$j] != "") {

                $test = $test . $param[$j];

            }
        }
        switch ($testType) {
            case "full":
                $cmd = "npm run full-test --";
                break;
            case "fullSpec":
                $cmd = "path=full/" . $folder . $file . "npm run specific-test --";
                break;
            case "high":
                $cmd = "npm run high-test --";
                break;
            case "highSpec":
                $cmd = "path=high/" . $folder . $file . "npm run specific-test --";
                break;
            case "regularSpec":
                $cmd = "path=regular/" . $folder . $file . " npm run specific-test --";
                if ($test == "") {
                    $cmd = "path=regular/" . $folder . $file . " npm run specific-test";
                }
                break;
            case "regular":
                $cmd = "npm test --";
                if ($test == "") {
                    $cmd = "npm test";
                }
                break;
            case "install":
                $cmd = "npm run install-upgrade-test --";
                break;
            case "installSpec":
                $cmd = "path=install_upgrade/" . $folder . $file . "npm run specific-test --";
                break;
        }
        for ($i = 1; $i < count($param); $i++) {
            $cmd = $cmd . $param[$i];

        }
        return new Response($this->get("prestaShop_test.execcommand")->ExecComm($cmd, '../..'));

    }
/* To Do
 * Here is the method that is used to stop the running test
 * when i start the test in the execCommand service i save the pid of the launched process to a file
 * i noticed that when a test is launched there is 2 processes running, the one i saved its PID and another one.
 * generally the other one is my saved Pid+1
 * sometimes it's my saved pid +2
 * i'm treating the 2 cases when it's +1 and when it's +2 (it's absurd)
 * for killing the chromeDriver process (which keeps opening chrome windows even after the test is killed) i'm using the process's name "pkill 2.40-x64-chrom"
 * when the version 2.40 is upgraded the name may change and this will cause problems.
 * PS:i'm using the name because selenium is running chromeDriver on a different port each time, so basically i have nothing to use to kill it but its name*/
    public function killAction()
    {

        $myfile = fopen("../../TestGenerator/web/proc_stat.txt", "r") or die("Unable to open file!");
        $pid = trim(fgets($myfile));
        $pluso = intval($pid) + 1;
        $plust = intval($pid) + 2;
        $out1 = shell_exec("ps " . $pluso);
        $out2 = shell_exec("ps " . $plust);
        if (strpos($out1, "\n") !== false) {
            posix_kill(intval($pid) + 1, SIGKILL);
        }
        if (strpos($out2, "\n") !== false) {
            posix_kill(intval($pid) + 2, SIGKILL);
        }
        fclose($myfile);
        shell_exec('pkill 2.40-x64-chrom');
        return new Response("");
    }

    public function getFilesAction(Request $request)
    {
        $path = trim($request->get('selected'));
        return new Response ($this->get("prestaShop_test.ManageFiles")->getFiles($path));
    }

    public function getScreenShotAction(Request $request)
    {
        return new Response ($this->get("prestaShop_test.TestResults")->getReport("screenshot", $request->get('date')));

    }

    public function getReportsAction()
    {
        return new Response ($this->get("prestaShop_test.TestResults")->getReport("mocha", ""));

    }
}
