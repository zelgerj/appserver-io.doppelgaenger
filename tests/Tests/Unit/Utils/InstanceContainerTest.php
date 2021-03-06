<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Library
 * @package    Doppelgaenger
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH - <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io/
 */

namespace AppserverIo\Doppelgaenger\Tests\Unit\Utils;

use AppserverIo\Doppelgaenger\Utils\InstanceContainer;

/**
 * AppserverIo\Doppelgaenger\Tests\Unit\Utils\InstanceContainerTest
 *
 * This test will test the configuration class AppserverIo\Doppelgaenger\Config
 *
 * @category   Library
 * @package    Doppelgaenger
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH - <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io/
 */
class InstanceContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Container instance to be used for tests that do not rely on the static stay
     *
     * @var \AppserverIo\Doppelgaenger\Utils\InstanceContainer $container
     */
    protected $container;

    /**
     * Set one initial value into the container so we can test the getOffset method
     *
     * @return void
     */
    public function setUp()
    {
        $this->container = new InstanceContainer();
        $this->container[__CLASS__] = 'value';
    }

    /**
     * Test setOffset method
     *
     * @return void
     *
     * @depends testGetOffset
     */
    public function testSetOffset()
    {
        $container = new InstanceContainer();
        $container[__METHOD__] = 'value';
        $this->assertEquals($container[__METHOD__], 'value');
    }

    /**
     * Test getOffset method
     *
     * @return void
     */
    public function testGetOffset()
    {
        $this->assertEquals($this->container[__CLASS__], 'value');
    }

    /**
     * Test if static stay of values works
     *
     * @return void
     *
     * @depends testSetOffset
     * @depends testGetOffset
     */
    public function testStaticStay()
    {
        $container = new InstanceContainer();
        $container[__METHOD__] = 'value';

        $tmpContainer = new InstanceContainer();
        $this->assertEquals($tmpContainer[__METHOD__], 'value');
    }
}
