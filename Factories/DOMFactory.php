<?php

/*
 * This file is part of the Panda framework Ui component.
 *
 * (c) Ioannis Papikas <papikas.ioan@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Panda\Ui\Factories;

use Panda\Ui\Contracts\Factories\DOMFactoryInterface;
use Panda\Ui\DOMItem;
use Panda\Ui\DOMPrototype;

class DOMFactory implements DOMFactoryInterface
{
    /***
     * @type DOMPrototype
     */
    protected $Document;

    /**
     * Create a new HTMLFactory.
     *
     * @param DOMPrototype $DOMPrototype
     */
    public function __construct(DOMPrototype $DOMPrototype = null)
    {
        $this->Document = $DOMPrototype;
    }

    /**
     * Build a DOM item.
     *
     * @param string $name
     * @param string $value
     *
     * @return DOMItem
     *
     */
    public function buildElement($name = "", $value = "")
    {
        return (new DOMItem($this->Document, $name, $value));
    }

    /**
     * @return DOMPrototype
     */
    public function getDocument()
    {
        return $this->Document;
    }

    /**
     * @param DOMPrototype $Prototype
     */
    public function setDocument($Prototype)
    {
        $this->Document = $Prototype;
    }
}

?>