<?php

namespace App\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private string $routeOutput = 'bg-sidebarHover text-sidebarTextHover';
    private string $routeIconOutput = 'text-sidebarTextHover';

    public function __construct(
        private readonly RequestStack $requestStack
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('active_route', [$this, 'isActiveRoute']),
            new TwigFunction('active_icon', [$this, 'isActiveIcon']),
        ];
    }


    private function isActive(string $routeName, ?string $output, string $defaultOutput, string $inactiveOutput): string
    {
        $output = $output ?? $defaultOutput;
        $currentRoute = $this->requestStack->getCurrentRequest()?->get('_route');

        return $currentRoute === $routeName ? $output : $inactiveOutput;
    }

    /**
     * Checks if the current route is active.
     * - Used for the link.
     *
     * @param string $routeName
     * @param mixed $output
     * @return string|null
     */
    public function isActiveRoute(string $routeName, ?string $output = null): string
    {
        return $this->isActive(
            routeName: $routeName,
            output: $output,
            defaultOutput: $this->routeOutput,
            inactiveOutput: 'text-sidebarText hover:bg-sidebarHover hover:text-sidebarTextHover'
        );
    }

    /**
     * Checks if the current route is active
     * - Used for the icon.
     *
     * @param string $routeName
     * @param mixed $output
     * @return string
     */
    public function isActiveIcon(string $routeName, ?string $output = null): string
    {
        return $this->isActive(
            routeName: $routeName,
            output: $output,
            defaultOutput: $this->routeIconOutput,
            inactiveOutput: 'text-sidebarText hover:text-sidebarTextHover'
        );
    }
}
