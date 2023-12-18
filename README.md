# PimpMyPaid
<p align="center">
    <img  alt="Ouvrir le site" width="500" src="./assets/img/logorect.png">
</p>

<p align="justify" style="font-size:15px;">
    PimpMyPaids est un portail Web spécialisé pour permettre aux clients, qu'ils soient des entreprises ou des commerçants, de consulter leurs comptes et de suivre leurs transactions financières quotidiennes facilement !
</p>


## Partie développement

### Lancer le site en local

1. **Clonez** le projet github. Si vous faites un **.zip** vous ne serez pas en mesure de télécharger les modules nécessaires pour faire fonctionner correctement le site.

2. Installez les frameworks nécessaires en vous plaçant à la racine du site et en tapant cette commande dans une console de commande :
    ```bash
    git submodule init
    git submodule update
    ```

3. Importez la base de données grâce au fichier ```PimpMyPaids-Datas.sql``` trouvable dans le dossier ```datas``` à la racine du projet.

4. Renommez le fichier ``dev-config.php`` en ``config.php`` et et complètez les gens comme indiqué !

5. Prenez soin de modifié les liens dans le fichier ```mailer.php``` qui se trouve dans le fichier ```mailer``` ainsi que les emails dans la table ``TRAN_USERS`` de la base de données pour profiter au maximum des fonctionnalités du site.

6. Vous pouvez lancer le site ! **Youpiii !**


### Identifiants et mots de passe

Rôles | Identifiants | Mots de passe |
------- | ------ | -------
Product Owner | ``PO`` | ``P@ssw0rdProductOwner``
Administrateur | ``Admin`` | ``P@ssw0rdAdmin``
Marchand | ``McDo``<br> ``LeroyMerlin``<br> ``HomePlus`` <br> ``QuickMart``| ``P@ssw0rdMcDo``<br> ``P@ssw0rdMerlin``<br> ``P@ssw0rdHomePlus`` <br> ``P@ssw0rdQuickMart``

## Sources

+ La bibliothèque JavaScript libre [jQuery](https://jquery.com/)<br>
+ La collection d'outils utiles à la création du design [Bootstrap](https://getbootstrap.com/)<br>
+ La bibliothèque logicielle de création de graphiques en JavaScript [Highcharts](https://www.highcharts.com/)<br>
+ Le site d'illustration Open source [unDraw](https://undraw.co/)<br>
+ La police d'écriture et un outil d'icônes [Font Awesome](https://fontawesome.com/)<br>
+ La police d'écriture [SplineSans](https://fonts.google.com/specimen/Spline+Sans)<br>
+ La bibliothèque logicielle d'envoi d'e-mails en PHP [PHPMailer](https://github.com/PHPMailer/PHPMailer)<br>
+ La bibliothèque PHP pour lire et écrire des tableurs [Spreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)<br>

## Retrouvez l'équipe PimpMyPaids !
[@Artena8](https://github.com/Artena8)
Scrum Master - Développeur Front End

[@widfleer](https://github.com/widfleer)
Technical Leader - Développeur Front End

[@InkyYuu](https://github.com/InkyYuu) Lead Developer - Développeur Back End

[@LeoDessertenne](https://github.com/LeoDessertenne)
Responsable BDD - Développeur

[@ChamsedineAmouche](https://github.com/ChamsedineAmouche)
Responsable BDD - Développeur

<br>
<h3 style="text-align:center;">Toute l'équipe PimpMyPaids vous remercie de votre soutien !</h3>
<h5 style="text-align:center;">Copyright @FC-Rats<h5>
<p align="center">
    <img  alt="Ouvrir le site" width="150" src="./assets/img/logorond.png">
</p>