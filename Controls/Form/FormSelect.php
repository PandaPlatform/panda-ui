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

namespace Panda\Ui\Controls\Form;

use Exception;
use Panda\Ui\Contracts\Factories\HTMLFormFactoryInterface;
use Panda\Ui\Factories\FormFactory;

/**
 * Class FormSelect
 *
 * @package Panda\Ui\Controls\Form
 *
 * @version 0.1
 */
class FormSelect extends FormElement
{
    /**
     * @type HTMLFormFactoryInterface
     */
    protected $HTMLFormFactory;

    /**
     * Create a new form item.
     *
     * @param HTMLFormFactoryInterface $HTMLFormFactory The FormFactory to build the complex object
     * @param string                   $name            The input's name
     * @param string                   $id              The input's id
     * @param string                   $class           The input's class
     * @param bool                     $multiple        Option for multiple selection.
     * @param bool                     $required        Sets the input as required for the form.
     *
     * @throws Exception
     */
    public function __construct($HTMLFormFactory = null, $name = '', $id = '', $class = '', $multiple = false, $required = false)
    {
        // Create FormElement
        parent::__construct($itemName = 'select', $name, $value = '', $id, $class, $itemValue = '');
        $this->attr('required', $required);

        // Add extra attributes
        if ($multiple) {
            $this->attr('multiple', 'multiple');
        }

        $this->HTMLFormFactory = $HTMLFormFactory ?: new FormFactory();
    }

    /**
     * Add a list of options in the select.
     *
     * @param array  $options       An array of value -> title options for the select element.
     * @param string $selectedValue The selected value among the option keys.
     *
     * @return FormSelect
     *
     * @throws Exception
     */
    public function addOptions($options = [], $selectedValue = '')
    {
        // Create all options
        foreach ($options as $value => $title) {
            // Create option
            $fi = new FormElement('option', '', $value, '', '', $title);

            // Check if it's the selected value
            if ($value == $selectedValue) {
                $fi->attr('selected', 'selected');
            }

            // Append option to select
            $this->append($fi);
        }

        // Return FormSelect object
        return $this;
    }

    /**
     * Add a list of options grouped in option groups.
     *
     * @param array  $optionGroups  An array of group labels and a nest array of option value -> title pairs.
     * @param string $selectedValue The selected value among the option keys.
     *
     * @return FormSelect
     *
     * @throws Exception
     */
    public function addOptionsWithGroups($optionGroups = [], $selectedValue = '')
    {
        // Create all options
        foreach ($optionGroups as $groupLabel => $options) {
            // Create option group
            $og = new FormElement('optgroup', $name = '', $value = '', $id = '', $class = '', $itemValue = '');
            $og->attr('label', $groupLabel);

            // Create all options
            foreach ($options as $value => $title) {
                // Create option
                $fi = $this->getHTMLFormFactory()->buildFormElement('option', '', $value, '', '', $title);

                // Check if it's the selected value
                if ($value == $selectedValue) {
                    $fi->attr('selected', 'selected');
                }

                // Append option to group
                $og->append($fi);
            }

            // Append option group to select
            $this->append($og);
        }

        // Return FormSelect object
        return $this;
    }

    /**
     * @return HTMLFormFactoryInterface
     */
    public function getHTMLFormFactory()
    {
        return $this->HTMLFormFactory;
    }
}

