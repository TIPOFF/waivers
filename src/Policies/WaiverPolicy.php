<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Waivers\Models\Waiver;

class WaiverPolicy
{
    use HandlesAuthorization;

    public function viewAny(UserInterface $user): bool
    {
        return $user->hasPermissionTo('view waivers');
    }

    public function view(UserInterface $user, Waiver $waiver): bool
    {
        return $user->hasPermissionTo('view waivers');
    }

    public function create(UserInterface $user): bool
    {
        return $user->hasPermissionTo('create waivers');
    }

    public function update(UserInterface $user, Waiver $waiver): bool
    {
        return $user->hasPermissionTo('update waivers');
    }

    public function delete(UserInterface $user, Waiver $waiver): bool
    {
        return false;
    }

    public function restore(UserInterface $user, Waiver $waiver): bool
    {
        return false;
    }

    public function forceDelete(UserInterface $user, Waiver $waiver): bool
    {
        return false;
    }
}
