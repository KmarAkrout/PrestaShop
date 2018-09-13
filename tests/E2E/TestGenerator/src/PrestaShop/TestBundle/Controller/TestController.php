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
        //return new Response($cmd);
    }

    public function killAction(Request $req)
    {
        //$testType = $req->get('testType');
        $myfile = fopen("../../TestGenerator/web/proc_stat.txt", "r") or die("Unable to open file!");
        $pid = trim(fgets($myfile));
        //posix_kill($pid, SIGKILL);
        posix_kill(intval($pid) + 2, SIGKILL);
        /*switch ($testType) {
            case "regular" ||"high" || "install" || "full":posix_kill(intval($pid) + 1, SIGKILL);break;
            default : posix_kill(intval($pid) + 2, SIGKILL);

        }*/
        shell_exec('pkill 2.40-x64-chrom');
        fclose($myfile);
        return new Response(" ");

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
        return new Response ($this->get("prestaShop_test.TestResults")->getReport("mocha",""));

    }
}
