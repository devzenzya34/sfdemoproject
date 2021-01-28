<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UnitTest extends TestCase
{
    public function testUser()
    {
        $user = new User();
        $user->setFirstName('Andry');

        $this->assertTrue($user->getFirstName() === 'Andry' );
    }
}

