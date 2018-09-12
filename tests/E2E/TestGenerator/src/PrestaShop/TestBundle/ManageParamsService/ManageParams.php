<?php
namespace PrestaShop\TestBundle\ManageParamsService;

use Symfony\Component\HttpFoundation\Response;
class ManageParams {


    public function ManageParam($params){
        $param = array();
        $i=0;
        foreach($params as $x => $x_value) {
            $i++;
            if($x_value != null && $x != "folder" && $x!="file")
            {$param[$i]=' --'.$x.'='.$x_value;}
            else{
                $param[$i]='';
            }
        }
return $param;
    }

}
