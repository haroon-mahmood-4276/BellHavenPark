<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $booking_number
 * @property int|null $cabin_id
 * @property int|null $customer_id
 * @property \Illuminate\Support\Carbon $booking_from
 * @property \Illuminate\Support\Carbon $booking_to
 * @property int|null $booking_source_id
 * @property float|null $daily_rate
 * @property float $daily_less_booking_percentage
 * @property float $weekly_rate
 * @property float $weekly_rate_less_booking_percentage
 * @property float $four_weekly_rate
 * @property float $four_weekly_less_booking_percentage
 * @property string|null $check_in
 * @property int $check_in_date
 * @property int $check_out_date
 * @property bool $bill_for_electricity
 * @property bool $bill_for_gas
 * @property bool $bill_for_water
 * @property string|null $comments
 * @property string|null $payment
 * @property bool|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property int|null $booking_tax_id
 * @property-read \App\Models\BookingSource|null $booking_source
 * @property-read \App\Models\BookingTax|null $booking_tax
 * @property-read \App\Models\Cabin|null $cabin
 * @property-read \App\Models\Customer|null $customer
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Customer> $tenants
 * @property-read int|null $tenants_count
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBillForElectricity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBillForGas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBillForWater($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCabinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckInDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCheckOutDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDailyLessBookingPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFourWeeklyLessBookingPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereFourWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereWeeklyRateLessBookingPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking withoutTrashed()
 */
	class Booking extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingSource withoutTrashed()
 */
	class BookingSource extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property int $amount
 * @property bool $is_flat
 * @property bool $is_default
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereIsFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BookingTax withoutTrashed()
 */
	class BookingTax extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cabin_type_id
 * @property \App\Utils\Enums\CabinStatus $cabin_status Status should be vacant, needs_cleaning, occupied, maintenance, closed_permanently, closed_temporarily
 * @property string|null $name
 * @property int $closed_from
 * @property int $closed_to
 * @property bool $long_term
 * @property bool $electric_meter
 * @property float $daily_rate
 * @property float $weekly_rate
 * @property float $four_weekly_rate
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property bool $gas_meter
 * @property bool $water_meter
 * @property string|null $reason
 * @property-read \App\Models\CabinType $cabin_type
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereCabinStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereCabinTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereClosedFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereClosedTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereElectricMeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereFourWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereGasMeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereLongTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereWaterMeter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin whereWeeklyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Cabin withoutTrashed()
 */
	class Cabin extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cabin> $cabins
 * @property-read int|null $cabins_count
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType query()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CabinType withoutTrashed()
 */
	class CabinType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $address
 * @property int|null $dob
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $telephone
 * @property int|null $international_id_id
 * @property string|null $international_details
 * @property string|null $international_address
 * @property string|null $comments
 * @property string|null $referenced_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property float $average_rating
 * @property-read \App\Models\InternationalId|null $international_id
 * @property mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CustomerRating> $ratings
 * @property-read int|null $ratings_count
 * @property-write mixed $tenants
 * @method static \Database\Factories\CustomerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAverageRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInternationalAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInternationalDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInternationalIdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereReferencedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $customer_id
 * @property float $rating
 * @property string|null $comments
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Customer|null $customer
 * @method static \Database\Factories\CustomerRatingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomerRating withoutTrashed()
 */
	class CustomerRating extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId query()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|InternationalId withoutTrashed()
 */
	class InternationalId extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cabin_id
 * @property int $reading
 * @property int $reading_date
 * @property \App\Utils\Enums\MeterTypes $meter_type
 * @property string|null $comments
 * @property string|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Cabin $cabin
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereCabinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereMeterType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereReading($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereReadingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MeterReading withoutTrashed()
 */
	class MeterReading extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int|null $booking_id
 * @property int|null $payment_method_id
 * @property int $customer_id
 * @property int $payment_from
 * @property int $payment_to
 * @property float|null $amount
 * @property \App\Utils\Enums\CustomerAccounts|null $account
 * @property \App\Utils\Enums\TransactionType|null $transaction_type
 * @property \App\Utils\Enums\PaymentStatus|null $status
 * @property \App\Utils\Enums\PaymentType $payment_type
 * @property array|null $additional_data
 * @property string|null $comments
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \App\Models\Booking|null $booking
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\PaymentMethod|null $payment_method
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAdditionalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereBookingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereTransactionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property \App\Utils\Enums\CustomerAccounts|null $linked_account
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereLinkedAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMethod withoutTrashed()
 */
	class PaymentMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string $show_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereShowName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission withoutRole($roles, $guard = null)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property int|null $parent_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role withoutPermission($permissions)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting withoutTrashed()
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

