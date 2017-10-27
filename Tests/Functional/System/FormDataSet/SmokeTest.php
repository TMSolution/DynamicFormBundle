<?php

namespace TMSolution\DynamicFormBundle\Tests\Functional\Model\System\FormDataSet;

use TMSolution\GeneratorBundle\Generator\Faker\Populator;
use Flexix\GeneratorBundle\Util\CommandTestCase;
use AppBundle\Model\Admin\User\Model;



/**
 * Description of ModelTest
 *
 * @author Mariusz Piela <mariusz.piela@tmsolution.pl>
 */
class SmokeTest extends CommandTestCase {

    protected static $model;
    protected static $entityManager;
    protected static $client; 
    
    protected static $entityClass='TMSolution\DynamicFormBundle\Entity\FormDataSet';
    protected static $username='donatello@tmnt.com';
    protected static $password='cowabunga';
    protected static $bundle= 'TMSolution\DynamicFormBundle';
    
    public static  function setUpBeforeClass() {
    
        self::bootKernel();
        $drop=self::runCommand(self::$kernel, 'doctrine:schema:drop -f');
        $update=self::runCommand(self::$kernel, 'doctrine:schema:update -f');
        $generate=self::runCommand(self::$kernel, sprintf('tmsolution:generate:fixture --bundle %s --dir Test --quantity 3 --silent',self::$bundle));
        $loadBase=self::runCommand(self::$kernel, sprintf('tmsolution:fixtures:load --fixtures   ./src/%s/DataFixtures/Basic  --silent',self::$bundle));
        $load=self::runCommand(self::$kernel, sprintf('tmsolution:fixtures:load --fixtures   ./src/%s/DataFixtures/Test  --silent',self::$bundle));
        self::$entityManager= static::$kernel->getContainer()
                ->get('doctrine')
                ->getManager();
        self::$model = new Model(self::$entityManager);
    
     
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
    
    protected function printError($crawler){

            $error = $crawler->filter('div.text-exception > h1');
            $line = $crawler->filter('a.file_link');
            
            if ($error->count()) {
                echo sprintf("\nError: %s, %s\n",$error->text(),$line->text());
            }

    }
       
    protected  function setUp()
    {
        self::$client = static::createClient();
        $route='/login';
        $crawler = self::$client->request('GET', $route);
        $form = $crawler->selectButton('_submit')->form(array(
            '_username'  => self::$username,
            '_password'  => self::$password
        ));

        self::$client->submit($form);
   
    }
    
    protected function  getToken($crawler,$formTypeName)
    {
        $extract = $crawler->filter(sprintf('input[name="%s"]',$formTypeName))->extract(array('value'));
        return  $extract[0];
    }
      
    public function testIndex()
    {
        $route='/system/form-data-set/index';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route));
    }
    public function testNew()
    {
        $route='/system/form-data-set/new';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route));
    }
  
    public function testCreate()
    {
        $route='/system/form-data-set/new';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route));
        
        $entity=$this->getEntity();
        $form = $crawler->selectButton('create')->form([
                'system_form-data-set_insert[_token]'  => $this->getToken($crawler,'system_form-data-set_insert[_token]'),                
                'system_form-data-set_insert[creationDate]'  => $entity->getCreationDate()->format('d.m.Y'),                
                'system_form-data-set_insert[formDataSet]'  => $entity->getFormDataSet(),    
        ]);

        self::$client->submit($form);
        $crawler = self::$client->followRedirect();
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code during inserting %s ",$route));
    } 

    public function testEdit()
    {
        $route='/system/form-data-set/edit/1';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route));    
    }
    
    public function testUpdate()
    {
        $route='/system/form-data-set/edit/1';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route)); 
        
        $entity=$this->getEntity();
        $form = $crawler->selectButton('update')->form([
                'system_form-data-set_edit[_token]'  => $this->getToken($crawler,'system_form-data-set_edit[_token]'),                
                'system_form-data-set_edit[creationDate]'  => $entity->getCreationDate()->format('d.m.Y'),                
                'system_form-data-set_edit[formDataSet]'  => $entity->getFormDataSet(),    
        ]);

        self::$client->submit($form);
        $crawler = self::$client->followRedirect();
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code during update",$route));
    } 

    public function testDeleteForm()
    {
        $route='/system/form-data-set/delete/1';
        $crawler = self::$client->request('GET', $route);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route)); 
       
    }
    
    public function testDelete()
    {
        $route='/system/form-data-set/delete/1';
        $crawler = self::$client->request('GET', $route);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route)); 
        
        $form = $crawler->selectButton('delete')->form(array(
            'system_form-data-set_delete[_token]'  => $this->getToken($crawler,'system_form-data-set_delete[_token]'),
        ));

        self::$client->submit($form);
        $crawler = self::$client->followRedirect();
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code during delete",$route));
    } 
    
    public function testList()
    {
        $route='/system/form-data-set/list';
        $crawler = self::$client->request('GET', $route,[],[],['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route)); 
       
    } 
    
    public function testFilter()
    {
        $route='/system/form-data-set/filter';
        $crawler = self::$client->request('GET', $route,[],[],['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code for GET %s",$route)); 
        $entity=$this->getEntity();
        $form = $crawler->selectButton('filter')->form(
        [
            'system_form-data-set_filter' =>[                
                'creationDate'
                    =>[
                       'left_datetime'  => $entity->getCreationDate()->format('d.m.Y'),
                       'right_datetime'  => $entity->getCreationDate()->modify('+1 day')->format('d.m.Y')
                       ],                
                'formDataSet'  => $entity->getFormDataSet(), 
            ]
        ]);
        
        self::$client->submit($form);
        $this->printError($crawler);
        $this->assertEquals(200, self::$client->getResponse()->getStatusCode(), sprintf("Unexpected HTTP status code during delete",$route));
        
    }}



   