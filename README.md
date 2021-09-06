* Clone le dépot sur ta machine
git clone 

* Se deplacer dans le dossier en question
cd whip

* Installes ensuite les dépendances avec composer
composer install

* Démarre le serveur symfony en tache de fond
symfony console serve -d

* Démarre mysql, exemple sous windows
C:\wamp64-2\bin\mysql\mysql5.7.31\bin\mysql.exe -u root -p

* Il faut créer la base de données et recupere le fichier sql dans le dossier wihp (le fichier est dans le dossier uniquement pour la démo)
symfony console doctrine:database:create

* Exécute les migrations
symfony console doctrine:migrations:migrate
