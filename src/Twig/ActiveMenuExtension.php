<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ActiveMenuExtension extends AbstractExtension
{
    private $request;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('active_menu', [$this, 'isActive']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_active', [$this, 'isActive']),
        ];
    }

    public function isActive(string $route): ?string
    {
        if ($route === $this->request->attributes->get('_route')) {
            return ' active';
        }

        return null;
    }
}
