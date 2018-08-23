<?php

namespace PrestaShop\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Process\Process;

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

        $output = shell_exec('ls');
        //echo $output;
        $list = explode("\n", $output);
        $out = '';
        for ($i = 0; $i < count($list); $i++) {
            $out = $out . shell_exec('ls -R' . $list[$i]);
            //echo $out.'<br>';
        }
        $list1 = explode("./", $out);
        //echo $list1[1];
        $res = [];

        foreach ($list1 as $x) {
            $res[substr($x, 0, 3)][] = $x;
        }

        foreach ($res as &$x) {
            $x = implode('***', (array)$x);
        }
        return $this->render('PrestaShopTestBundle:Test:regular.html.twig', array(
            'list' => $list,
            'list1' => $res,
        ));
        //return new Response("response");

    }

    //************** Install upgrade Test **************//
    public function installAction()
    {
        chdir('../../test/campaigns/install_upgrade');

        $output = shell_exec('ls');
        //echo $output;
        $list = explode("\n", $output);
        $out = '';
        for ($i = 0; $i < count($list); $i++) {
            $out = $out . shell_exec('ls -R' . $list[$i]);
            //echo $out.'<br>';
        }
        $list1 = explode("./", $out);
        //echo $list1[1];
        $res = [];

        foreach ($list1 as $x) {
            $res[substr($x, 0, 3)][] = $x;
        }

        foreach ($res as &$x) {
            $x = implode('***', (array)$x);
        }
        return $this->render('PrestaShopTestBundle:Test:install.html.twig', array(
            'list' => $list,
            'list1' => $res,
        ));
        //return new Response("response");
    }

    //************** High Test **************//
    public function highAction()
    {
        chdir('../../test/campaigns/high');

        $output = shell_exec('ls');
        //echo $output;
        $list = explode("\n", $output);
        $out = '';
        for ($i = 0; $i < count($list); $i++) {
            $out = $out . shell_exec('ls -R' . $list[$i]);

        }
        $list1 = explode("./", $out);
        $res = [];

        foreach ($list1 as $x) {
            $res[substr($x, 0, 3)][] = $x;
        }

        foreach ($res as &$x) {
            $x = implode('***', (array)$x);
        }
        return $this->render('PrestaShopTestBundle:Test:high.html.twig', array(
            'list' => $list,
            'list1' => $res,
        ));

    }

    //************** Full Test **************//
    public function fullAction()
    {
        chdir('../../test/campaigns/full');

        $output = shell_exec('ls');
        $list = explode("\n", $output);
        $out = '';

        for ($i = 0; $i < count($list); $i++) {
            $out = $out . shell_exec('ls -R' . $list[$i]);
        }
        $list1 = explode("./", $out);
        $res = [];

        foreach ($list1 as $x) {
            $res[substr($x, 0, 3)][] = $x;
        }

        foreach ($res as &$x) {
            $x = implode('***', (array)$x);
        }

        //print_r($res);

        return $this->render('PrestaShopTestBundle:Test:full.html.twig', array(
            'list' => $list,
            'list1' => $res,
        ));
    }

    //********* mocha reports *********/////
    public function mochaAction()
    {
        chdir('../..');
        shell_exec('rm -rf ../TestGenerator/web/assets/mochawesome-report');
        shell_exec("cp -a mochawesome-report ../TestGenerator/web/assets/mochawesome-report");
        chdir('TestGenerator/web/assets/mochawesome-report');
        $output = shell_exec('ls');
        $res = explode("\n", $output);
        $html = 'assets/mochawesome-report/' . $res[1];
        $json = 'assets/mochawesome-report/' . $res[2];

        //return new Response($res[1]);
        return $this->render('PrestaShopTestBundle:Test:mocha.html.twig', array(
            'html' => $html,
            'json' => $json,
        ));
    }

    //********* ScreenShots ************/
    public function screenShotAction()
    {
        chdir('../../test');

        shell_exec('rm -rf ../../TestGenerator/web/assets/screenshots');
        shell_exec("cp -a screenshots ../TestGenerator/web/assets/screenshots");
        chdir('../TestGenerator/web/assets/screenshots');
        $chemin = 'assets/screenshots';
        $output = shell_exec('ls');
        $res = explode("\n", $output);
        //return new Response($output);
        return $this->render('PrestaShopTestBundle:Test:screenShot.html.twig', array(
            'chemin' => $chemin,
            'list' => $res,
        ));
    }

    //************** Execution du Regular Test En direct *********/
    public function affExecRegAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execReg.html.twig');
    }

    //************** Execution du Regular Test specifique En direct *********/
    public function affExecRegSpecAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execSpecReg.html.twig');
    }

    //************** Execution du High Test En direct *********/
    public function affExecHighAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execHigh.html.twig');
    }

    //************** Execution du High Test specifique En direct *********/
    public function affExecSpecHighAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execSpecHigh.html.twig');
    }

    //************** Execution du Full Test En direct *********/
    public function affExecFullAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execFull.html.twig');
    }

    //************** Execution du Full Test specifique En direct *********/
    public function affExecSpecFullAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execSpecFull.html.twig');
    }

    //************** Execution du install Test En direct *********/
    public function affExecInstallAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execInstall.html.twig');
    }

    //************** Execution du install Test specifique En direct *********/
    public function affExecSpecInstallAction()
    {
        return $this->render('PrestaShopTestBundle:Test:execSpecInstall.html.twig');
    }

    //************** Executer une commande **************//

    public function exeAction(Request $req)
    {
        // Récuperation des agruments
        if ($req->get('url') != null) {
            $url = '--URL=' . $req->get('url');
        } else {
            $url = '';
        }
        ///////////////////////////
        if ($req->get('module') != null) {
            $module = ' --MODULE=' . $req->get('module');
        } else {
            $module = '';
        }
        ///////////////////////////
        if ($req->get('install') != null) {
            $install = ' --INSTALL=' . $req->get('install');
        } else {
            $install = '';
        }
        /////////////////////////////
        if ($req->get('testAddons') != null) {
            $testAddons = ' --TEST_ADDONS=' . $req->get('testAddons');
        } else {
            $testAddons = '';
        }
        ///////////////////////////
        if ($req->get('language') != null) {
            $language = ' --LANGUAGE=' . $req->get('language');
        } else {
            $language = '';
        }
        ///////////////////////////
        if ($req->get('country') != null) {
            $country = ' --COUNTRY=' . $req->get('country');
        } else {
            $country = '';
        }
        /////////////////////////////
        if ($req->get('dbServer') != null) {
            $dbServer = ' --DB_SERVER=' . $req->get('dbServer');
        } else {
            $dbServer = '';
        }
        ///////////////////////////
        if ($req->get('dbUser') != null) {
            $dbUser = ' --DB_USER=' . $req->get('dbUser');
        } else {
            $dbUser = '';
        }
        ///////////////////////////
        if ($req->get('dbPwd') != null) {
            $dbPwd = ' --DB_PASSWD=' . $req->get('dbPwd');
        } else {
            $dbPwd = '';
        }
        /////////////////////////////
        if ($req->get('dbEmPwd') != null) {
            $dbEmPwd = '--DB_EMPTY_PASSWD=' . $req->get('dbEmPwd');
        } else {
            $dbEmPwd = '';
        }
        $kill = $req->get('kill');
        ///////////////////////////
        // construction de la CommandExec
        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        $res = '';

        $cmd = 'npm test -- ' . $url . $module . $install . $testAddons . $language . $country . $dbServer . $dbUser . $dbPwd . $dbEmPwd;
        //$cmd='ping -c 20 www.google.fr';

        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        //$process->setTty(true);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;

                } else {
                    echo $buffer;
                    //$res=$res.$buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });

        });

        $pid = $process->getPid();

        $response->setStatusCode(200);
        return $response;
        // return $this->render('AKTestBundle:Test:specific.html.twig', array('res' => $response));

        //return new Response($cmd);

    }

    public function execRegSpecAction(Request $req)
    {
        // Récuperation des agruments
        if ($req->get('url1') != null) {
            $url = ' --URL=' . $req->get('url1');
        } else {
            $url = '';
        }
        ///////////////////////////
        if ($req->get('module1') != null) {
            $module = ' --MODULE=' . $req->get('module1');
        } else {
            $module = '';
        }
        ///////////////////////////
        if ($req->get('install1') != null) {
            $install = ' --INSTALL=' . $req->get('install1');
        } else {
            $install = '';
        }
        /////////////////////////////
        if ($req->get('testAddons1') != null) {
            $testAddons = ' --TEST_ADDONS=' . $req->get('testAddons1');
        } else {
            $testAddons = '';
        }
        ///////////////////////////
        if ($req->get('language1') != null) {
            $language = ' --LANGUAGE=' . $req->get('language1');
        } else {
            $language = '';
        }
        ///////////////////////////
        if ($req->get('country1') != null) {
            $country = ' --COUNTRY=' . $req->get('country1');
        } else {
            $country = '';
        }
        /////////////////////////////
        if ($req->get('dbServer1') != null) {
            $dbServer = ' --DB_SERVER=' . $req->get('dbServer1');
        } else {
            $dbServer = '';
        }
        ///////////////////////////
        if ($req->get('dbUser1') != null) {
            $dbUser = ' --DB_USER=' . $req->get('dbUser1');
        } else {
            $dbUser = '';
        }
        ///////////////////////////
        if ($req->get('dbPwd1') != null) {
            $dbPwd = ' --DB_PASSWD=' . $req->get('dbPwd1');
        } else {
            $dbPwd = '';
        }
        /////////////////////////////
        if ($req->get('dbEmptyPwd1') != null) {
            $dbEmPwd = ' --DB_EMPTY_PASSWD=' . $req->get('dbEmptyPwd1');
        } else {
            $dbEmPwd = '';
        }
        $path = $req->get('path');

        if ($url == '' && $module == '' && $install == '' && $testAddons == '' && $language == '' && $country == '' && $dbServer == '' && $dbUser == '' && $dbPwd == '' && $dbEmPwd == '') {
            $cmd = "path=regular/" . $path . " npm run specific-test";

        } else {
            $cmd = "path=regular/" . $path . " npm run specific-test --" . $url . $module . $install . $testAddons . $language . $country . $dbServer . $dbUser . $dbPwd . $dbEmPwd;

        }
        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        //$cmd='ping -c 5 www.google.fr';
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);

    }

    public function execHighAction(Request $req)
    {
        if ($req->get('url') != null) {
            $url = ' --URL=' . $req->get('url');
        } else {
            $url = '';
        }
        ///////////////////////////
        if ($req->get('module') != null) {
            $module = ' --MODULE=' . $req->get('module');
        } else {
            $module = '';
        }
        $dir = $req->get('dir');
        $cmd = 'npm run high-test --' . $url . ' --DIR=' . $dir . $module;

        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        //$cmd='ping -c 5 www.google.fr';
        //$cmd='ls';
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);
    }

    public function execHighSpecAction(Request $req)
    {
        if ($req->get('url') != null) {
            $url = ' --URL=' . $req->get('url');
        } else {
            $url = '';
        }
        $path = $req->get('path');
        if ($req->get('file') != null) {
            $file = '/' . $req->get('file');
        } else {
            $file = '';
        }
        $dir = $req->get('dir');
        if ($req->get('module') != null) {
            $module = '--MODULE=' . $req->get('module');
        } else {
            $module = '';
        }

        $cmd = 'path=high/' . $path . $file . ' npm run specific-test --' . $url . ' --DIR=' . $dir . $module;

        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);
    }

    public function execFullAction(Request $req)
    {
        if ($req->get('url') != null) {
            $url = ' --URL=' . $req->get('url');
        } else {
            $url = '';
        }
        ///////////////////////////
        if ($req->get('module') != null) {
            $module = ' --MODULE=' . $req->get('module');
        } else {
            $module = '';
        }
        $dir = $req->get('dir');
        $cmd = 'npm run full-test --' . $url . ' --DIR=' . $dir . $module;
        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        //$cmd='ping -c 5 www.google.fr';
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);
    }

    public function execFullSpecAction(Request $req)
    {
        if ($req->get('url') != null) {
            $url = ' --URL=' . $req->get('url');
        } else {
            $url = '';
        }
        if ($req->get('module') != null) {
            $module = ' --MODULE=' . $req->get('module');
        } else {
            $module = '';
        }

        $path = $req->get('path');
        if ($req->get('file') != null) {
            $file = '/' . $req->get('file');
        } else {
            $file = '';
        }
        $dir = $req->get('dir');

        $cmd = 'path=full/' . $path . $file . ' npm run specific-test -- --DIR=' . $dir . $url . $module;

        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        //$cmd='ping -c 5 www.google.fr';
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return new Response($cmd);
    }

    public function execInstallAction(Request $req)
    {

        ///////////////////////////
        if ($req->get('headless') == 'on') {
            $headless = ' --HEADLESS=true';
        } else {
            $headless = '';
        }
        $dir = ' --DIR=' . $req->get('dir');
        $last = ' --URLLASTSTABLEVERSION=' . $req->get('last');
        $target = ' --RCTARGET=' . $req->get('target');
        if ($req->get('link') != null) {
            $link = ' --RCLINK=' . $req->get('link');
        } else {
            $link = '';
        }
        if ($req->get('url') != null) {
            $url = ' --URL=' . $req->get('url');
        } else {
            $url = '';
        }
        if ($req->get('language') != null) {
            $language = ' --LANGUAGE=' . $req->get('language');
        } else {
            $language = '';
        }
        if ($req->get('country') != null) {
            $country = ' --COUNTRY=' . $req->get('country');
        } else {
            $country = '';
        }
        if ($req->get('dbServer') != null) {
            $dbServer = ' --DB_SERVER=' . $req->get('dbServer');
        } else {
            $dbServer = '';
        }
        if ($req->get('dbUser') != null) {
            $dbUser = ' --DB_USER=' . $req->get('dbUser');
        } else {
            $dbUser = '';
        }
        if ($req->get('dbPwd') != null) {
            $dbPwd = ' --DB_PASSWORD=' . $req->get('dbPwd');
        } else {
            $dbPwd = '';
        }
        if ($req->get('dbEPwd') != null) {
            $dbEPwd = ' --DB_EMPTY_PASSWORD=' . $req->get('dbEPwd');
        } else {
            $dbEPwd = '';
        }
        if ($req->get('fileName') != null) {
            $fileName = ' --FILENAME' . $req->get('fileName');
        } else {
            $fileName = '';
        }

        $cmd = 'npm run install-upgrade-test --' . $dir . $last . $target . $link . $url . $language . $country . $dbServer . $dbUser . $dbPwd . $dbEPwd . $fileName . $headless;
        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);
    }

    public function execSpecInstallAction(Request $req)
    {

        ///////////////////////////
        if ($req->get('headless1') == 'on') {
            $headless1 = ' --HEADLESS=true';
        } else {
            $headless1 = '';
        }
        $dir1 = ' --DIR=' . $req->get('dir1');
        $path1 = $req->get('path1');
        if ($req->get('file1') != null) {
            $file1 = '/' . $req->get('file1');
        } else {
            $file1 = '';
        }
        $last1 = ' --URLLASTSTABLEVERSION=' . $req->get('last1');
        $target1 = ' --RCTARGET=' . $req->get('target1');
        if ($req->get('link1') != null) {
            $link1 = ' --RCLINK=' . $req->get('link1');
        } else {
            $link1 = '';
        }
        if ($req->get('url1') != null) {
            $url1 = ' --URL=' . $req->get('url1');
        } else {
            $url1 = '';
        }
        if ($req->get('language1') != null) {
            $language1 = ' --LANGUAGE=' . $req->get('language1');
        } else {
            $language1 = '';
        }
        if ($req->get('country1') != null) {
            $country1 = ' --COUNTRY=' . $req->get('country1');
        } else {
            $country1 = '';
        }
        if ($req->get('dbServer1') != null) {
            $dbServer1 = ' --DB_SERVER=' . $req->get('dbServer1');
        } else {
            $dbServer1 = '';
        }
        if ($req->get('dbUser1') != null) {
            $dbUser1 = ' --DB_USER=' . $req->get('dbUser1');
        } else {
            $dbUser1 = '';
        }
        if ($req->get('dbPwd1') != null) {
            $dbPwd1 = ' --DB_PASSWORD=' . $req->get('dbPwd1');
        } else {
            $dbPwd1 = '';
        }
        if ($req->get('dbEPwd1') != null) {
            $dbEPwd1 = ' --DB_EMPTY_PASSWORD=' . $req->get('dbEPwd1');
        } else {
            $dbEPwd1 = '';
        }
        if ($req->get('fileName1') != null) {
            $fileName1 = ' --FILENAME' . $req->get('fileName1');
        } else {
            $fileName1 = '';
        }

        $cmd = 'path=install_upgrade /' . $path1 . $file1 . ' npm run specific-test --' . $dir1 . $last1 . $target1 . $link1 . $url1 . $language1 . $country1 . $dbServer1 . $dbUser1 . $dbPwd1 . $dbEPwd1 . $fileName1 . $headless1;
        $move_to_project = chdir('../..');
        $response = new StreamedResponse();
        $process = new Process($cmd);
        $process->setWorkingDirectory($move_to_project);
        $process->setTimeout(60000000000000);
        $response->setCallback(function () use ($process) {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'ERR > ' . $buffer;
                } else {
                    echo $buffer;
                    ob_flush();
                    flush();
                    echo '<br>';
                }
            });
        });

        $response->setStatusCode(200);
        return $response;
        //return new Response($cmd);
    }

    public function killAction()
    {
        $output = shell_exec(' netstat -nlp | grep :4444');
        $res = explode("LISTEN", $output);
        $res1 = explode("/", $res[1]);
        $selenium_pid = $res1[0];
        shell_exec('kill -9 ' . $selenium_pid);
        shell_exec('pkill -9 npm');
        return $this->redirectToRoute('PrestaShop_test_homepage');
        //return new Response($output.'<br>'.$selenium_pid);
    }
}
