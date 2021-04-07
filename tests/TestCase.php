<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

//        $this->withoutExceptionHandling();
    }

    public function JWTActingAs(User $user)
    {
        $this->withHeaders(['Authorization' => 'Bearer '. auth('api')->login($user)]);

        return $this;
    }
}
