<?php
/**
 * Created by PhpStorm.
 * User: katrina
 * Date: 2018-04-13
 * Time: 7:23 PM
 */
include('db.php');
include("AccountClass.php");
use PHPUnit\Framework\TestCase;
class phpUnitTest extends TestCase
{
    private $mysqli;
    private $EMAIL = 'me@gmail.com';
    private $PASSWORD= 'password';
    private $FIRST_NAME = 'testUser';
    private $LAST_NAME= 'testUser';
    private $ROLE = 3;
    private $ADDRESS = '1 Fake Street';
    private $CITY = 'Kitchener';
    private $PROVINCE = 'ON';
    private $POSTAL_CODE = 'N2N2N2';
    private $PHONE_NUMBER = '1234567890';

    public function setup(){
        $db = new DB();
        $this->mysqli = $db->getConnection();
    }

    public function testRegister(){
        $account = new AccountClass($this->mysqli);
        $result = $account->addAccount(
            $this->EMAIL,
            $this->PASSWORD,
            $this->FIRST_NAME,
            $this->LAST_NAME,
            $this->ROLE);
        $this->assertEquals(true, $result);
    }

    public function testSignIn(){
        $account = new AccountClass($this->mysqli);
        $user = $account->login($this->EMAIL,$this->PASSWORD);
        $this->assertEquals($this->EMAIL, $user['Email']);
    }

    public function testGetUser(){
        $account = new AccountClass($this->mysqli);
        $user = $account->getUser($this->EMAIL);
        $this->assertEquals($this->FIRST_NAME, $user['FirstName']);
    }

    public function testUpdateUser(){
        $account = new AccountClass($this->mysqli);
        $result = $account->updateUser(
            $this->EMAIL,
            $this->FIRST_NAME,
            $this->LAST_NAME,
            $this->ADDRESS,
            $this->CITY,
            $this->PROVINCE,
            $this->POSTAL_CODE,
            $this->PHONE_NUMBER);
        $this->assertEquals(true, $result);
    }

    public function testChangePassword(){
        $account = new AccountClass($this->mysqli);
        $result = $account->changePassword($this->PASSWORD,$this->EMAIL);
        $this->assertEquals(true, $result);
    }

    public function testAddAccount(){
        $email = 'new@gmail.com';
        $password = '1234';
        $firstName = 'user1';
        $lastName = 'user1';
        $role = 1;
        $account = new AccountClass($this->mysqli);
        $result = $account->addAccount($email, $password, $firstName, $lastName, $role);
        $this->assertEquals(true, $result);
    }

    public function testDeleteAccount(){
        $account = new AccountClass($this->mysqli);
        $result = $account->deleteAccountByEmail($this->EMAIL);
        $this->assertEquals(true, $result);
    }


}
