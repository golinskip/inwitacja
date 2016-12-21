<?php
namespace InvitationBundle\Entity\ParameterType;

/**
 * Description of Enum
 *
 * @author pawel
 */
class Enum {
    
    /**
    * Tablica rekordów
    */
    private $enumRecord;
    
    /**
    * Pokaż limit
    */
    private $showLimits;
    
    /**
    * Czy jest możliwość nie wybrania niczego?
    */
    private $nullable
    
    public function getEnumRecord(){
		return $this->enumRecords;
	}

	public function setEnumRecord($enumRecords){
		$this->enumRecords = $enumRecords;
        return $this;
	}

	public function getShowLimits(){
		return $this->showLimits;
	}

	public function setShowLimits($showLimits){
		$this->showLimits = $showLimits;
        return $this;
	}

	public function getNullable(){
		return $this->nullable;
	}

	public function setNullable($nullable){
		$this->nullable = $nullable;
        return $this;
    }
	
    
    public function __construct() {
        $this->enumRecord = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add enumRecord
     *
     * @param \InvitationBundle\Entity\ParameterType\EnumRecord $enumRecord
     *
     * @return Enum
     */
    public function addEnumRecord(\InvitationBundle\Entity\ParameterType\EnumRecord $enumRecord)
    {
        $this->enumRecord[] = $enumRecord;

        return $this;
    }

    /**
     * Remove enumRecord
     *
     * @param \InvitationBundle\Entity\ParameterType\EnumRecord $enumRecord
     */
    public function removeEnumRecord(\InvitationBundle\Entity\ParameterType\EnumRecord $enumRecord)
    {
        $this->enumRecord->removeElement($enumRecord);
    }

    /**
     * Get enumRecord
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnumRecord()
    {
        return $this->enumRecord;
    }
}
