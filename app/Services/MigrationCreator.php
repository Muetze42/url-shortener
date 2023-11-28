<?php

namespace App\Services;

use Illuminate\Database\Migrations\MigrationCreator as Creator;

class MigrationCreator extends Creator
{
    /**
     * Get the date prefix for the migration.
     */
    protected function getDatePrefix(): string
    {
        return getDatePrefix();
    }
}
