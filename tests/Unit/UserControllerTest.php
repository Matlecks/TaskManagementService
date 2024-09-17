<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Redis;
use Mockery;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */    use RefreshDatabase;

    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = Mockery::mock(UserService::class);
        $this->app->instance(UserService::class, $this->userService);
    }

    public function testIndexReturnsViewWithUsers()
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
        ];

        $this->userService->shouldReceive('getAllUsersFromApi')
            ->once()
            ->andReturn(collect($users));

        $response = $this->get(route('user.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.users.index');
        $response->assertViewHas('users', collect($users));
    }
}
