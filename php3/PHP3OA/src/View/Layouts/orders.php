<?php
$form = $this->data['form'];
$data = $this->data['data'];
?>
<div id="sortform">
    <?php
    $form = $this->data['form'];
    echo $form->getStartTag();
    foreach($form->getElements() as $element){
        if($element->getLabel()) echo $element->getLabelTag();
        echo $element->getInput();;
    }
    echo $form->getEndTag();
    ?>

</div> <!-- end sortform -->

<div id="addnew">
    <a href="index.php?form=AddNewOrder"><img src="images/add_32.png"/></a> <p><a href="index.php?form=AddNewOrder">New Order</a></p>
</div> <!-- end addnew -->

<div id="totals">
Number of Orders: <b><?php echo count($data['orders']); ?></b>
Total of Order Amounts: <b><?php echo htmlspecialchars($data['total']); ?></b>
</div> <!-- end totals -->

<table>
    <tr>
    <th>Order#</th>
    <th>Order Date</th>
    <th>Customer</th>
    <th>Status</th>
    <th>Total</th>
    <th>Description</th>
    </tr>
    <?php
    $empty = 0; //initialize this variable -- it's used later
    if (!empty($data['orders'])):
        foreach ($data['orders'] as $order_row) :
        ?>
        <tr>
            <td class="center">
                <?php echo htmlspecialchars($order_row['id']); ?>
            </td>
            <td class="center">
                <?php echo htmlspecialchars($order_row['formatted_date']); ?>
            </td>
                <td class="left">
                <?php echo htmlspecialchars($order_row['customer_name']); ?>
            </td>
            <td class="left">
                <?php echo htmlspecialchars($order_row['formatted_status']); ?>
            </td>
            <td class="right">
                $<?php echo htmlspecialchars($order_row['amount']); ?>
            </td>
            <td class="left">
                <?php echo htmlspecialchars($order_row['description']); ?>
            </td>
        </tr>
        <?php
        endforeach;
    else:
        $empty = 1;
    endif;
?>
</table>
<?php
if ($empty):
    echo "No results found";
endif;

