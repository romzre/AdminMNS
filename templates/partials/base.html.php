<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e661624086.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin MNS</title>
  </head>
  <body>
  <header>
  <?php isset($_SESSION['id_user'])?(isset($admin)?require '../templates/partials/inc_nav-admin.php' : require '../templates/partials/inc_nav.php'):null ;?>
  </header>
 
  <?= $content ;?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <?php $scriptNav = '';?>
  <?php isset($_SESSION['id-user'])?(isset($_SESSION['is-admin'])? $scriptNav ='<script src= "scripts/nav-admin.js"></script>' : $scriptNav = '<script src= "scripts/nav.js"></script>'):null; ?>
  <?= $scriptNav ;?>
  </body>

</html>