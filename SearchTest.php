<?php

/**
 *  test case.
 */


class Search
{
    public function __construct($one, $two){}
    public function search($keyword){}
    public function isFound(){return null;}
}

require_once("PHPUnit/Autoload.php");

class SearchTest extends PHPUnit_Framework_TestCase
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
        $this->_session = new Search($dsn, false);
    }
    function SearchTesting() {
        $this->_session->search("Squiggly Squiggly"); 
        $this->assertEquals(false, $this->_session->isFound());
    }
    
}
$suite = new PHPUnit_Framework_TestSuite;
$suite->addTest(new SearchTest("testValidSearch"));
$testRunner = new PHPUnit_TextUI_TestRunner();
$testRunner->run( $suite );
