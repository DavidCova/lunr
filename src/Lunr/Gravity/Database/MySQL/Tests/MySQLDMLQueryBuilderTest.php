<?php

/**
 * This file contains the MySQLDMLQueryBuilderTest class.
 *
 * PHP Version 5.3
 *
 * @package    Lunr\Gravity\Database\MySQL
 * @author     Heinz Wiesinger <heinz@m2mobi.com>
 * @author     Felipe Martinez <felipe@m2mobi.com>
 * @copyright  2012-2018, M2Mobi BV, Amsterdam, The Netherlands
 * @license    http://lunr.nl/LICENSE MIT License
 */

namespace Lunr\Gravity\Database\MySQL\Tests;

use Lunr\Gravity\Database\MySQL\MySQLDMLQueryBuilder;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * This class contains common setup routines, providers
 * and shared attributes for testing the MySQLDMLQueryBuilder class.
 *
 * @covers Lunr\Gravity\Database\MySQL\MySQLDMLQueryBuilder
 */
abstract class MySQLDMLQueryBuilderTest extends TestCase
{

    /**
     * Instance of the MySQLQueryBuilder class.
     * @var MySQLDMLQueryBuilder
     */
    protected $builder;

    /**
     * Reflection instance of the MySQLDMLQueryBuilder class.
     * @var ReflectionClass
     */
    protected $builder_reflection;

    /**
     * Mock instance of the MySQLConnection class.
     * @var MySQLConnection
     */
    protected $db;

    /**
     * TestCase Constructor.
     */
    public function setUp()
    {
        $this->db = $this->getMockBuilder('Lunr\Gravity\Database\MySQL\MySQLConnection')
                         ->disableOriginalConstructor()
                         ->getMock();

        $this->builder = new MySQLDMLQueryBuilder($this->db);

        $this->builder_reflection = new ReflectionClass('Lunr\Gravity\Database\MySQL\MySQLDMLQueryBuilder');
    }

    /**
     * TestCase Destructor.
     */
    public function tearDown()
    {
        unset($this->builder);
        unset($this->builder_reflection);
        unset($this->db);
    }

    /**
     * Unit Test Data Provider for Select modes handling duplicate result entries.
     *
     * @return array $modes Array of select modes
     */
    public function selectModesDuplicatesProvider()
    {
        $modes   = [];
        $modes[] = [ 'ALL' ];
        $modes[] = [ 'DISTINCT' ];
        $modes[] = [ 'DISTINCTROW' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for Select modes handling the sql query cache.
     *
     * @return array $modes Array of select modes
     */
    public function selectModesCacheProvider()
    {
        $modes   = [];
        $modes[] = [ 'SQL_CACHE' ];
        $modes[] = [ 'SQL_NO_CACHE' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for standard Select modes.
     *
     * @return array $modes Array of select modes
     */
    public function selectModesStandardProvider()
    {
        $modes   = [];
        $modes[] = [ 'HIGH_PRIORITY' ];
        $modes[] = [ 'STRAIGHT_JOIN' ];
        $modes[] = [ 'SQL_BIG_RESULT' ];
        $modes[] = [ 'SQL_SMALL_RESULT' ];
        $modes[] = [ 'SQL_BUFFER_RESULT' ];
        $modes[] = [ 'SQL_CALC_FOUND_ROWS' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for standard Select modes.
     *
     * @return array $modes Array of select modes
     */
    public function updateModesStandardProvider()
    {
        $modes   = [];
        $modes[] = [ 'LOW_PRIORITY' ];
        $modes[] = [ 'IGNORE' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for standard lock modes.
     *
     * @return array $modes Array of lock modes
     */
    public function lockModesStandardProvider()
    {
        $modes   = [];
        $modes[] = [ 'FOR UPDATE' ];
        $modes[] = [ 'LOCK IN SHARE MODE' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for Delete modes.
     *
     * @return array $modes Array of delete modes
     */
    public function deleteModesStandardProvider()
    {
        $modes   = [];
        $modes[] = [ 'LOW_PRIORITY' ];
        $modes[] = [ 'QUICK' ];
        $modes[] = [ 'IGNORE' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for Delete modes uppercasing.
     *
     * @return array $expectedmodes Array of delete modes and their expected result
     */
    public function expectedDeleteModesProvider()
    {
        $expectedmodes   = [];
        $expectedmodes[] = [ 'low_priority', 'LOW_PRIORITY' ];
        $expectedmodes[] = [ 'QuIcK', 'QUICK' ];
        $expectedmodes[] = [ 'IGNORE', 'IGNORE' ];

        return $expectedmodes;
    }

    /**
     * Unit Test Data Provider for Insert modes.
     *
     * @return array $modes Array of Insert modes
     */
    public function insertModesStandardProvider()
    {
        $modes   = [];
        $modes[] = [ 'LOW_PRIORITY' ];
        $modes[] = [ 'DELAYED' ];
        $modes[] = [ 'HIGH_PRIORITY' ];
        $modes[] = [ 'IGNORE' ];

        return $modes;
    }

    /**
     * Unit Test Data Provider for Insert modes uppercasing.
     *
     * @return array $expectedmodes Array of insert modes and their expected result
     */
    public function expectedInsertModesProvider()
    {
        $expectedmodes   = [];
        $expectedmodes[] = [ 'low_priority', 'LOW_PRIORITY' ];
        $expectedmodes[] = [ 'DeLayeD', 'DELAYED' ];
        $expectedmodes[] = [ 'IGNORE', 'IGNORE' ];

        return $expectedmodes;
    }

}

?>
