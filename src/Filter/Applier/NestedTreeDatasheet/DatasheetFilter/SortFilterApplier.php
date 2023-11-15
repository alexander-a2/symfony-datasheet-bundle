<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\DatasheetFilter;

use AlexanderA2\PhpDatasheet\Filter\SortFilter;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet\AbstractNestedTreeDatasheetFilterApplier;

class SortFilterApplier extends AbstractNestedTreeDatasheetFilterApplier
{
    public const SUPPORTED_FILTER_CLASS = SortFilter::class;
    private const DIRECTION_DESC = 'desc';

    public function apply(FilterApplierContext $context)
    {
    }
}