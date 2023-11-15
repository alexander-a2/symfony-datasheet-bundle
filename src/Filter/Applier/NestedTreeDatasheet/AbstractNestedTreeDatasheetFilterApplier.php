<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Filter\Applier\NestedTreeDatasheet;

use AlexanderA2\PhpDatasheet\Filter\FilterInterface;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierContext;
use AlexanderA2\PhpDatasheet\FilterApplier\FilterApplierInterface;
use AlexanderA2\SymfonyDatasheetBundle\DataReader\NestedTreeDataReader;

abstract class AbstractNestedTreeDatasheetFilterApplier implements FilterApplierInterface
{
    public const SUPPORTED_FILTER_CLASS = FilterInterface::class;

    public function supports(FilterApplierContext $context): bool
    {
        return $context->getDataReader() instanceof NestedTreeDataReader
            && get_class($context->getFilter()) === static::SUPPORTED_FILTER_CLASS;
    }
}