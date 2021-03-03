<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Tests\Unit\Policies;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tipoff\Waivers\Models\Waiver;
use Tipoff\Waivers\Tests\TestCase;
use Tipoff\Support\Contracts\Models\UserInterface;
use Tipoff\TestSupport\Models\User;

class WaiverPolicyTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function view_any()
    {
        /** @var User $authorizedUser */
        $authorizedUser = self::createPermissionedUser('view waivers', true);

        /** @var User $unauthorizedUser */
        $unauthorizedUser = self::createPermissionedUser('view waivers', false);

        $this->assertTrue($authorizedUser->can('viewAny', Waiver::class));
        $this->assertFalse($unauthorizedUser->can('viewAny', Waiver::class));
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_as_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_as_creator(string $permission, UserInterface $user, bool $expected)
    {
        $waivers = Waiver::factory()->make([
            'creator_id' => $user,
        ]);

        $this->assertEquals($expected, $user->can($permission, $waivers));
    }

    public function data_provider_for_all_permissions_as_creator()
    {
        return [
            'view-true' => ['view', self::createPermissionedUser('view waivers', true), true],
            'view-false' => ['view', self::createPermissionedUser('view waivers', false), false],
            'create-true' => ['create', self::createPermissionedUser('create waivers', true), true],
            'create-false' => ['create', self::createPermissionedUser('create waivers', false), false],
            'update-true' => ['update', self::createPermissionedUser('update waivers', true), true],
            'update-false' => ['update', self::createPermissionedUser('update waivers', false), false],
            'delete-true' => ['delete', self::createPermissionedUser('delete waivers', true), false],
            'delete-false' => ['delete', self::createPermissionedUser('delete waivers', false), false],
        ];
    }

    /**
     * @test
     * @dataProvider data_provider_for_all_permissions_not_creator
     * @param string $permission
     * @param UserInterface $user
     * @param bool $expected
     */
    public function all_permissions_not_creator(string $permission, UserInterface $user, bool $expected)
    {
        $waivers = Waiver::factory()->make();

        $this->assertEquals($expected, $user->can($permission, $waivers));
    }

    public function data_provider_for_all_permissions_not_creator()
    {
        // Permissions are identical for creator or others
        return $this->data_provider_for_all_permissions_as_creator();
    }
}
