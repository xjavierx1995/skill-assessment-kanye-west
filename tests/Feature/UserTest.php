<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
  use RefreshDatabase;

  private $typeAuthorization = 'Bearer ';
  private $header = ['Accept' => 'application/json'];

  private $routeLogin = '/api/login';
  private $userEmail = 'admin@user.com';
  private $userPass = 'admin';
  private $token = '';

  public function setUp(): void
  {
    parent::setUp();
    Artisan::call('migrate', ['-vvv' => true]);
    Artisan::call('passport:install', ['-vvv' => true]);
    Artisan::call('db:seed', ['-vvv' => true]);

    $body = [
      'email' => $this->userEmail,
      'password' => $this->userPass
    ];
    $responseLogin = $this->postJson($this->routeLogin, $body, $this->header);
    $responseLogin->assertStatus(200);
    $responseLogin->assertJsonStructure([
      'success',
      'data' => [
        'token',
        'user' => [
          'id',
          'name',
          'email',
          'isAdmin',
          'canLogin',
        ],
      ],
      'message'
    ]);

    $this->token = $responseLogin['data']['token'];
  }

  public function test_update_user()
  {
    $body = [
      'email' => 'normal@user.com',
      'password' => '123abc'
    ];
    $responseLogin = $this->postJson($this->routeLogin, $body, $this->header);
    $responseLogin->assertStatus(200);
    $responseLogin->assertJsonStructure([
      'success',
      'data' => [
        'token',
        'user' => [
          'id',
          'name',
          'email',
          'isAdmin',
          'canLogin',
        ],
      ],
      'message',
    ]);

    $token = $responseLogin['data']['token'];
    $userId = $responseLogin['data']['user']['id'];

    $bodyEdit = [
      'name' => 'Normal user edit'
    ];

    $responseUser = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $token
    ])->putJson("/api/update-user/$userId", $bodyEdit, $this->header);
    $responseUser->assertStatus(200);
    $responseUser->assertJsonStructure([
      'success',
      'data' => [
        'id',
        'name',
        'email',
        'isAdmin',
        'canLogin',
      ],
      'message',
    ]);
  }

  public function test_get_users()
  {
    User::create([
      'name' => 'Fake Test 1',
      'email' => ('fake1@test.com'),
      'password' => bcrypt('123abc'),
      'isAdmin' => false,
      'canLogin' => true,
    ]);
    User::create([
      'name' => 'Fake Test 2',
      'email' => ('fake2@test.com'),
      'password' => bcrypt('123abc'),
      'isAdmin' => false,
      'canLogin' => true,
    ]);
    User::create([
      'name' => 'Fake Test 3',
      'email' => ('fake3@test.com'),
      'password' => bcrypt('123abc'),
      'isAdmin' => false,
      'canLogin' => true,
    ]);
    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->getJson('/api/get-users');
    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [
        '*' => [
          'id',
          'name',
          'email',
          'isAdmin',
          'canLogin',
          'favorites' => [],
        ],
      ],
      'message',
    ]);
  }

  public function test_block_user()
  {
    $user = User::create([
      'name' => 'Fake Test 1',
      'email' => ('fake1@test.com'),
      'password' => bcrypt('123abc'),
      'isAdmin' => false,
      'canLogin' => true,
    ]);

    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->putJson("/api/block-user/$user->id");

    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [
        'id',
        'name',
        'email',
        'isAdmin',
        'canLogin',
      ],
      'message'
    ]);
  }

  public function test_unlock_user()
  {
    $user = User::create([
      'name' => 'Fake Test 1',
      'email' => ('fake1@test.com'),
      'password' => bcrypt('123abc'),
      'isAdmin' => false,
      'canLogin' => false,
    ]);

    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->putJson("/api/unlock-user/$user->id");

    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [
        'id',
        'name',
        'email',
        'isAdmin',
        'canLogin',
      ],
      'message'
    ]);
  }
}
