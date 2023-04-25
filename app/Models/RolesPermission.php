<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RolesPermission
 *
 * @property int $id
 * @property int|null $haven_role_id
 * @property int|null $haven_permission_id
 * @property int $view
 * @property int $store
 * @property int $update
 * @property int $destroy
 * @property int $all
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereDestroy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereHavenPermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereHavenRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereUpdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolesPermission whereView($value)
 * @mixin \Eloquent
 */
class RolesPermission extends Model
{
    use HasFactory;

    protected $table = 'haven_roles_permissions';

    protected $fillable = [ 'haven_role_id', 'haven_permission_id', 'view', 'store', 'update', 'destroy', 'all' ];

    public function getPermissions ( $id )
    {
        try {
            $id = decryptParams( $id );

            return $this->join( 'haven_permissions', 'haven_roles_permissions.haven_permission_id', '=', 'haven_permissions.id' )
                ->select( 'haven_roles_permissions.id', 'haven_roles_permissions.haven_permission_id', 'haven_permissions.name', 'haven_permissions.slug', 'haven_roles_permissions.view', 'haven_roles_permissions.store', 'haven_roles_permissions.update', 'haven_roles_permissions.destroy', 'haven_roles_permissions.all' )
                ->where( 'haven_roles_permissions.haven_role_id', $id )
                ->get();
        } catch ( Exception $ex ) {
            return $ex;
        }
    }

    public function updatePermissions ( $inputs )
    {
        try {
        //    dd( $inputs );
            foreach ( $inputs as $key => $permission ) {

                if ( $permission[ 'all' ] == 'off' ) {
                    $data = [
                        'view' => 0,
                        'store' => 0,
                        'update' => 0,
                        'destroy' => 0,
                        'all' => 0,
                    ];
                } else {
                    $data = [
                        'view' => $permission[ 'view' ] == 'on' ? 1 : 0,
                        'store' => $permission[ 'store' ] == 'on' ? 1 : 0,
                        'update' => $permission[ 'update' ] == 'on' ? 1 : 0,
                        'destroy' => $permission[ 'destroy' ] == 'on' ? 1 : 0,
                        'all' => $permission[ 'all' ] == 'on' ? 1 : 0,
                    ];
                }
//dd($data);
                $this->where( [ 'haven_role_id' => auth()->user()->haven_role_id, 'haven_permission_id' => $key ] )->update( $data );
            }
            return true;
        } catch ( Exception $ex ) {
            return $ex;
        }
    }
}
