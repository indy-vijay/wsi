<?php
define('CUSTOM_ROUTES', serialize(array(

   '/register'             =>  'Register:index',
    '/register/submit'     =>  'Register:submit',
    '/login'               =>  'Login:index',
    '/login/submit'        =>  'Login:submit',
    '/forgot-password'     =>  'Login:forgot',
    '/logout'              =>  'Login:logout',
    '/dashboard'           =>  'Dashboard:index',
    '/update-info'  	   =>  'Dashboard:updateInfo',
    '/create-order'        =>  'Order:createOrder',
    '/create-reorder'      =>  'Order:createReOrder',
    '/create-reorder2/:id' =>  'Order:createReOrderStepTwo',
    '/submit-reorder'      =>  'Order:submitReorder',
    '/confirm-order'       =>  'Order:confirmOrder',
    // '/create-order/type'   =>  'Order:createOrderStepTwo',
    // '/create-reorder/:id'  =>  'Order:createReOrder',
    '/order-final'         =>  'Order:confirmFinal',
    '/order-detail/:id'    =>  'Order:orderDetail',
    '/previous-orders'     =>  'Order:previousOrders',
    
)));
 
