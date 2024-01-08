<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class QuoteTest extends TestCase
{
  use RefreshDatabase;

  private $typeAuthorization = 'Bearer ';
  private $header = ['Accept' => 'application/json'];

  private $routeLogin = '/api/login';
  private $userEmail = 'normal@user.com';
  private $userPass = '123abc';
  private $token = '';
  private $user;

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
      'message',
    ]);

    $this->token = $responseLogin['data']['token'];

    $this->user = User::where('email', $this->userEmail)->get()->first();

    Favorite::create([
      'quote' => 'test Quote1',
      'userId' => $this->user->id
    ]);
    Favorite::create([
      'quote' => 'test Quote2',
      'userId' => $this->user->id
    ]);
    Favorite::create([
      'quote' => 'test Quote3',
      'userId' => $this->user->id
    ]);
  }

  public function test_get_quotes()
  {
    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->getJson('/api/quotes');
    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [],
      'message',
    ]);
  }

  public function test_get_quotes_with_amount_number()
  {
    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->getJson('/api/quotes?amount=10');
    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [],
      'message',
    ]);
  }

  public function test_favorites()
  {
    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->getJson('/api/my-favorites/' . $this->user->id);
    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [
        [
          'id',
          'quote',
          'userId',
        ]
      ],
      'message',
    ]);
    $response->assertJson(
      fn (AssertableJson $json) => $json
        ->has('success')
        ->has('data')
        ->has('message')
    );
  }

  public function test_add_favorite()
  {
    $body = [
      "quote" => 'Quote prueba'
    ];
    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->postJson('/api/add-favorite/' . $this->user->id, $body);

    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data' => [
        'id',
        'quote',
        'userId',
      ],
      'message',
    ]);
  }

  public function test_delete_favorite()
  {
    $favorite = Favorite::create([
      'quote' => 'Test Quote delete',
      'userId' => $this->user->id
    ]);

    $response = $this->withHeaders([
      'Authorization' => $this->typeAuthorization . $this->token
    ])->deleteJson("/api/delete-favorite/$favorite->id");

    $response->assertStatus(200);
    $response->assertJsonStructure([
      'success',
      'data',
      'message'
    ]);
  }
}
