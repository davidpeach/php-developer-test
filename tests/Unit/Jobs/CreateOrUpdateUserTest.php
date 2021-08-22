<?php

namespace Tests\Unit\Jobs;

use App\Jobs\UpdateOrCreateUser;
use App\ReqResIn\ReqResInUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateOrUpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_save_a_new_user()
    {
        $rawUser = new ReqResInUser;
        $rawUser->setExternalId('7');
        $rawUser->setEmail('michael.lawson@reqres.in');
        $rawUser->setFirstName('Michael');
        $rawUser->setLastName('Lawson');
        $rawUser->setAvatar('https://reqres.in/img/faces/7-image.jpg');

        UpdateOrCreateUser::dispatch($rawUser);

        $this->assertDatabaseHas('users', [
            'external_id' => '7',
            'first_name' => 'Michael',
            'last_name' => 'Lawson',
            'email' => 'michael.lawson@reqres.in',
            'avatar' => 'https://reqres.in/img/faces/7-image.jpg',
        ]);
    }
}
