<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string|null $name
 * @property int $created_by_id
 * @property int $updated_by_id
 * @property int|null $deleted_by_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedById($value)
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "haven_roles";

    protected $fillable = [
        'name',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

    public function getAll ()
	{
        return $this->all();
    }

    public function getAllWithPagination ( $paginate )
	{
        return $this->paginate( $paginate );
    }

    public function getById ( $id )
	{
        try {
            $id = decryptParams( $id );
            return $this->where( 'id', $id )->first();
        } catch ( Exception $ex ) {
            return $ex;
        }

    }

    public function storeRole ( $inputs ) : Exception|bool
	{
        try {
            $data = [
                'name' => filter_strip_tags( $inputs->role_name ),
                'created_by_id' => filter_strip_tags( auth()->user()->id ),
                'updated_by_id' => filter_strip_tags( auth()->user()->id ),
                'deleted_by_id' => null,
            ];

            $result = $this->create( $data );

            if ( $result ) {
                foreach ( ( new Permission() )->all() as $permission ) {
                    $data = [
                        'role_id' => $result->id,
                        'permission_id' => $permission->id,
                        'view' => 0,
                        'store' => 0,
                        'update' => 0,
                        'destroy' => 0,
                        'all' => 0,
                    ];

                    ( new RolesPermission() )->create( $data );
                }
            }
            return true;

        } catch ( Exception $ex ) {
            return $ex;
        }
    }

    public function updateRole ( $request, $id ) : Exception|bool
	{
        try {
            $id = decryptParams( $id );
            $data = [
                'name' => filter_strip_tags( $request->role_name ),
                'updated_by_id' => filter_strip_tags( auth()->user()->id ),
            ];

            $result = $this->where( 'id', $id )->update( $data );

            return true;

        } catch ( Exception $ex ) {
            return $ex;
        }
    }

    public function destroyRole ( $id ) : Exception|bool
	{
        try {
            $id = decryptParams( $id );

            $this->whereIn( 'id', $id )->update( [ 'deleted_by_id' => filter_strip_tags( auth()->user()->id ) ] );
            $this->whereIn( 'id', $id )->delete();
            return true;
        } catch ( Exception $ex ) {
            return $ex;
        }
    }
}
