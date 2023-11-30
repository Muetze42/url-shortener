<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property int|null $team_id
 * @property string|null $log_name
 * @property string $description
 * @property string|null $subject_type
 * @property int|null $subject_id
 * @property string|null $event
 * @property string|null $causer_type
 * @property int|null $causer_id
 * @property \Illuminate\Support\Collection|null $properties
 * @property string|null $batch_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $causer
 * @property-read \Illuminate\Support\Collection $changes
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $subject
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Activity causedBy(\Illuminate\Database\Eloquent\Model $causer)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forBatch(string $batchUuid)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forEvent(string $event)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity forSubject(\Illuminate\Database\Eloquent\Model $subject)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity hasBatch()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity inLog(...$logNames)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereBatchUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withoutTrashed()
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Url> $urls
 * @property-read int|null $urls_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\TeamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team withoutTrashed()
 */
	class Team extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TeamUser
 *
 * @property int $id
 * @property int $team_id
 * @property int $user_id
 * @property \App\Enums\TeamUserRoleEnum $role
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeamUser whereUserId($value)
 */
	class TeamUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Url
 *
 * @property int $id
 * @property int $team_id
 * @property string $path
 * @property string $name
 * @property string $target
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Visit> $visits
 * @property int $visits_total
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $last_visit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitReferrer> $referrers
 * @property-read int|null $referrers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitRef> $refs
 * @property-read int|null $refs_count
 * @property-read \App\Models\Team $team
 * @property-read int|null $visits_count
 * @method static \Illuminate\Database\Eloquent\Builder|Url active()
 * @method static \Database\Factories\UrlFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Url newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Url onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Url query()
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereLastVisit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereVisits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url whereVisitsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Url withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Url withoutTrashed()
 */
	class Url extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property bool $is_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Team> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Visit
 *
 * @property int $id
 * @property int $url_id
 * @property string $device_type
 * @property string $browser_family
 * @property string $browser_version
 * @property string $browser_engine
 * @property string|null $platform_family
 * @property string|null $platform_version
 * @property string $device_family
 * @property string $device_model
 * @property string|null $crawler
 * @property string|null $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Url $url
 * @method static \Database\Factories\VisitFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Visit logCurrent()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit query()
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereBrowserEngine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereBrowserFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereBrowserVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereCrawler($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDeviceFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDeviceModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit wherePlatformFamily($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit wherePlatformVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Visit whereUrlId($value)
 */
	class Visit extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitRef
 *
 * @property int $id
 * @property int $url_id
 * @property string $value
 * @property string $browser_hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\Url $url
 * @method static \Database\Factories\VisitRefFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef logCurrent()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef whereBrowserHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef whereUrlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitRef whereValue($value)
 */
	class VisitRef extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitReferrer
 *
 * @property int $id
 * @property int $visit_referrer_host_id
 * @property int $url_id
 * @property \App\Models\Url $url
 * @property string $browser_hash
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property-read \App\Models\VisitReferrerHost|null $host
 * @method static \Database\Factories\VisitReferrerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer logCurrent()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereBrowserHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereUrlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrer whereVisitReferrerHostId($value)
 */
	class VisitReferrer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VisitReferrerHost
 *
 * @property int $id
 * @property string $host
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VisitReferrer> $referrers
 * @property-read int|null $referrers_count
 * @method static \Database\Factories\VisitReferrerHostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitReferrerHost whereUpdatedAt($value)
 */
	class VisitReferrerHost extends \Eloquent {}
}

