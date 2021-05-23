<?php

block('title', function () { ?> 'title' :: index.php <?php });

block('side', function () { ?>

  <p>'side' :: index.php</p>

<?php }); 

block('main', function () { ?>

 <div id="main-index-override">
    <?php super() ?>
  </div>

<?php });

block('main', function () { ?>

  <div id="main-index"> 
    <?php super() ?>
  </div>

<?php });

include __DIR__.'/two-columns.php';
