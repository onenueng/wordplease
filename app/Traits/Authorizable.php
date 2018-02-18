<?php

namespace App\Traits;

use Log;

trait Authorizable
{
    public function grantRoleDefaultPermissions(Array $data)
    {
        if ( $data['user_id'] == null || $data['division'] == null || $data['role'] == null ) {
            return false;
        }

        $division = \App\Models\Lists\Division::where('name_eng_short', $data['division'])->first();

        if ( $division == null ) {
            return false;
        }

        $user = \App\User::find($data['user_id']);

        switch ($data['role']) {
            case 'MD':
            case 'resident':
            case 'fellow':
            case 'staff':
                $permission = \App\Permission::where('name', 'create-note')->first();
                $this->grant($user, $permission, $division);
                $permission = \App\Permission::where('name', 'view-all-note')->first();
                $this->grant($user, $permission, $division);
                break;
            
            default:
                break;
        }

        return true;
    }

    public function grant($user, $permission, $division)
    {
        $auth = \App\Authorize::insert([
            'permission_id' => $permission->id,
            'division_id' => $division->id,
        ]);
        
        $user->authorizes()->attach($auth);
    }
}
