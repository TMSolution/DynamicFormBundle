<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormItem;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,formType,formPage');$queryBuidler->leftJoin('entity.formType', 'formType');$queryBuidler->leftJoin('entity.formPage', 'formPage');return $queryBuidler;        
}    
    
}

