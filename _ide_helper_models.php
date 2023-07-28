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
 * App\Models\Booking
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 */
	class Booking extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BookingSource
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource query()
 */
	class BookingSource extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cabin
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin query()
 */
	class Cabin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CabinType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType query()
 */
	class CabinType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\InternationalId
 *
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId query()
 */
	class InternationalId extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMethod
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod query()
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $deleted_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

