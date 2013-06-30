<?php
namespace Application\Model\Entities;

abstract class AEntity{
    
    public function __construct($data = array()){
        
        if(is_array($data) && !empty($data)){
            foreach($data as $fieldname => $value){
                
                $setter = "set".ucfirst($fieldname);
                
                if(method_exists($this, $setter)){
                    $this->{$setter}($value);
                }
            }
        }
        
        return $this;
    }
    
}

?>