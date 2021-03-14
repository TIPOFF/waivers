<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddWaiverPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view waivers' => ['Owner', 'Executive', 'Staff'],
            'create waivers' => ['Owner', 'Executive'],
            'update waivers' => ['Owner', 'Executive'],
            'view signatures' => ['Owner', 'Executive', 'Staff']
        ];

        $this->createPermissions($permissions);
    }
}
