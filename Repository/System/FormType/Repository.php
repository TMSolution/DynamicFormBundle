<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormType;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,parent');$queryBuidler->leftJoin('entity.parent', 'parent');return $queryBuidler;        
}    
    
}

