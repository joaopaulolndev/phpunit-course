<?php
use PHPUnit\Framework\TestCase;


class UserTest extends  TestCase {

    use CustomAssertionTrait;


    public function testValidUserName()
    {
        $phpunit = $this;
        $user = new User('donald', 'Trump');
        $expected = 'Donald';
        $assertClosure = function ()  use ($phpunit,$expected){
            $phpunit->assertSame($expected, $this->name);
        };
        $executeAssertClosure = $assertClosure->bindTo($user, get_class($user));
        $executeAssertClosure();
        // $this->assertSame($expected, $user->name);
    }


    public function testValidUserName2() 
    {
        $user = new class('donald', 'Trump') extends User {
            public function getName()
            {
                return $this->name;
            }
        };
        $this->assertSame('Donald', $user->getName());
    }


    public function testValidDataFormat() 
    {
        $user = new User('donald', 'Trump');
        $mockedDb = new class extends Database {

            public function getEmailAndLastName()
            {
                echo 'no real db touched!';
            }
        };

        $setUserClosure = function ()  use ($mockedDb){
            $this->db = $mockedDb;
        };
        $executeSetUserClosure = $setUserClosure->bindTo($user, get_class($user));
        $executeSetUserClosure();

        $this->assertSame('Donald Trump', $user->getFullName());
    }

 
    public function testPasswordHashed()
    {
        $phpunit = $this;
        $user = new User('donald', 'Trump');
        $expected = 'password hashed!';
        $assertClosure = function ()  use ($phpunit,$expected){
            $phpunit->assertSame($expected, $this->hashPassword());
        };
        $executeAssertClosure = $assertClosure->bindTo($user, get_class($user));
        $executeAssertClosure();
    }


    public function testPasswordHashed2() 
    {
        $user = new class('donald', 'Trump') extends User {
            public function getHashedPassword()
            {
                return $this->hashPassword();
            }
        };
        $this->assertSame('password hashed!', $user->getHashedPassword());
    }

 
    public function testCustomDataStructure()
    {
        $data = [
            'nick' => 'Dolar',
            'email' => 'donald@trump.mxn',
            'age' => 70
        ];
        $this->assertArrayData($data);
    }

    public function testSomeOperation()
    {
        $user = new User('donald', 'Trump'); // move to setUp() method & use 'this->' operator == your homework
        $this->assertEquals('ok!', $user->someOperation([1,2,3]));
    }

}
