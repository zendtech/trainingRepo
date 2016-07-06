<?php
$form = $this->data['form'];
echo '<h1>Add a new order</h1>';
echo $form->getStartTag();
foreach($form->getElements() as $element){
    echo '<p>';
    if($element->getLabel()) echo $element->getLabelTag();
    echo $element->getInput();
    echo '</p>';
}
echo $form->getEndTag();
