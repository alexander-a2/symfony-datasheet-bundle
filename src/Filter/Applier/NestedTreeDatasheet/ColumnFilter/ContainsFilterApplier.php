<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\ColumnFilter;

use AlexanderA2\PhpDatasheet\Filter\ContainsFilter;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\AbstractNestedTreeDatasheetFilterApplier;

class ContainsFilterApplier extends AbstractNestedTreeDatasheetFilterApplier
{
    public const SUPPORTED_FILTER_CLASS = ContainsFilter::class;

    public function apply(FilterApplierContext $context)
    {
        $filterValue = $context->getFilter()->getParameter('value');

        if (empty($filterValue)) {
            return;
        }
        $columnName = $context->getDatasheetColumn()->getName();
        $filteredData = array_filter($context->getDataReader()->getSource(), function ($row) use ($columnName, $filterValue) {
            return stripos($row[$columnName], $filterValue) !== false;
        });
        $context->getDataReader()->setSource($filteredData);
    }
}