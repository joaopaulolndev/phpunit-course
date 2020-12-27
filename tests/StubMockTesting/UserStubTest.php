<?php
use PHPUnit\Framework\TestCase;
use forStubMockTesting\User;

class UserStubTest extends  TestCase {

  
    public function testCreateUser()
    {
        // $user = new User;
        // $stub = $this->getMockBuilder(User::class)
        // ->getMock(); // = $this->createStub(User::class); all methods return null by default unless mocked
        // $stub->method('save')->willReturn('fake');

        // $stub = $this->getMockBuilder(User::class)
        // ->setMethods(null)
        // ->getMock(); // works like a real object

        $stub = $this->getMockBuilder(User::class)
        ->disableOriginalConstructor()
        ->setMethods(['save'])
        ->getMock();
        $stub->method('save')->willReturn(true);

        $this->assertTrue($stub->createUser('Adam', 'email@com.pl'));
        $this->assertFalse($stub->createUser('Adam', 'email'));
    }

}
