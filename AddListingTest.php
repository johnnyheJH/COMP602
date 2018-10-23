<?php

/**
 *  test case.
 */


class AddListing
{
    public function __construct($one, $two){}
    public function addlisting($book_title, $author, $book_description, $edition, $year, $price){}
    public function isAdded(){return null;}
}

require_once("PHPUnit/Autoload.php");

class AddListingTest extends PHPUnit_Framework_TestCase
{
    private $_session;
    
    function setUp() 
    {
        $dsn = array(
            'phptype' => "mysql",
            'hostspec' => "localhost",
            'database' => "unishare",
            'username' => "root",
            'password' => ""
        );
        $this->_session = new AddListing($dsn, false);
    }
    function testValidAdding() {
        $this->_session->addlisting("Introduction to Astronomy", "Mike Davis", "Science", "7th Edition", "2016", "$23.99"); 
        $this->assertEquals(false, $this->_session->isAdded());
    }
    
}
$suite = new PHPUnit_Framework_TestSuite;
$suite->addTest(new AddListingTest("testValidAdd"));
$testRunner = new PHPUnit_TextUI_TestRunner();
$testRunner->run( $suite );
