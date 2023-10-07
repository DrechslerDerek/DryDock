<?php

namespace App\Services;

class DropdownService
{

    /**
     * @param string $dropdownType
     * @return array
     */
    public function getOptions(string $dropdownType = ''): array
    {
        if($dropdownType === 'Filter'){
            return [
                'My Parts',
                'All Parts',
            ];
        }

        if($dropdownType === 'Part Type'){
            return [
                'Cockpit',
                'Bridge',
                'Weapon',
                'Frame',
                'Thruster',
                'Shielding',
                'Warp',
                'Communications'
            ];
        }

        if($dropdownType === 'Sort'){
            return [
                'Power Asc',
                'Power Desc',
                'Cost Asc',
                'Cost Desc',
                'Oldest',
                'Newest',
                'Most Used',
            ];
        }

        return [
            'A-Z',
            'Price Lowest',
            'Price Highest'
        ];
    }

}