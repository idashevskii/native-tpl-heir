<?php 

block('title', function () { ?>
  Title :: two-columns.php
<?php });

block('body', function () { ?>
  <div id="two-columnts">
    <div id="main">
      <?php slot('main', function () { ?>
      
        <p>'main' :: two-columns.php</p>
        
      <?php }) ?>
    </div>
    <div id="side">
      <?php slot('side', function () { ?>

        <p>'side' :: two-columns.php</p>

      <?php }) ?>
    </div>
  </div>
  <div id="footer">
    <?php slot('footer', function () { ?>

      <p>'footer' :: two-columns.php</p>

    <?php }) ?>
  </div>

<?php });

include __DIR__.'/root.php';
