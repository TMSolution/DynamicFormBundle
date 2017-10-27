<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormTypeOption;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,formType,formTypeOptionDict');$queryBuidler->leftJoin('entity.formType', 'formType');$queryBuidler->leftJoin('entity.formTypeOptionDict', 'formTypeOptionDict');return $queryBuidler;        
}    
    
}

