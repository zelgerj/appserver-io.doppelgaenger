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
 * @subpackage Entities
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH - <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io/
 */

namespace AppserverIo\Doppelgaenger\Entities\Pointcuts;

use AppserverIo\Doppelgaenger\Dictionaries\PointcutPatterns;

/**
 * AppserverIo\Doppelgaenger\Entities\Pointcuts\AbstractCombinatorPointcut
 *
 * Abstract type of pointcuts which are used to logically combine other pointcuts
 *
 * @category   Library
 * @package    Doppelgaenger
 * @subpackage Entities
 * @author     Bernhard Wick <bw@appserver.io>
 * @copyright  2014 TechDivision GmbH - <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       http://www.appserver.io/
 */
abstract class AbstractConnectorPointcut extends AbstractPointcut
{

    /**
     * Call type for a call from an object
     *
     * @var string CONNECTOR_AND
     */
    const CONNECTOR_AND = '&&';

    /**
     * Call type for a static call
     *
     * @var string CONNECTOR_OR
     */
    const CONNECTOR_OR = '||';

    /**
     * The pattern used by this pointcut to match candidates
     *
     * @var string MATCH_PATTERN
     */
    const MATCH_PATTERN = PointcutPatterns::POINTCUT;

    /**
     * Pointcut specified to the left of the connector
     *
     * @var \AppserverIo\Doppelgaenger\Interfaces\PointcutInterface $leftPointcut
     */
    protected $leftPointcut;

    /**
     * Pointcut specified to the right of the connector
     *
     * @var \AppserverIo\Doppelgaenger\Interfaces\PointcutInterface $rightPointcut
     */
    protected $rightPointcut;

    /**
     * Default constructor
     *
     * @param string $leftExpression  String representing the expression defining this pointcut left of the connector
     * @param string $rightExpression String representing the expression defining this pointcut right of the connector
     */
    public function __construct($leftExpression, $rightExpression)
    {
        parent::__construct($leftExpression . $this->getConnector() . $rightExpression, false);

        $pointcutFactory = new PointcutFactory();
        $this->leftPointcut = $pointcutFactory->getInstance($leftExpression);
        $this->rightPointcut = $pointcutFactory->getInstance($rightExpression);
    }

    /**
     * Will return a chain of callbacks which can be used to call woven code in an onion like manner
     *
     * @return array
     */
    public function getCallbackChain()
    {
        return array_merge($this->leftPointcut->getCallbackChain(), $this->rightPointcut->getCallbackChain());
    }

    /**
     * Getter for the pointcut specific connector
     *
     * @return string
     */
    protected function getConnector()
    {
        return static::CONNECTOR;
    }

    /**
     * Returns a string representing the actual execution of the pointcut logic
     *
     * @param string|null $assignTo Should the result be assigned and stored for later use? If so, to what?
     *
     * @return string
     */
    public function getExecutionString($assignTo = null)
    {
        return $this->leftPointcut->getExecutionString($assignTo) . '
        ' . $this->rightPointcut->getExecutionString($assignTo);
    }
}
