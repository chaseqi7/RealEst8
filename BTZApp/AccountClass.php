<?php
/**
 * Author: Brian Treichel, Ting Ting Lin, Ziming Qi
 * Purpose: Conestoga College Winter 2018 Capstone Project
 * Date created: 2018-04-07
 * File name: AccountClass.php
 */

class AccountClass
{
    private $userId = 0;
    private $email ='';
    private $firstname = '';
    private $lastname = '';
    private $role = 3; // role 3 is client
    private $mysqli;

    function __construct($mysqli)
    {
        $this->mysqli=$mysqli;
    }

    public function login($email,$password){
        $result = $this->mysqli->query("SELECT * FROM UserT JOIN Role 
                                WHERE UserT.Role = Role.RoleID AND UserT.Email='$email'");

        if ( $result->num_rows > 0 ){ // User doesn't exist
            $user = $result->fetch_assoc();
            if ( password_verify($password, $user['Password'])) {
                return $user;
            }
            else {
                return null;
            }
        }
        else { // Email not exist
            return null;
        }
    }

    public function ifUserExist($email){
        $result = $this->mysqli->query("SELECT * FROM UserT JOIN Role 
                                WHERE UserT.Role = Role.RoleID AND UserT.Email='$email'");
        // We know user email exists if the rows returned are more than 0
        if ($result->num_rows > 0) {
            return true;
        }
        else{
            return false;
        }
        return false;
    }

    public function isNotClient($email){
        $result = $this->mysqli->query("
                SELECT * FROM UserT JOIN Role 
                WHERE UserT.Role = Role.RoleID 
                AND Role.Description != 'Client'
                AND UserT.Email='$email'");

        if ($result->num_rows > 0) {
            return true;
        }
        else{
            return true;
        }
    }

    public function getUser($email){
        $result = $this->mysqli->query("SELECT * FROM UserT WHERE Email='$email'");
        // We know user email exists if the rows returned are more than 0
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        }
        else{
            return null;
        }
        return null;
    }

    public function addAccount($email,$password,$firstname,$lastname,$role){
        $hashedPassword = $this->mysqli->escape_string(password_hash($password,PASSWORD_DEFAULT));
        $result = $this->mysqli->query("INSERT INTO UserT (Email,Password,FirstName,LastName,Role)
            VALUES ('$email','$hashedPassword','$firstname','$lastname',$role)");
        if ($result)
        {
            if ($this->isNotClient($email)){
                $user = $this->getUser($email);
                $userID = $user["UserID"];
                $resultAddAgent = $this->mysqli->query("INSERT INTO AdminAndAgent (UserID) VALUES ($userID)");
                if ($resultAddAgent)
                {
                    return true;
                }
                else {
                    return false;
                }
            }
            else{
                return true;
            }
        }
        else {
            return false;
        }
    }

    public function updateUser($email,$firstname,$lastname,$address,$city,$province,$postalcode,$phone){
        $sql = $sql = "UPDATE userT SET FirstName='$firstname', LastName='$lastname', Address='$address',
        City='$city', Province='$province', PostalCode='$postalcode',
        PhoneNumber='$phone' WHERE Email='$email'";

        // Add user to the database
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
        return false;
    }

    public function deleteAccount($email){
        $user = $this->getUser($email);
        $userID = $user["UserID"];
        if ($this->isNotClient($email)){
            $result = $this->mysqli->query("DELETE FROM AdminAndAgent WHERE UserID=$userID");
            if ($result)
            {
                $resultDeleteUser = $this->mysqli->query("DELETE FROM UserT WHERE UserID=$userID");
                if ($resultDeleteUser)
                {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else{
            $resultDeleteUser = $this->mysqli->query("DELETE FROM UserT WHERE UserID=$userID");
            if ($resultDeleteUser)
            {
                return true;
            }
            else {
                return false;
            }
        }
    }

    public function changePassword($newPassword,$email){
        $hashedPassword = $this->mysqli->escape_string(password_hash($newPassword,PASSWORD_DEFAULT));
        $sql = "UPDATE userT SET Password='$hashedPassword' WHERE Email='$email'";

        if ($this->mysqli->query($sql)) {
            return true;
        } else { // Email doesn't already exist in a database, proceed...
            return false;
        }
        return false;
    }


}