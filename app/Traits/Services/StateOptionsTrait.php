<?php

namespace App\Traits\Services;


/**
 * Trait StateOptionsTrait
 *
 * @package App\Traits\Services
 */
trait StateOptionsTrait
{
    /**
     * @return array
     */
    public function getActiveOptions(): array
    {
        return [
            1 => 'Active',
            0 => 'Inactive'
        ];
    }

    /**
     * @return array
     */
    public function getBlockedOptions(): array
    {
        return [
            1 => 'Blocked',
            0 => 'Non blocked'
        ];
    }
}
