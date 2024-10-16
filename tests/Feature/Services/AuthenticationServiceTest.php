<?php

namespace Services;

use App\Models\User;
use App\Services\AuthenticationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthenticationServiceTest extends TestCase
{
    use RefreshDatabase;

    private AuthenticationService $service;
    private const EMAIL = 'akbar.4193250003@mhs.unimed.ac.id';

    protected function setUp(): void
    {
        parent::setUp();
        $this->markTestSkipped('This is manual tests');

        /** @var AuthenticationService $authService */
        $authService = app(AuthenticationService::class);
        $this->service = $authService;
    }

    public function test_sendResetPasswordEmail()
    {
        // NOTE: DON'T FORGET TO CHANGE MAIL_MAILER to smtp in phpunit.xml
        // Otherwise, it won't send any email
        $user = User::updateOrCreate(['id' => '4193250003'], [
            'name' => 'Akbar Ganteng',
            'email' => self::EMAIL,
        ]);

        $status = $this->service->sendResetPasswordEmail($user->email);
        self::assertEquals(Password::RESET_LINK_SENT, $status);
    }

    public function test_resetPassword()
    {
        $email = self::EMAIL;
        $newPassword = 'newpassworkd';
        // token from email
        $token = 'b518420a0c8863b0a91639dc30c0f712f3c0e1f49bfebfba93d20d7ec1094a59';

        $status = $this->service->resetPassword($email, $newPassword, $token);
        self::assertEquals(Password::PASSWORD_RESET, $status);
    }
}
