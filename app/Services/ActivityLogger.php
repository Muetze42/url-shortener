<?php

namespace App\Services;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Url;
use Illuminate\Support\Facades\App;
use Spatie\Activitylog\ActivityLogger as Logger;
use Spatie\Activitylog\Contracts\Activity as ActivityContract;

class ActivityLogger extends Logger
{
    public function log(string $description): ?ActivityContract
    {
        if ($this->logStatus->disabled() || request()->routeIs('redirect') || App::get('JobProcessing')) {
            return null;
        }

        /* @var \App\Models\Activity $activity */
        $activity = $this->activity;

        $activity->description = $this->replacePlaceholders(
            $activity->description ?? $description,
            $activity
        );

        if (isset($activity->subject)) {
            $activitySubject = $activity->subject;
            if (method_exists($activitySubject, 'tapActivity')) {
                $this->tap([$activitySubject, 'tapActivity'], $activity->event ?? '');
            }

            $activity->team_id = match (get_class($activitySubject)) {
                Team::class => $activitySubject->id,
                TeamUser::class => $activitySubject->team_id,
                Url::class => $activitySubject->team_id,
                default => null,
            };
        }

        $activity->save();

        $this->activity = null;

        return $activity;
    }
}
