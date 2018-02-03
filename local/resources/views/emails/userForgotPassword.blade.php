<body>
    <h2>Reset Password Link</h2>
        Hello <?php echo $users['name'] ?>  <br>
        <div>
            
        Click here to reset your password
            <a href="<?php echo Request::root().'/verify/'.$users['_token']; ?>">
            <?php echo Request::root().'/verify/'.$users['_token']; ?>	
            </a>
                
        
           <br/>

        </div>

    
    
</body>