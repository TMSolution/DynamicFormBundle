<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormItemConstraint;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,formItem,constraint');$queryBuidler->leftJoin('entity.formItem', 'formItem');$queryBuidler->leftJoin('entity.constraint', 'constraint');return $queryBuidler;        
}    
    
}

