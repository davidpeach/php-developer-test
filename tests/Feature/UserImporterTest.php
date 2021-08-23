<?php

namespace Tests\Feature;

use App\ReqResIn\ReqResInApi;
use App\ReqResIn\ReqResInUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class UserImporterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_be_imported()
    {
        // given there is an api with known response
        $rawUserA = new ReqResInUser;
        $rawUserA->setExternalId('7');
        $rawUserA->setEmail('michael.lawson@reqres.in');
        $rawUserA->setFirstName('Michael');
        $rawUserA->setLastName('Lawson');
        $rawUserA->setAvatar('https://reqres.in/img/faces/7-image.jpg');

        $rawUserB = new ReqResInUser;
        $rawUserB->setExternalId('8');
        $rawUserB->setEmail('lindsay.ferguson@reqres.in');
        $rawUserB->setFirstName('Lindsay');
        $rawUserB->setLastName('Ferguson');
        $rawUserB->setAvatar('https://reqres.in/img/faces/8-image.jpg');

        $rawUsers = collect([
            $rawUserA,
            $rawUserB,
        ]);

        $this->instance(
            ReqResInApi::class,
            Mockery::mock(ReqResInApi::class, function (MockInterface $mock) use ($rawUsers) {
                $mock->shouldReceive('getUsers')
                    ->once()
                    ->andReturn($rawUsers);
            })
        );

        // when calling console command
        $this->artisan('jump:users:import');

        // see that the data is saved correctly
        $this->assertDatabaseHas('users', [
            'external_id' => '7',
            'first_name' => 'Michael',
            'last_name' => 'Lawson',
            'email' => 'michael.lawson@reqres.in',
            'avatar' => 'https://reqres.in/img/faces/7-image.jpg',
        ]);

        $this->assertDatabaseHas('users', [
            'external_id' => '8',
            'first_name' => 'Lindsay',
            'last_name' => 'Ferguson',
            'email' => 'lindsay.ferguson@reqres.in',
            'avatar' => 'https://reqres.in/img/faces/8-image.jpg',
        ]);
    }

    /** @test */
    public function users_can_be_imported_from_a_specific_page_of_the_api()
    {
        Http::fake();

        $this->artisan('jump:users:import --page=2');

        Http::assertSent(function (Request $request) {
            return $request->url() === config('services.req_res_in.base_url') . '/users?page=2';
        });
    }

    /** @test */
    public function the_default_page_of_the_api_is_page_1()
    {
        Http::fake();

        $this->artisan('jump:users:import');

        Http::assertSent(function (Request $request) {
            return $request->url() === config('services.req_res_in.base_url') . '/users?page=1';
        });
    }
}
