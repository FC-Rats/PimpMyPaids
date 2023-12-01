<header class="bg-primary">
    <div class="container d-flex flex-wrap justify-content-center py-2 navbar navbar-expand-lg align-items-center">
        <a href="#" class="d-flex align-items-center mb-md-0 me-md-auto ms-md-4 text-light text-decoration-none navbar-brand logobrand">
            <img src="./assets/img/logorond.png" width="60" height="60" alt="">
            <span class="fs-4">PimpMyPaids</span>
        </a>

        <button class="navbar-toggler border-light me-md-4 custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon custom-toggler"></span>
        </button>

        <div class="collapse navbar-collapse flex-grow-0 bg-primary" id="navbarNavAltMarkup">
            <ul class="navbar-nav nav-pills text-light">
                <li class="nav-item">
                    <a href="index.php?p=list-compte" class="nav-link text-light" aria-current="page" style="text-align: center;">
                        <i class="fa-solid fa-users fa-xl"></i><br>
                        <span>Compte</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=list-remise" class="nav-link text-light" aria-current="page" style="text-align: center;">
                        <i class="fa-solid fa-wallet fa-xl"></i><br>
                        <span>Remises</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=list-impayés" class="nav-link text-light" aria-current="page" style="text-align: center;">
                        <i class="fa-solid fa-sack-xmark fa-xl"></i><br>
                        <span>Impayés</span>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-center text-light pe-4">
                    <a href="index.php?p=my-space" class="nav-link dropdown-toggle text-light" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-align: center;">
                        <i class="fa-solid fa-house-user fa-xl"></i><br>
                        <span>Mon Espace</span>
                    </a>
                    <div class="dropdown-menu text-light bg-primary dropdown-menu-end border-0 justify-content-center" id="navbarDropdownMenuLink" aria-labelledby="navbarDropdownMenuLink">
                        <a href="index.php?p=my-space" class="dropdown-item text-light">Mon Compte <i class="ms-2 fa-solid fa-user"></i></a>
                        <a href="index.php?p=parameters" class="dropdown-item text-light">Paramètres<i class="ms-3 fa-solid fa-gear"></i></a>
                        <a href="index.php?p=deconnexion" class="dropdown-item text-light">Déconnexion<i class="ms-2 fa-solid fa-right-to-bracket"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>