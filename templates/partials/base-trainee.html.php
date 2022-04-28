<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/e661624086.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="../style/dashboard-trainee.css">
    <title>Admin MNS</title>
  </head>
  <body>
    <header>
      <nav class="navbar">
        <div class="navbar-burger_menu">
            <button class="nav__burger"> 
                        <span class="nav__burger__bar"></span>
                    </button>
            <ul class="navbar__menu">
                <li class="navbar__item"> <a href="/page=dashboard-trainee" class="navbar__links">Mon tableau de bord</a></li>
                <li class="navbar__item"><a href="/page=absences" class="navbar__links">Mes absences</a></li>
                <li class="navbar__item"><a href="/page=delay" class="navbar__links">Mes retards</a></li>
            </ul>
        </div>
        <div class="navbar-account_notification">
            <div class="navbar-notification">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div class="navbar-account">
                <img class="nav-img-account" src="images/account-img.png" alt="my-account_img"/>
                <div class="navbar-account--toggle">
                    <ul class="navbar-account__content">
                        <li> <a href="/page=planning" class="navbar--account__links">Mon compte</a></li>
                        <li><div class="content-log-out">
                            <a href="/?page=log-out" class="navbar--account__links">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>Déconnexion
                            </a>
                        </div></li>
                    </ul>
                </div>
            </div>
        </div>
      </nav>
    </header>
    <?= $content ;?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src= "scripts/nav.js"></script>
  </body>
</html>