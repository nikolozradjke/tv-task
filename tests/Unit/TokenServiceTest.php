<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Services\UserAuthTokenService;

class TokenServiceTest extends TestCase
{
    public function test_generateTokens()
    {
        $mockHttp = Mockery::mock('alias:Illuminate\Support\Facades\Http');
        $mockHttp->shouldReceive('post')
            ->once()
            ->withArgs(function ($url, $data) {
                return $url === env('APP_URL') . '/oauth/token' &&
                    $data['grant_type'] === 'password' &&
                    $data['username'] === 'test@example.com';
            })
            ->andReturn(Mockery::mock()->makePartial()->shouldReceive('json')->andReturn([
                'access_token' => 'fake-access-token',
                'token_type' => 'bearer',
                'expires_in' => 3600,
                'refresh_token' => 'fake-refresh-token',
            ])->getMock());

        $email = 'test@example.com';
        $password = 'password123';
        $response = app(UserAuthTokenService::class)->generateTokens($email, $password);

        $responseData = $response->json();
        $this->assertEquals('fake-access-token', $responseData['access_token']);
        $this->assertEquals('bearer', $responseData['token_type']);
        $this->assertEquals(3600, $responseData['expires_in']);
    }
}
