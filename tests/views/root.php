<!DOCTYPE html>
<html>
  <head>
    <title><?php slot('title')?></title>
  </head>
  <body>
    <div id="root">
      <?php slot('body', function () { ?>

        <p>'body' :: root.php</p>

      <?php }) ?>
    </div>
  </body>
</html>
