<?php
namespace Doctrine;

class BookfakerNamingStrategy implements ORM\Mapping\NamingStrategy
{
    public function classToTableName($className)
    {
        return $className;
    }

    public function joinColumnName($propertyName) {
        
    }

    public function joinKeyColumnName($entityName, $referencedColumnName = null) {
        
    }

    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null) {
        
    }

    public function propertyToColumnName($propertyName, $className = null) {
        return $propertyName;
    }

    public function referenceColumnName() {
        
    }
}