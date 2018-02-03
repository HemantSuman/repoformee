<body>
    <h2>Forgot Password Link</h2>
        Hello  <?php echo $users['name'] ?>  <br>
        <div>
            
           Hello !! Please click on Above link for set password
            <a href="<?php echo Request::root().'/admin/verify/'.$users['_token']; ?>">
            <?php echo Request::root().'/admin/verify/'.$users['_token']; ?>	
            </a>
                
        
           <br/>

        </div>

    
    
</body>