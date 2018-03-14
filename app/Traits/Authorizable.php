<?php

namespace App\Traits;

use Log;

trait Authorizable
{
    public function grantRoleDefaultPermissions(Array $data)
    {
        // if ( $data['user_id'] == null || $data['division'] == null || $data['role'] == null ) {
        //     return false;
        // }

        // $division = \App\Models\Lists\Division::where('name_eng_short', $data['division'])->first();

        // if ( $division == null ) {
        //     return false;
        // }

        $user = \App\User::find($data['user_id']);

        if ( $user == null || $user->division == null ) {
            return false;
        }

        switch ($data['role']) {
            case 'MD':
            case 'resident':
            case 'fellow':
            case 'staff':
                $permission = \App\Permission::where('name', 'create-note')->first();
                $this->grant($user->id, $permission->id, $user->division->id, 1);
                $permission = \App\Permission::where('name', 'view-all-note')->first();
                $this->grant($user->id, $permission->id, $user->division->id, 1);
                $user->dashboard = 'notes';
                break;
            case 'coder':
            case 'admin':
            case 'sa':
            default:
                break;
        }

        return $user->save();
    }

    public function grant($userId, $permissionId, $divisionId, $grantorId, $validUntil = null)
    {
        $auth = \App\Authorize::insert([
                  'user_id' => $userId,
               'granted_by' => $grantorId,
              'valid_until' => $validUntil,
              'division_id' => $divisionId,
            'permission_id' => $permissionId,
        ]);
    }

    public function grantRoleDefaultCanCreateNotes(array $data) {
        // if ($data['user_id'] == null || $data['division'] == null || $data['role'] == null) {
        //     return false;
        // }

        // $division = \App\Models\Lists\Division::where('name_eng_short', $data['division'])->first();

        // if ($division == null) {
        //     return false;
        // }

        $user = \App\User::find($data['user_id']);

        if ($user == null || $user->division == null) {
            return false;
        }

        switch ($data['role']) {
            case 'MD':
            case 'resident':
            case 'fellow':
            case 'staff':
                $user->canCreateNotes()->attach($user->division->noteTypes->pluck('id')->toArray());
                break;
            default:
                break;
        }

        // return $user->save();
    }

    // protected function validateData()
    // {
    //     if ($data['user_id'] == null || $data['division'] == null || $data['role'] == null) {
    //         return false;
    //     }

    //     $division = \App\Models\Lists\Division::where('name_eng_short', $data['division'])->first();

    //     if ($division == null) {
    //         return false;
    //     }
    // }
}
