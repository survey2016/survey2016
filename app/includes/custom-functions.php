<?php

  function getRankColor($order){
    $barColor = '#f05050';
    switch($order){
      case 1: $barColor = '#7266ba'; break;
      case 2: $barColor = '#23b7e5'; break;
      case 3: $barColor = '#27c24c'; break;
      case 4: $barColor = '#fad733'; break;
      case 5: $barColor = '#f05050'; break;
    }
    return $barColor;
  }


?>