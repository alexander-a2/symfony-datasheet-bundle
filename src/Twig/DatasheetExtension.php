<?php

namespace AlexanderA2\SymfonyDatasheetBundle\Twig;

use AlexanderA2\PhpDatasheet\Builder\DatasheetBuilder;
use AlexanderA2\PhpDatasheet\DatasheetInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Throwable;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DatasheetExtension extends AbstractExtension
{
    public function __construct(
        protected Environment      $twig,
        protected RequestStack     $requestStack,
        protected DatasheetBuilder $datasheetBuilder,
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
        try {
            $this->datasheetBuilder->build(
                $datasheet,
                $this->requestStack->getMainRequest()->query->all($datasheet->getName()),
            );

            return $this->twig->render('@Datasheet/layout.html.twig', [
                'datasheet' => $datasheet,
            ]);
        } catch (Throwable $exception) {
            return $this->twig->render('@Datasheet/exception.html.twig', [
                'datasheet' => $datasheet,
                'exception' => $exception,
            ]);
        }
    }
}