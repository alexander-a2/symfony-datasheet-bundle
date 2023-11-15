<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Builder\Column;

use AlexanderA2\PhpDatasheet\Builder\Column\ColumnBuilderInterface;
use AlexanderA2\PhpDatasheet\Builder\Column\QueryBuilderDatasheetColumnBuilder;
use AlexanderA2\PhpDatasheet\DatasheetColumn;
use AlexanderA2\PhpDatasheet\DatasheetInterface;
use AlexanderA2\PhpDatasheet\DataType\StringDataType;
use AlexanderA2\PhpDatasheet\Helper\EntityHelper;

class NestedTreeDatasheetColumnBuilder extends QueryBuilderDatasheetColumnBuilder implements ColumnBuilderInterface
{
    private const ENTITY_SPECIFIC_FIELDS = [
        'id',
        'treeRoot',
        'root',
        'parent',
        'parentId',
        'lft',
        'lvl',
        'rgt',
    ];

    public function __construct(
        protected EntityHelper $entityHelper,
    ) {
    }

    public static function supports(DatasheetInterface $datasheet): bool
    {
        return $datasheet->getDataReader() instanceof NestedTreeDataReader;
    }

    public function addColumnsToDatasheet(DatasheetInterface $datasheet): DatasheetInterface
    {
        $datasheet->addColumn((new DatasheetColumn('fullPathWithTitle', StringDataType::class)));
        parent::addColumnsToDatasheet($datasheet);

        foreach (self::ENTITY_SPECIFIC_FIELDS as $field){
            $datasheet->removeColumn($field);
        }

        return $datasheet;
    }

    public static function getDefaultProi()
    {
        
    }
}