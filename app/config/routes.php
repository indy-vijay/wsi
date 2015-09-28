<?php
define('CUSTOM_ROUTES', serialize(array(

   '/register'             =>  'Register:index',
    '/register/submit'     =>  'Register:submit',
    '/login'               =>  'Login:index',
    '/login/submit'        =>  'Login:submit',
    '/forgot-password'     =>  'Login:forgot',
    '/logout'              =>  'Login:logout',
    '/dashboard'           =>   'Dashboard:index'
    
)));
 
