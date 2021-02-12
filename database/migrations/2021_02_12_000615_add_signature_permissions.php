<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\PermissionRegistrar;

class AddSignaturePermissions extends Migration
{
    public function up()
    {
        if (app()->has(Permission::class)) {
            app(PermissionRegistrar::class)->forgetCachedPermissions();

            foreach ([
                         'view signatures',
                         'create signatures',
                         'update signatures',
                         'delete signatures'
                     ] as $name) {
                app(Permission::class)::findOrCreate($name, null);
            };
        }
    }
}
