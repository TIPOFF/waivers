<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Waivers\Models\Signature;

class SignaturePolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view signatures') ? true : false;
    }

    public function view(UserInterface $user, Signature $signature): bool
    {
        return $user->hasPermissionTo('view signatures') ? true : false;
    }

    public function create(UserInterface $user): bool
    {
        return false;
    }

    public function update(UserInterface $user, Signature $signature): bool
    {
        return false;
    }

    public function delete(UserInterface $user, Signature $signature): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Signature $signature): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Signature $signature): bool
    {
        return false;
    }
}
