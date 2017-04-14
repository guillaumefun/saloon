<?php
$back = array('bg01', 'bg02', 'bg03',
'bg04', 'bg05', 'bg06','bg07','bg08','bg09');
$number = rand(0, count($back)-1);
$selectedBack = "$back[$number]";
 ?>

 <style>
.fucking-banner{
   height: 220px;
   background: url('../resources/img/<?php echo $selectedBack . ".jpg"?>') center 88% no-repeat scroll;
   -webkit-background-size: cover;
   -moz-background-size: cover;
   background-size: cover;
   -o-background-size: cover;
 }
 </style>
