<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthTest extends TestCase
{
  use RefreshDatabase;

  private $typeAuthorization = 'Bearer ';
  private $header = ['Accept' => 'application/json'];

  private $routeLogin = '/api/login';
  private $userEmail = 'normal@user.com';
  private $userPass = '123abc';

  public function setUp(): void
  {
    parent::setUp();
    Artisan::call('migrate', ['-vvv' => true]);
    Artisan::call('passport:install', ['-vvv' => true]);
    Artisan::call('db:seed', ['-vvv' => true]);
  }

  public function test_login()
  {
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
  }

  public function test_register()
  {
    $body = [
      'name' => 'Fake user',
      'email' => 'fake@test.com',
      'password' => 'userFake',
      'c_password' => 'userFake',
    ];
    $responseLogin = $this->postJson('/api/register', $body, $this->header);
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
  }

  /* public function test_edit_user()
  {
    $body = [
      'email' => $this->userEmail,
      'password' => $this->userPass
    ];
    $responseLogin = $this->postJson($this->routeLogin, $body, $this->header);
    $responseLogin->assertStatus(200);
    $responseLogin->assertJsonStructure(['user', 'access_token']);

    $token = $responseLogin['access_token'];
    $userId = $responseLogin['user']['id'];

    $bodyEdit = [
      'email' => 'admin@edit.com',
      'name' => 'admin edit'
    ];

    $responseUser = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $token
    ])->postJson("/api/editUser/$userId", $bodyEdit, $this->header);
    $responseUser->assertStatus(200);
    $responseUser->assertJsonStructure(['user', 'access_token']);
    $responseUser->assertJsonStructure([
      'user' => [
        'id',
        'name',
        'role',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at'
      ],
    ]);
    $responseUser
      ->assertJsonFragment([
        'email' => 'admin@edit.com',
        'name' => 'admin edit'
      ]);
  } */
}
