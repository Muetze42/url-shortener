<?php

namespace App\Console\Commands\Development;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand as Command;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Composer;

class MigrateMakeCommand extends Command
{
    /**
     * Create a new migration install command instance.
     */
    public function __construct(MigrationCreator $creator, Composer $composer)
    {
        parent::__construct($creator, $composer);
    }
}
