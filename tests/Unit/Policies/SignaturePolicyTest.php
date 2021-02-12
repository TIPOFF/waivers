<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Policies;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\Waivers\Models\Signature;
use Tipoff\Waivers\Tests\TestCase;

class SignaturePolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        $user = self::createPermissionedUser('view signatures', true);
        $this->assertTrue($user->can('viewAny', Signature::class));

        $user = self::createPermissionedUser('view signatures', false);
        $this->assertFalse($user->can('viewAny', Signature::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $signature = Signature::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $signature));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => [ 'view', self::createPermissionedUser('view signatures', true), true ],
            'view-false' => [ 'view', self::createPermissionedUser('view signatures', false), false ],
            'create-true' => [ 'create', self::createPermissionedUser('create signatures', true), true ],
            'create-false' => [ 'create', self::createPermissionedUser('create signatures', false), false ],
            'update-true' => [ 'update', self::createPermissionedUser('update signatures', true), true ],
            'update-false' => [ 'update', self::createPermissionedUser('update signatures', false), false ],
            'delete-true' => [ 'delete', self::createPermissionedUser('delete signatures', true), false ],
            'delete-false' => [ 'delete', self::createPermissionedUser('delete signatures', false), false ],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $signature = Signature::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $signature));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
