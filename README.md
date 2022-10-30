<h1>TestTechniqueLI</h1>

<h3>Test technique proposé par la société Lemon Interactive</h3>

---

<h4>1 > Installation du projet</h4>

Pour installer le projet, il vous suffit de cloner le projet graçe a cette commande dans votre invite de commande :

    git clone git@github.com:Silverfabien/TestTechniqueLI.git

<h4>2 > Installer les dépendances</h4>

Générer les fichiers important au fonctionnement de symfony, il faut générer les vendors avec la commande suivante :

    composer install

Ensuite générer les fichiers pour le fonctionnement du css et js :

    yarn install

<h4>3 >Paramètre</h4>

Dans le fichier `.env`, il vous faut paramétrer la base de donnée ainsi que le serveur smtp :

    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

<p>Les valeurs suivantes devront être modifiées</p>
<u>Pour la base de donnée</u>

    line 31 : DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

db_user = Identifiant de votre bdd<br />
db_password = Mot de passe de votre bdd<br />
127.0.0.1:3306 = Ip + port de connexion de votre bdd<br />
db_name = Le nom de votre bdd

<u>Pour le serveur smtp</u>

    line 43 : MAILER_DSN=smtp://email:password@url:port?encryption=tls&auth_mode=login

email = E-mail de votre serveur smtp<br />
password = Mot de passe de votre serveur smtp<br />
url:port = Cible du serveur smtp (ex: ssl0.ovh.net:587)

<h4>4 >Base de donnée</h4>

Pour créer la base donnée, faîtes la commande suivante :

    php .\bin\console doctrine:database:create

Ensuite pour les fixtures, allez dans le fichier `src/DataFixtures/UserAdminFixtures`. Vous pourrez modifier le compte admin qui sera créer.<br />

Pour générer les fixtures, faîtes la commande suivante :

    php .\bin\console doctrine:fixtures:load
