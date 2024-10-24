<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class SignupControllerTest extends TestCase
{
    protected array $userData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'name' => 'Test User',
            'email' => 'email@example.com',
            'password' => 'Password1#',
            'password_confirmation' => 'Password1#',
        ];
    }

    /**
     * Test sign up user.
     *
     * @return void
     */
    public function testSignUpWithValidDataSuccessful(): void
    {
        $response = $this->postJson(route('signup'), $this->userData);

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'user',
            ],
        ]);
    }

    /**
     * Test sign up user with not valid data.
     *
     * @return void
     */
    public function testSignUpWithNotValidDataFails(): void
    {
        $this->userData['email'] = 'notValid';

        $response = $this->postJson(route('signup'), $this->userData);

        $response->assertUnprocessable();
        $response->assertJsonStructure([
            'errors' => [
                'email',
            ],
            'message'
        ]);
    }
}
