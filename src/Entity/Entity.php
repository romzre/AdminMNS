<?php 
namespace App\Entity;
class Entity {

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            $method = 'set';
            $key=explode('_',$key);

            foreach($key as $k => $y)
            {
                    $method .=ucfirst($y);
            }

            
            if(method_exists($this, $method) && $value !=NULL)
            {
                
                $this->$method($value);
            }
        }
 
        return $this;
    }

}