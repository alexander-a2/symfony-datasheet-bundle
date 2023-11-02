<?php

namespace AlexanderA2\SymfonyDatasheetBundle\DataReader;

use AlexanderA2\PhpDatasheet\DataReader\DataReaderInterface;
use AlexanderA2\PhpDatasheet\DataReader\QueryBuilderDataReader;
use AlexanderA2\PhpDatasheet\DatasheetInterface;
use AlexanderA2\PhpDatasheet\Helper\EntityHelper;
use AlexanderA2\PhpDatasheet\Helper\QueryBuilderHelper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class EntityDataReader extends QueryBuilderDataReader implements DataReaderInterface
{
    public function setSource(mixed $source): self
    {
        parent::setSource($source->createQueryBuilder('e'));
        $this->addRelations();

        return $this;
    }

    /**
     * todo: check if relations are already added
     * todo: check if selections are already added
     */
    protected function addRelations(): void
    {
        $primaryAlias = QueryBuilderHelper::getPrimaryAlias($this->getQueryBuilder());
        $entityFields = EntityHelper::getEntityFields(
            QueryBuilderHelper::getPrimaryClass($this->getQueryBuilder()),
            $this->getQueryBuilder()->getEntityManager(),
        );

        foreach ($entityFields as $fieldName => $fieldType) {
            if (!in_array($fieldType, EntityHelper::RELATION_FIELD_TYPES)) {
                continue;
            }
            $joinAlias = $this->addJoin($primaryAlias, $fieldName);
            $this->getQueryBuilder()->addSelect($joinAlias);
        }
    }

    public static function supports(DatasheetInterface $datasheet): bool
    {
        return $datasheet->getSource() instanceof ServiceEntityRepository;
    }
}