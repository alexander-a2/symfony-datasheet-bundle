<?php

namespace AlexanderA2\SymfonyDatasheetBundle\DataReader;

use AlexanderA2\PhpDatasheet\DataReader\DataReaderInterface;
use AlexanderA2\PhpDatasheet\DataReader\QueryBuilderDataReader;
use AlexanderA2\PhpDatasheet\DatasheetInterface;
use Doctrine\ORM\EntityRepository;

class EntityDataReader extends QueryBuilderDataReader implements DataReaderInterface
{
    public function setSource(mixed $source): self
    {
        parent::setSource($source->createQueryBuilder('e'));

        return $this;
    }

    public static function supports(DatasheetInterface $datasheet): bool
    {
        return $datasheet->getSource() instanceof EntityRepository;
    }
}