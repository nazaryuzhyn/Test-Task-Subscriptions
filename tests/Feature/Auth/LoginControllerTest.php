<?php

namespace Tests\Feature\Auth;

use App\Modules\Users\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => 'Pa$$w0rd',
        ]);
    }

    /**
     * Test login user.
     *
     * @return void
     */
    public function testLoginWithValidDataSuccessful(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => 'Pa$$w0rd',
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'user',
            ],
        ]);
    }

    /**
     * Test login user with wrong password.
     *
     * @return void
     */
    public function testLoginWithWrongPassword(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertUnauthorized();
        $response->assertJsonFragment([
            'message' => 'Email or password is incorrect',
        ]);
    }

    /**
     * Test login user with wrong email.
     *
     * @return void
     */
    public function testLoginWithWrongEmail(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => 'wrong@email.com',
            'password' => 'Pa$$w0rd',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonFragment([
            'message' => 'The selected email is invalid.',
            'errors' => [
                'email' => ['The selected email is invalid.'],
            ],
        ]);
    }

    /**
     * Test login user with not valid data.
     *
     * @return void
     */
    public function testLoginWithNotValidDataFails(): void
    {
        $response = $this->postJson(route('login'), [
            'email' => 'wrong@email.com',
            'password' => 'wrong-password',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonFragment([
            'message' => 'The selected email is invalid.',
            'errors' => [
                'email' => ['The selected email is invalid.'],
            ],
        ]);
    }
}
