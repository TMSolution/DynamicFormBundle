<?php

namespace TMSolution\DynamicFormBundle\Repository\System\FormPage;

use  AppBundle\Util\EntityRepository;

class Repository extends EntityRepository
{

public function getConfiguredQueryBuilder()
{

    $queryBuidler=$this->createQueryBuilder('entity');
    $queryBuidler->select('entity,dynamicForm');$queryBuidler->leftJoin('entity.dynamicForm', 'dynamicForm');return $queryBuidler;        
}    
    
}

