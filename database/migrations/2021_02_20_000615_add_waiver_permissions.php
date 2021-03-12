<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddWaiverPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view waivers' => ['Owner', 'Staff'],
            'create waivers' => ['Owner'],
            'update waivers' => ['Owner'],
            'view signatures' => ['Owner', 'Staff']
        ];

        $this->createPermissions($permissions);
    }
}
