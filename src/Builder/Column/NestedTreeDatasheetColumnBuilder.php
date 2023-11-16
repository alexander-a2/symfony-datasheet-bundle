<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Builder\Column;

use AlexanderA2\PhpDatasheet\Builder\Column\ColumnBuilderInterface;
use AlexanderA2\PhpDatasheet\Builder\Column\QueryBuilderDatasheetColumnBuilder;
use AlexanderA2\PhpDatasheet\DatasheetInterface;
use AlexanderA2\SymfonyDatasheetBundle\DataReader\NestedTreeDataReader;

class NestedTreeDatasheetColumnBuilder extends QueryBuilderDatasheetColumnBuilder implements ColumnBuilderInterface
{
    public const ENTITY_SPECIFIC_FIELDS = [
        'lft',
        'lvl',
        'rgt',
    ];

    public function addColumnsToDatasheet(DatasheetInterface $datasheet): DatasheetInterface
    {
        parent::addColumnsToDatasheet($datasheet);

        foreach (self::ENTITY_SPECIFIC_FIELDS as $field){
            $datasheet->removeColumn($field);
        }

        return $datasheet;
    }

    public static function supports(DatasheetInterface $datasheet): bool
    {
        return $datasheet->getDataReader() instanceof NestedTreeDataReader;
    }
}