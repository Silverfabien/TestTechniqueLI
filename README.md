<h1>TestTechniqueLI</h1>

<h3>Test technique proposé par la société Lemon Interactive</h3>

---

<h4>1 > Installation du projet</h4>

<p>Pour installer le projet, il vous suffit de cloner le projet grâce à cette commande dans votre invite de commande :</p>

    git clone git@github.com:Silverfabien/TestTechniqueLI.git

---

<h4>2 > Installer les dépendances</h4>


<p>Générer les fichiers important au fonctionnement de symfony, il faut générer les vendors avec la commande suivante :</p>

    composer install

<p>Ensuite générer les fichiers pour le fonctionnement du css et js :</p>

    yarn install

---

<h4>3 >Paramètre</h4>

<p>Dans le fichier `.env`, il vous faut paramétrer la base de donnée ainsi que le serveur smtp. Les valeurs suivantes devront être modifiées :</p>

<p><b>Pour la base de donnée :</b></p>

    ligne 31 : DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

<ul>
    <li><b>db_user :</b> Identifiant de votre bdd</li>
    <li><b>db_password :</b> Mot de passe de votre bdd</li>
    <li><b>127.0.0.1:3306 :</b> Ip + port de connexion de votre bdd</li>
    <li><b>db_name :</b> Le nom de votre bdd</li>
</ul>

<p><b>Pour le serveur smtp :</b></p>

    ligne 43 : MAILER_DSN=smtp://email:password@url:port?encryption=tls&auth_mode=login

<ul>
    <li><b>email :</b> E-mail de votre serveur smtp</li>
    <li><b>password :</b> Mot de passe de votre serveur smtp</li>
    <li><b>url:port :</b> Cible du serveur smtp (ex: ssl0.ovh.net:587)</li>
</ul>

<p>Ensuite, toujours dans le fichier `.env`, il vous faut configurer la ligne 44 et 45.</p>

---

<h4>4 >Base de donnée</h4>

<p>Pour créer la base donnée, faîtes la commande suivante :</p>

    php .\bin\console doctrine:database:create

<p>Ensuite pour les fixtures, allez dans le fichier `src/DataFixtures/UserAdminFixtures`. Vous pourrez modifier le compte admin qui sera créer (Ligne 26 à 34).</p>

<p>Pour générer les fixtures, faîtes la commande suivante :</p>

    php .\bin\console doctrine:fixtures:load
