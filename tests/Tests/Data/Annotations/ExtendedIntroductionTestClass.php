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

namespace AppserverIo\Doppelgaenger\Tests\Data\Annotations;

/**
 * AppserverIo\Doppelgaenger\Tests\Data\Annotations\ExtendedIntroductionTestClass
 *
 * Test class which is used to test a single introduction together with an existing interface implementation
 *
 * @category   Library
 * @package    Doppelgaenger
 * @subpackage Tests
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH - <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io/
 *
 * @Introduce(interface="\AppserverIo\Doppelgaenger\Tests\Data\Annotations\TestInterface2",
 *      implementation="\AppserverIo\Doppelgaenger\Tests\Data\Annotations\TestTrait2")
 */
class ExtendedIntroductionTestClass implements TestInterface1
{
    use TestTrait1;
}
