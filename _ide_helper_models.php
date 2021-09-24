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
 * App\Models\Hearth
 *
 * @property int $id
 * @property string|null $name
 * @property string $path
 * @property string $seconds
 * @property string $graphic
 * @property bool $deviations
 * @property int|null $deviations_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereDeviations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereDeviationsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereGraphic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereSeconds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hearth whereUserId($value)
 */
	class Hearth extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $device_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $phone
 * @property string|null $status
 * @property string $account_type
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

