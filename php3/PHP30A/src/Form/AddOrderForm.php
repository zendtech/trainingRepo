<?php
/**
 * Order Process Form Class
 */
class AddOrderForm extends Form
{
    /**
     *
     */
    public function __construct()
    {
        $args = [
            'name' => 'AddOrderForm',
            'id' => 'addorder',
            'method' => 'post',
            'action' => 'index.php',
        ];
        parent::__construct($args);

        //Add Search element
        $this->addElement([
            'label' => 'Order Date',
            'type' => 'text',
            'name' => 'order_date',
            'class' => 'date',
            'value' =>  date('m/d/Y',time()),
            'priority' => 1,
            'readonly' => true,
            'validator' => [
                'StringLength' => [
                    'minimum' => 8,
                    'maximum' => 10,
                ],
            ],
        ]);

        //Add Search element
        $this->addElement([
            'label' => 'Amount $',
            'type' => 'text',
            'name' => 'amount',
            'class' => 'amount',
            'priority' => 2,
            'required' => true,
            'size' => 6,
            'validator' => [
                'digit',
            ],
        ]);

        //Add order status select element
        $statuses = Services::getInstance()->get('status-codes');
        $this->addElement([
            'label' => 'Status Filter',
            'type' => 'select',
            'name' => 'status_filter',
            'multiple' => false,
            'priority' => 3,
            'required' => false,
            'options' => $statuses,
            'validator' => [
                'InArray' => $statuses,
            ],
        ]);

        //Add description element
        $this->addElement([
            'label' => 'Description',
            'type' => 'textarea',
            'name' => 'description',
            'cols' => 50,
            'rows' => 4,
            'maxlength' => 100,
            'priority' => 4,
            'required' => false,
            'validator' => [
                'StringLength' => [
                    'minimum' => 0,
                    'maximum' => 100,
                ],
                'Alnum',
            ],
        ]);

        //Add a submit button
        $this->addElement([
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Add Order',
            'priority' => 100,
        ]);

        //Sort the fields by priority
        ksort($this->elements);
    }
}