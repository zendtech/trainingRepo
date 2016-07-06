<?php
/**
 * Index Controller (A front controller)
 */
class IndexController extends AbstractController
{
    /**
     * The entry action
     */
    public function indexAction()
    {
        //Get a view container to store view variables
        $view = $this->services->getViewContainer(__FUNCTION__);
        $view->setTemplate('orders');

        //Initialize the form and values
        $form = $values = null;

        //Check POST to see if we have form data
        if($_POST) {
            switch ($_POST['submit']) {
                case 'Reload':
                    $form = $this->services->getForm('OrderForm');
                    break;
                case 'Add Order':
                    $form = $this->services->getForm('AddOrderForm');
                    break;
            }

            // Filter/validate input
            if ($form) {
                $form->setData($_POST);
                if ($form->isValid) {

                    //Process the input
                    $result = $this->domain->processInput($form);
                    if (is_array($result)) {
                        $values['data'] = $result;
                        $values['form'] = $form;
                        $values['messenger'] = new Messenger(OrdersModel::MSG_ORDERS_RELOADED, MESSENGER::TYPE_INFO);
                    }elseif(is_bool($result)){
                        //We saved, shoot back to the orders list
                        $values = $this->getDefaults();
                        $values['messenger'] = new Messenger(OrdersModel::MSG_ORDER_ADD, MESSENGER::TYPE_INFO);
                    };
                } else {
                    //Something in the form was invalid
                    $values['messenger'] = new Messenger('Invalid Form Entry', Messenger::TYPE_ERROR);
                }
            } else {
                //Ok we don't have form data in the input, get the default service configs and send it back
                $values = $this->getDefaults();
            }
        }
        //Check GET to see if we have a new order request
        elseif(isset($_GET['form'])){
            if($_GET['form'] === 'AddNewOrder'){
                $form = $this->services->getForm('AddOrderForm');
                $values['form'] = $form;
                $view->setTemplate('new_order');
            }else{ //The correct form is not accounted for, send back the opening page.
                $values = $this->getDefaults();
            }
        }else{
            /*Ok, no POST, lets present the opening page
            Get the order form from the service object. This is necessary
            as it contains the element and validations needed*/
            $values = $this->getDefaults();
        }

        //Set the view variables
        $view->setData($values);
        $view->render();
    }

    protected function getDefaults(){
        $form = $this->services->getForm('OrderForm');
        $defaults = $this->services->get('order-defaults');
        $values['data'] = $this->domain->getOrders($defaults);
        $values['form'] = $form;
        return $values;
    }
}