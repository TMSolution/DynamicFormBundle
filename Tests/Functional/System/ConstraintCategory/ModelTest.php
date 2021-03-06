<?php

namespace TMSolution\DynamicFormBundle\Tests\Functional\Model\System\ConstraintCategory;

use Flexix\GeneratorBundle\Util\CommandTestCase;
use TMSolution\GeneratorBundle\Generator\Faker\Populator;  


use TMSolution\DynamicFormBundle\Model\System\ConstraintCategory\Model ;

/**
 * Description of ModelTest
 *
 * @author Mariusz Piela <mariusz.piela@tmsolution.pl>
 */
class SmoekTest extends CommandTestCase {

    protected static $model;
    protected static $entityClass='TMSolution\DynamicFormBundle\Entity\ConstraintCategory';
    protected static $entityManager;
    
    public static  function setUpBeforeClass() {
    
        self::bootKernel();
        $drop=self::runCommand(self::$kernel, 'doctrine:schema:drop -f');
        $update=self::runCommand(self::$kernel, 'doctrine:schema:update -f');
        $generate=self::runCommand(self::$kernel, 'tmsolution:generate:fixture --bundle TMSolution\DynamicFormBundle --dir Test --quantity 3 --silent');
        $load=self::runCommand(self::$kernel, 'tmsolution:fixtures:load --dir Test --purge-with-truncate  --silent');
        self::$entityManager= static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        self::$model = new Model(self::$entityManager);
        
    }
    
    public static  function tearDownAfterClass()
    {
        $drop=self::runCommand(self::$kernel, 'doctrine:schema:drop -f');
    }
    
    protected function getEntity()
    {
    
        $generator = \TMSolution\GeneratorBundle\Generator\Faker\Factory::create('en_EN');
        $customColumnFormatter = array(); 
        $populator = new Populator($generator, self::$entityManager);
        $populator->addEntity(self::$entityClass, 1, $customColumnFormatter);
        $result = $populator->execute(self::$entityManager,false);
        return $result[0];
    }

    public function testFind() { 
        $collection = self::$model->find(self::$entityClass);
        $this->assertInternalType('array',$collection);
    }

    public function testFindOneById() {
        
        $id=1;
        $entity = self::$model->findOneById(self::$entityClass, $id);
        $this->assertInstanceOf(self::$entityClass,$entity);
    }

    public function testGetRepository() {

        $repository=self::$model->getRepository(self::$entityClass);
        $this->assertInstanceOf('Doctrine\ORM\EntityRepository',$repository);
    }

    public function testGetQueryBuilder() 
    {
        $queryBuilder=self::$model->getQueryBuilder(self::$entityClass);
        $this->assertInstanceOf('Doctrine\ORM\QueryBuilder',$queryBuilder);
    }

    public function testSave() {

        $entity=self::$model->save($this->getEntity());
        $this->assertInstanceOf(self::$entityClass,$entity);
    }

    public function testUpdate() {
        
        $entity = self::$model->findOneById(self::$entityClass, 1);
        $obj=$this->getEntity();
                $entity->setName($obj->getName());        
        $result=self::$model->update();
        $this->assertTrue($result);
    }

    public function testDelete() {
        
        $entity = self::$model->findOneById(self::$entityClass, 1);
        $result=self::$model->delete($entity);
        $this->assertTrue($result);
    }

}
