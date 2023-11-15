<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\ColumnFilter;

use AlexanderA2\PhpDatasheet\Filter\EqualsFilter;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\AbstractNestedTreeDatasheetFilterApplier;

class EqualsFilterApplier extends AbstractNestedTreeDatasheetFilterApplier
{
    public const SUPPORTED_FILTER_CLASS = EqualsFilter::class;

    public function apply(FilterApplierContext $context)
    {
    }
}