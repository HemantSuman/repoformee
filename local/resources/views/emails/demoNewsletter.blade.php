<body>
    <div>
    	<?php echo $body; ?>
    </div>
    <br/>
    <br/>
    <a href="<?php echo Request::root().'/unsubscribe/'.$token; ?>">Click here for unsubscribe</a>
</body>