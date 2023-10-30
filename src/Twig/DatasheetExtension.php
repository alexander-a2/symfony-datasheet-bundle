<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Twig;

use AlexanderA2\PhpDatasheet\DatasheetInterface;
use AlexanderA2\PhpDatasheet\Factory\DatasheetBuilderFactory;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DatasheetExtension extends AbstractExtension
{
    public function __construct(
        protected Environment  $twig,
        protected RequestStack $requestStack,
    ) {
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('datasheet', [$this, 'renderDatasheet'], ['is_safe' => ['html']]),
        ];
    }

    public function renderDatasheet(DatasheetInterface $datasheet)
    {
        (new DatasheetBuilderFactory())
            ->get()
            ->build($datasheet, $this->requestStack->getMainRequest()->query->all($datasheet->getName()));

        return $this->twig->render('@Datasheet/layout.html.twig', [
            'datasheet' => $datasheet,
        ]);
    }
}