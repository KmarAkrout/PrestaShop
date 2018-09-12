<?php
/**
 * Created by PhpStorm.
 * User: kmar
 * Date: 24/08/18
 * Time: 08:41
 */

namespace PrestaShop\TestBundle\ManageFilesService;

use Symfony\Component\Finder\Finder;

class ManageFiles
{

    public function getFiles($folder)
    {
        if (strpos($folder, '.js') == false) {
            $finderFiles = new Finder();
            $directories = '';
            if ($folder == '.') {
                $finderDirectories = new Finder();
                $finderDirectories->Directories()->in($folder);
                $finderDirectories->sortByName();

                $finderDirectories->depth('== 0');

                foreach ($finderDirectories as $directory) {


                    $directories = $directories . $directory->getRelativePathname() . '***';

                }
            }
            $finderFiles->files()->in($folder);
            if ($folder == '.') {
                $finderFiles->depth('== 0');
            }
            $finderFiles->sortByName();

            $files = '';
            foreach ($finderFiles as $file) {


                $files = $files . $file->getRelativePathname() . '***';

            }

            return ($directories . '***' . $files);
        }
    }

}