<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userTest
 *
 * @author Ming Huang
 */
class Login {
    public function __construct($one, $two){}
    public function login(){}
    public function isLoggedIn() {return null;}
}

require_once("PHPUnit/Autoload.php");

class TestLogin extends PHPUnit_Framework_TestCase {

    private $_session;

    function setUp() {
        $dsn = array(
            'phptype' => "mysql",
            'hostspec' => "localhost",
            'database' => "unishare",
            'username' => "root",
            'password' => ""
        );
        $this->_session = new Login($dsn, false);
    }

    function testValidLogin() {
        $this->_session->login("sdfdfs@autuni.ac.nz", "what78"); // examples
        $this->assertEquals(true, $this->_session->isLoggedIn());
    }

    function testInvalidLogin() {
        $this->_session->login("sdfjofd@atuni.ac.nz", "4345"); // should make a fail for login
        $this->assertEquals(false, $this->_session->isLoggedIn());
    }
}
$suite = new PHPUnit_Framework_TestSuite;
$suite->addTest(new TestLogin("testValidLogin"));
$suite->addTest(new TestLogin("testInvalidLogin"));
$testRunner = new PHPUnit_TextUI_TestRunner();
$testRunner->run( $suite );
