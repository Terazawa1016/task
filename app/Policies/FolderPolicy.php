<?php

namespace App\Policies;

use App\Models\User;
use App\Folder;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //フォルダの閲覧権限
    public function view(User $user, Folder $folder)
    {
      return $user->id === $folder->user_id;
    }
}
