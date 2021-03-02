<?php

declare(strict_types=1);

use Tipoff\Authorization\Permissions\BasePermissionsMigration;

class AddWaiverPermissions extends BasePermissionsMigration
{
    public function up()
    {
        $permissions = [
            'view waivers',
            'create waivers',
            'update waivers',
            'view signatures',
        ];

        $this->createPermissions($permissions);
    }
}
