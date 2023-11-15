<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\DatasheetFilter;

use AlexanderA2\PhpDatasheet\Filter\PaginationFilter;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\AbstractNestedTreeDatasheetFilterApplier;

class PaginationFilterApplier extends AbstractNestedTreeDatasheetFilterApplier
{
    public const SUPPORTED_FILTER_CLASS = PaginationFilter::class;

    public function apply(FilterApplierContext $context)
    {
    }
}