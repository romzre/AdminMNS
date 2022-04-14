<nav class="navbar">
    <div class="navbar-burger_menu">
        <button class="nav__burger"> 
                    <span class="nav__burger__bar"></span>
                </button>
        <ul class="navbar__menu">
            <li class="navbar__item"> <a href="/page=dashboard-trainee" class="navbar__links">Admin</a></li>
            <li class="navbar__item"><a href="/page=absences" class="navbar__links">Gestion</a></li>
            <!-- <li class="navbar__item"><a href="/page=delay" class="navbar__links">Mes retards</a></li> -->
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