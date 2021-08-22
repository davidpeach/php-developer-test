<?php

namespace Tests\Unit\ReqResIn;

use App\ReqResIn\ReqResInUser;
use PHPUnit\Framework\TestCase;

class ReqResInUserTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->reqResInUser = new ReqResInUser;
    }
    
    /** @test */
    public function it_has_an_external_id()
    {
        $this->reqResInUser->setExternalId('9');

        $this->assertEquals('9', $this->reqResInUser->getExternalId());
    }

    /** @test */
    public function it_can_have_a_first_name()
    {
        $this->reqResInUser->setFirstName('Steven');

        $this->assertEquals('Steven', $this->reqResInUser->getFirstName());
    }

    /** @test */
    public function it_can_have_a_last_name()
    {
        $this->reqResInUser->setLastName('Seagal');

        $this->assertEquals('Seagal', $this->reqResInUser->getLastName());
    }

    /** @test */
    public function it_can_have_an_email()
    {
        $this->reqResInUser->setEmail('test@example.com');

        $this->assertEquals(
            'test@example.com', 
            $this->reqResInUser->getEmail()
        );
    }

    /** @test */
    public function it_can_have_an_avatar()
    {
        $this->reqResInUser->setAvatar('/path/to/avatar.jpg');

        $this->assertEquals(
            '/path/to/avatar.jpg', 
            $this->reqResInUser->getAvatar()
        );
    }
}
