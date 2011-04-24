<?php

require_once("class.autoloader.inc.php");

/**
 * This tests Lunr's Autoloader class
 * @covers Autoloader
 */
class AutoloaderTest extends PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        set_include_path(
            get_include_path() . ":" .
            "application/controllers:" .
            "application/views"
        );
        require_once("class.view.inc.php");
        require_once("class.model.inc.php");
    }

    /**
     * Test the static function add_include_path()
     * @covers Autoloader::add_include_path
     */
    public function testAddIncludePath()
    {
        $path_before = get_include_path();
        Autoloader::add_include_path("LunrUnitTestString");
        $path_after = get_include_path();
        $this->assertEquals($path_before . ":LunrUnitTestString", $path_after);
    }

    /**
     * Test the static function register_project_controller()
     * @dataProvider controllerProvider
     * @covers Autoloader::register_project_controller
     */
    public function testRegisterProjectController($input, $expected)
    {
        $autoloader_reflection = new ReflectionClass("Autoloader");

        $properties = $autoloader_reflection->getStaticProperties();
        $controllers_base = $properties["controllers"];

        Autoloader::register_project_controller($input);
        $properties = $autoloader_reflection->getStaticProperties();
        $controllers_after = $properties["controllers"];

        $controllers_base[] = $expected;

        $this->assertEquals($controllers_base, $controllers_after);
    }

    /**
     * Test the static function load to autoload classes
     * @dataProvider fileProvider
     * @covers Autoloader::load
     */
    public function testLoad($file, $filename)
    {
        $basename = str_replace("tests/system/libraries/core", "", dirname(__FILE__));
        $filename = $basename . $filename;

        $this->assertFalse(in_array($filename, get_included_files()));
        Autoloader::load($file);
        $this->assertTrue(in_array($filename, get_included_files()));
    }

    public function controllerProvider()
    {
        return array(array("lunr", "lunr"), array("Lunr", "lunr"));
    }

    public function fileProvider()
    {
        return array(
                    array("HomeView", "application/views/view.home.inc.php"),
                    array("Controller", "system/libraries/core/class.controller.inc.php"),
                    array("WebController", "system/libraries/core/class.webcontroller.inc.php"),
                    array("JsonInterface", "system/libraries/core/interface.json.inc.php"),
                    array("SessionModel", "system/models/model.session.inc.php"),
                    array("NewsController", "application/controllers/controller.news.inc.php")
        );
    }

}

?>