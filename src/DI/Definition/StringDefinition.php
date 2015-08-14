<?php
/**
 * PHP-DI
 *
 * @link      http://php-di.org/
 * @copyright Matthieu Napoli (http://mnapoli.fr/)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

namespace DI\Definition;

use DI\Scope;

/**
 * Definition of a string composed of other strings.
 *
 * @since 5.0
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class StringDefinition implements Definition
{
    /**
     * Entry name
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $expression;

    /**
     * @param string $expression
     */
    public function __construct($expression)
    {
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getScope()
    {
        return Scope::SINGLETON;
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }
}
