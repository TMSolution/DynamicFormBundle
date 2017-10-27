<?php

namespace TMSolution\DynamicFormBundle\Model\System\DynamicForm;

use Flexix\ModelBundle\Util\Model as FlexixModel;
use TMSolution\DynamicFormBundle\Entity\DynamicForm;

class Model extends FlexixModel
{
    
    public function getDynamicForm($id=null)
    {
        if($id)
        {
            
            
        }
        else
        {
            
        }    
        
        
        return new DynamicForm();
        
    }
    
}
