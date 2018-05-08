<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	private $userInfo = [
		'email' 	=> 'example@email.com',
		'password'  => '12345678',
	];

    public function testLogin() {    	
    	$response = $this->json('POST', '/api/v1/login', $this->userInfo);

    	$response->assertStatus(200);

    	//TODO: Must compare with JWTAuth
    	$data = $response->json();
    	$this->assertTrue(isset($data['token_access']));
    }

    public function testLoginFail()
    {
        $userInfo = [
    		'email' 	=> 'example@email.com',
    		'password'  => 'fail',
    	];

    	$response = $this->json('POST', '/api/v1/login', $userInfo);

    	$response->assertStatus(422)->assertJson([
    		'message' => 'Email or password is incorrect !'
		]);
    }

    public function testUserInfo() {
    	$headers = ['token_access' => $this->getTokenAccess()];

    	$response = $this->json('GET', '/api/v1/me', [], $headers);

    	$response->assertStatus(200)->assertJsonStructure([
    		'user' => [
	    		'id',
				'name',
				'address',
				'age',
				'email',
				'tel',
				'created_at',
				'updated_at',
			]
		]);
    }

    public function testUpdateUserInfo() {
    	$headers = ['token_access' => $this->getTokenAccess()];
    	$timeNow = date('Y-m-d H:i:s');

    	$userDataToUpdate = [
    		'name'    => 'DoanhHT',
			'address' => 'Hải Dương - Việt Nam',
			'age'     => '28',
			'tel' 	  => '+8472841796',
			'updated_at' => $timeNow
    	];

    	$response = $this->json('PUT', '/api/v1/me', $userDataToUpdate, $headers);

    	$response->assertStatus(200)->assertJson([
    		'user' => [
	    		'id' 		 => '5',
				'name' 		 => 'DoanhHT',
				'address' 	 => 'Hải Dương - Việt Nam',
				'age' 		 => '28',
				'email' 	 => 'example@email.com',
				'tel' 		 => '+8472841796',
				'created_at' => '',
				'updated_at' => $timeNow,
			]
		]);
    }

    public function testLogout() {
    	$headers = ['token_access' => $this->getTokenAccess()];

    	$response = $this->json('GET', '/api/v1/logout', [], $headers);

    	$response->assertStatus(200)->assertJson([
    		'message' => 'Logout successfully.'
		]);
    }

    public function testTokenIsRequired() {
    	$headers = [];

    	$response = $this->json('GET', '/api/v1/me', [], $headers);

    	$response->assertStatus(400)->assertJson([
    		'error' => 'Token access is required !'
		]);
    }

    public function testTokenIsInvalid() {
    	$headers = ['token_access' => '$2y$10$O7QWm3aimqQAp1z1TOAIeOJthXTUTQgZeUOZIjpajWP1R6ZCTBKhK'];

    	$response = $this->json('GET', '/api/v1/me', [], $headers);

    	$response->assertStatus(400)->assertJson([
    		'error' => 'Wrong number of segments'
		]);
    }

    //TODO: Must save token_access to reuse
    private function getTokenAccess() {
    	$userInfo = [
    		'email' 	=> 'example@email.com',
    		'password'  => '12345678',
    	];

    	$response = $this->json('POST', '/api/v1/login', $userInfo);
    	$data 	  = $response->json();

    	return $data['token_access'];
    }
}
