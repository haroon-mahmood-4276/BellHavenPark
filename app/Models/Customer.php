<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Exception;

/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $address
 * @property string|null $dob
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $telephone
 * @property int $haven_international_id_id
 * @property string|null $haven_international_id_details
 * @property string|null $haven_international_id_address
 * @property string|null $comments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Query\Builder|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereHavenInternationalIdAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereHavenInternationalIdDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereHavenInternationalIdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Customer withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $tenants
 * @property string|null $referenced_by
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereReferencedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTenants($value)
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_customers";

    protected $fillable = [
        "first_name",
        "last_name",
        "address",
        "email",
        "phone",
        "dob",
        "telephone",
        "haven_international_id_id",
        "haven_international_id_details",
        "haven_international_id_address",
        "comments",
        "referenced_by",
        'tenants',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getAllWithPagination($limit)
    {
        $records = $this->join('haven_international_ids', 'haven_customers.haven_international_id_id', '=', 'haven_international_ids.id')
            ->select('haven_customers.*', 'haven_international_ids.name AS id_name')
            ->latest()
            ->paginate($limit);


        return $records;
    }

    public function getById($id)
    {
        try {
            $id = decryptParams($id);
            return $this->where('id', $id)->first();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function storeCustomer($request)
    {
        try {
            $data = [
                "first_name" => filter_strip_tags($request->post('first_name')),
                "last_name" => filter_strip_tags($request->post('last_name')),
                "address" => filter_strip_tags($request->post('address')),
                "email" => filter_strip_tags($request->post('email')),
                "phone" => filter_strip_tags($request->post('phone')),
                "dob" => $request->post('dob'),
                "telephone" => filter_strip_tags($request->post('telephone')),
                "haven_international_id_id" => filter_strip_tags($request->post('id_type')),
                "haven_international_id_details" => filter_strip_tags($request->post('id_details')),
                "haven_international_id_address" => filter_strip_tags($request->post('id_address')),
                "comments" => filter_strip_tags($request->post('comments')),
                "referenced_by" => filter_strip_tags($request->post('referenced_by')),
                "tenants" => filter_strip_tags(json_encode($request->post('tenants'))),
            ];

            // dd($data);

            $result = $this->create($data);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function updateCustomer($request, $id)
    {
        try {
            $id = decryptParams($id);
            $data = [
                "first_name" => filter_strip_tags($request->post('first_name')),
                "last_name" => filter_strip_tags($request->post('last_name')),
                "address" => filter_strip_tags($request->post('address')),
                "phone" => filter_strip_tags($request->post('phone')),
                "dob" => $request->post('dob'),
                "telephone" => filter_strip_tags($request->post('telephone')),
                "haven_international_id_id" => filter_strip_tags($request->post('id_type')),
                "haven_international_id_details" => filter_strip_tags($request->post('id_details')),
                "haven_international_id_address" => filter_strip_tags($request->post('id_address')),
                "comments" => filter_strip_tags($request->post('comments')),
                "referenced_by" => filter_strip_tags($request->post('referenced_by')),
                "tenants" => filter_strip_tags(json_encode($request->post('tenants'))),
            ];
            $result = $this->where('id', $id)->update($data);
            // dd($result, $data, $id);

            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function destroyCustomer($id): Exception|bool
    {
        try {
            $id = decryptParams($id);
            $this->whereIn('id', $id)->delete();
            return true;
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
