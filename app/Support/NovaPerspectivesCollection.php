<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NovaPerspectivesCollection
{
    /**
     * Return Nova Perspectives Collection for authorized user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Support\Collection
     */
    public static function create(Request $request): Collection
    {
        $perspectives = [];
        /* @var array<\App\Models\Team> $teams */
        $teams = $request->user()->teams;
        foreach ($teams as $team) {
            $perspectives[] = [
                'slug' => $team->getKey(),
                'label' => $team->name,
                'mainMenu' => null,
                'userMenu' => null,
                'unfilteredMainMenuOver' => null,
                'unfilteredMainMenuUnder' => null,
                'authorizedToSee' => true,
                'icons' => [
                    'fontawesome' => null,
                    'heroicon' => null,
                    'image' => null,
                    'html' => $team->icon,
                    'height' => 18,
                    'classes' => ['icon' => ''],
                ],
                'classes' => [
                    'elem' => '',
                    'icon' => '',
                    'label' => '',
                    'filterClass' => '',
                ],
                'priority' => $team->name,
            ];
        }

        return collect($perspectives);
    }
}
