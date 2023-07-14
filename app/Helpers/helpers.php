<?php

function formatPrice($value)
{
    return '$' . number_format($value, 2);
}

function index(Request $request)
{

    /* Current Login User Details */
    $user = auth()->user();
    var_dump($user);
  
    /* Current Login User ID */
    $userID = auth()->user()->id; 
    var_dump($userID);
      
    /* Current Login User Name */
    $userName = auth()->user()->name; 
    var_dump($userName);
      
    /* Current Login User Email */
    $userEmail = auth()->user()->email; 
    var_dump($userEmail);
}