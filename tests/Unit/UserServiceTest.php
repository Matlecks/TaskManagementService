<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Redis;
use Mockery;

class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    protected $userService;

    protected function setUp(): void
    {
        parent::setUp();

        // Мокаем клиент Guzzle
        $client = Mockery::mock(Client::class);
        $this->userService = new UserService($client);
    }


    public function testGetAllUsersFromApiCachesUsers()
    {
        // Mock response from the API
        $response = new Response(200, [], json_encode(['data' => [
            ['id' => 1, 'name' => 'John Doe'],
            ['id' => 2, 'name' => 'Jane Doe'],
        ]]));

        $this->userService->client->shouldReceive('get')
            ->with('give_users')
            ->andReturn($response);

        Redis::shouldReceive('get')
            ->once()
            ->with('users_list')
            ->andReturn(null);

        Redis::shouldReceive('setex')
            ->once()
            ->with('users_list', 3600, json_encode(Mockery::type('Illuminate\Support\Collection')));

        $users = $this->userService->getAllUsersFromApi();

        $this->assertCount(2, $users);
        $this->assertEquals('John Doe', $users[0]->name);
        $this->assertEquals('Jane Doe', $users[1]->name);
    }
}
