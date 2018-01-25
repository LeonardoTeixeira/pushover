<?php

namespace LeonardoTeixeira\Pushover;

use LeonardoTeixeira\Pushover\Exceptions\InvalidArgumentException;

class Status
{
    const ACKNOWLEDGED = 'acknowledged';
    const ACKNOWLEDGED_AT = 'acknowledged_at';
    const ACKNOWLEDGED_BY = 'acknowledged_by';
    const ACKNOWLEDGED_BY_DEVICE = 'acknowledged_by_device';
    const LAST_DELIVERED_AT = 'last_delivered_at';
    const EXPIRED = 'expired';
    const EXPIRED_AT = 'expires_at';
    const CALLED_BACK = 'called_back';
    const CALLED_BACK_AT = 'called_back_at';
    
    private $status = [
            self::ACKNOWLEDGED => null,
            self::ACKNOWLEDGED_AT => null,
            self::ACKNOWLEDGED_BY => null,
            self::ACKNOWLEDGED_BY_DEVICE => null,
            self::LAST_DELIVERED_AT => null,
            self::EXPIRED => null,
            self::EXPIRED_AT => null,
            self::CALLED_BACK => null,
            self::CALLED_BACK_AT => null
        ];

    public function __construct($status = null)
    {
        if(!is_null($status)) {
            if(!is_array($status))
                throw new InvalidArgumentException('The status \'' . $status . '\' is invalid.');
            
            foreach($status as $key => $value) {
                if(array_key_exists($key, $this->status)) {
                    $this->status[$key] = $value;
                }
            }
        }
    }
 
    public function setAcknowledged($value)
    {
        $this->status[self::ACKNOWLEDGED] = $value;
    }  
      
    public function setAcknowledgedAt($value)
    {
        $this->status[self::ACKNOWLEDGED_AT] = $value;
    }  
    
    public function setAcknowledgedBy($value)
    {
        $this->status[self::ACKNOWLEDGED_BY] = $value;
    }  
       
    public function setAcknowledgedByDevice($value)
    {
        $this->status[self::ACKNOWLEDGED_BY_DEVICE] = $value;
    }  
           
    public function setLastDeliveredAt($value)
    {
        $this->status[self::LAST_DELIVERED_AT] = $value;
    }  
            
    public function setExpired($value)
    {
        $this->status[self::EXPIRED] = $value;
    } 
    
    public function setExpiredAt($value)
    {
        $this->status[self::EXPIRED_AT] = $value;
    }     

    public function setCalledBack($value)
    {
        $this->status[self::CALLED_BACK] = $value;
    }  
    
    public function setCalledBackAt($value)
    {
        $this->status[self::CALLED_BACK_AT] = $value;
    }  
 
    public function getAcknowledged()
    {
        return $this->status[self::ACKNOWLEDGED];
    }  
      
    public function getAcknowledgedAt()
    {
        return $this->status[self::ACKNOWLEDGED_AT];
    }  
    
    public function getAcknowledgedBy()
    {
        return $this->status[self::ACKNOWLEDGED_BY];
    }  
       
    public function getAcknowledgedByDevice()
    {
        return $this->status[self::ACKNOWLEDGED_BY_DEVICE];
    }  
           
    public function getLastDeliveredAt()
    {
        return $this->status[self::LAST_DELIVERED_AT];
    }  
            
    public function getExpired()
    {
        return $this->status[self::EXPIRED];
    } 
    
    public function getExpiredAt()
    {
        return $this->status[self::EXPIRED_AT];
    }     

    public function getCalledBack()
    {
        return $this->status[self::CALLED_BACK];
    }  
    
    public function getCalledBackAt()
    {
        return $this->status[self::CALLED_BACK_AT];
    } 
 
    public function hasAcknowledged()
    {
        return !is_null($this->status[self::ACKNOWLEDGED]);
    }  
      
    public function hasAcknowledgedAt()
    {
        return !is_null($this->status[self::ACKNOWLEDGED_AT]);
    }  
    
    public function hasAcknowledgedBy()
    {
        return !is_null($this->status[self::ACKNOWLEDGED_BY]);
    }  
       
    public function hasAcknowledgedByDevice()
    {
        return !is_null($this->status[self::ACKNOWLEDGED_BY_DEVICE]);
    }  
           
    public function hasLastDeliveredAt()
    {
        return !is_null($this->status[self::LAST_DELIVERED_AT]);
    }  
            
    public function hasExpired()
    {
        return !is_null($this->status[self::EXPIRED]);
    } 
    
    public function hasExpiredAt()
    {
        return !is_null($this->status[self::EXPIRED_AT]);
    }     

    public function hasCalledBack()
    {
        return !is_null($this->status[self::CALLED_BACK]);
    }  
    
    public function hasCalledBackAt()
    {
        return !is_null($this->status[self::CALLED_BACK_AT]);
    }     
}
