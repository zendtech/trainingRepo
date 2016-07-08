<?php
/**
 * Order Form Class
 */
class OrderForm extends Form
{
    /**
     * @param $args
     */
    public function __construct()
    {
        $args = [
            'name' => 'OrderForm',
            'id' => 'form1',
            'method' => 'post',
            'action' => 'index.php',
        ];
        parent::__construct($args);

        //Add Search element
        $this->addElement([
            'label' => 'Search for Order #',
            'type' => 'text',
            'name' => 'order-num-filter',
            'priority' => 1,
            'required' => false,
            'validator' => [
                'Alnum',
            ],
        ]);

        //Add sort by element
        $orderBy = Services::getInstance()->get('order-codes');
        $this->addElement([
            'label' => 'Sort By',
            'type' => 'select',
            'name' => 'order-by',
            'multiple' => false,
            'priority' => 2,
            'required' => false,
            'options' => $orderBy,
            'validator' => [
                'InArray' => $orderBy,
            ],
        ]);

        //Add order status select element
        $statuses = Services::getInstance()->get('status-codes');
        $this->addElement([
            'label' => 'Status Filter',
            'type' => 'select',
            'name' => 'status-filter',
            'multiple' => false,
            'priority' => 3,
            'required' => false,
            'options' => $statuses,
            'validator' => [
                'InArray' => $statuses,
            ],
        ]);

        //Add a submit button
        $this->addElement([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Reload',
            'priority' => 100,
        ]);

        //Sort the fields by priority
        ksort($this->elements);
    }
}