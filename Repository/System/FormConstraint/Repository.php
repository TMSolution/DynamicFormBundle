<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormConstraint;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,formConstraintCategory');$queryBuidler->leftJoin('entity.formConstraintCategory', 'formConstraintCategory');return $queryBuidler;        
}    
    
}

