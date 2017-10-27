<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormItemOptionValue;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,formItem,formTypeOption');$queryBuidler->leftJoin('entity.formItem', 'formItem');$queryBuidler->leftJoin('entity.formTypeOption', 'formTypeOption');return $queryBuidler;        
}    
    
}

