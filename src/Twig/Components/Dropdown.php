<?php

namespace App\Twig\Components;

use App\Services\DropdownService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(template: 'components/Twig/Dropdown.html.twig')]
final class Dropdown
{
    /**
     * @var string
     */
    public string $dropdownName;
    /**
     * @var string
     */
    public string $classes;
    private DropdownService $dropdownService;

    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }

    /**
     * @return string
     */
    public function getIcon():string
    {
        if($this->dropdownName === 'Filter'){
            return 'funnel';
        }

        if($this->dropdownName === 'Part Type'){
            return 'layers';
        }

        if($this->dropdownName === 'Sort'){
            return 'sort-up';
        }

        return 'filter';
    }

    /**
     * @return array
     */
    public function getOptions():array
    {
        return $this->dropdownService->getOptions($this->dropdownName);
    }
}
