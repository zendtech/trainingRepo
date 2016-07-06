<?php
//Main template file
?>
<html>
<head>
    <title>Order Inquiry: <?php echo $this->file; ?></title>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css"/>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
</head>

<body>
<div id="container">
    <div id="header">
        <div id="logo"><a href="index.php"><img src="images/logo.gif"></a></div>
        <div id="toptitle">
            <h1>Zend Training</h1>
            <h2>Object-Oriented Order Inquiry</h2>
        </div>
        <div id="scriptmeta">
            <?php
            echo "<span class=\"metalabel\">Script: </span><b>$this->file</b><br>"
                . '<span class="metalabel">Date: </span><b>' . date('M d, Y')
                . '</b><br>'
                . '<span class="metalabel">Time: </span><b>' . date('h:i:s a')
                . '</b><br>';
            ?>
        </div>
    </div><!--end header -->

    <div id="content">
        <?php
        if(!empty($this->data['messenger'])){
            // Output any messages
            $messenger = $this->data['messenger'];
            $class = $messenger->type === 'info' ? ' class="messengerInfo"' : ' class="messengerError"';
            echo "<span $class>" . $messenger->message . '</span>';
        }
        require $this->template;
        ?>
    </div>

    <div id="footer">
        <p>&copy; <?php echo date('Y'); ?> Zend Technologies Ltd. All rights reserved.</p>
        <p><a href="http://www.zend.com">http://www.zend.com</a></p>
        <p>
            <a href="http://www.zend.com/en/terms-and-conditions#privacy">Privacy Policy</a>&nbsp; | &nbsp;
            <a href="http://www.zend.com/en/terms-and-conditions">Terms and Conditions</a>&nbsp; | &nbsp;
            <a href="http://www.zend.com/en/contact">Feedback</a>&nbsp; | &nbsp;
            <a href="http://www.zend.com/en/company/contact-us">Contact Us</a>
            <br/>
    </div><!--end footer-->

</div><!--end container-->
</body>
</html>

