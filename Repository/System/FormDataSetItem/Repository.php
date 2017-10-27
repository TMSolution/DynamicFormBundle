<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormDataSetItem;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity');return $queryBuidler;        
}    
    
}

