# MobiVLM
MobiVLM est une interface web simplifiée pour pouvoir piloter un bateau depuis un téléphone portable 3g.

# Bases de conception
Cette interface est conçue avec une ergonomie la plus simple possible et un minimum de code côté client (javascript) dans le but d'être utilisable sur n'importe quel modèle de téléphone. L'affichage s'adapte en fonction de la taille de l'écran du téléphone utilisé mais le minimum raisonnable est une taille d'écran de 240X320.
L'application doit pouvoir tourner sur n'importe quel serveur équipé d'Apache 2 et PHP5 avec PHP-CURL et PHP-JSON.
Le code PHP utilise des classes afin de pouvoir être lisible et réutilisable, notamment la classe actions.vlm.class.php. Le code est publié sur le tracker VLMTOOLS.

# Fonctionnalités (voir les screenshots)
* Afin de palier au manque de place sur la plus part des écrans de téléphone, un système d'onglet permet de changer d'écran.
* 1er onglet : consultation des infos du bateau
* 2ème onglet : passage d'ordres (sauf pilototo)
* 3ème onglet : consultation des cartes avec Météo sur 60 heures avec les mêmes pas que la TCV.

# Installation sur un serveur
* 1) Avoir un serveur LAMP (Apache 2, php 5, Librairies CURL et JSON).
* 2) Copier l'ensemble du répertoire MobiVLM quelque part dans le Document root du serveur.
* 3) Donner les droits maximums à l'utilisateur du serveur Apache (www-data par exemple) sur le répertoire MobiVLM/tmp. Le plus simple est de le chmoder en 777. C'est dans ce répertoire que seront stockés les cookies des utilisateurs.
* 4) heu ... c'est tout !

# Les classes
Le coeur de l'application est constitué par 2 classes
 ## mobivlm.class.php
Classe dédiée à la récupération et au traitement des informations.
La principale fonction est la suivante :
* alldatas("http://virtual-loup-de-mer.org/ws/boatinfo.php?forcefmt=json",$pseudo,$password)
   La fonction récupère les informations du boat, en reformate certaines, en ajoute d'autres et retourne un tableau.
 ## actions.vlm.class.php
Classe dédiée au passage des ordres vers VLM
* open_session($pseudo,$password,$IDU,$serveur) => ouvre une session via CURL sur VLM, récupère un cookie et retourne le SID de la session ouverte.
* make_event($event,$vars_get,$pseudo,$password,$IDU,$serveur,$sid) => Fabrique une URL pour passer un ordre en fonction des paramètres fournis.
* exec_event($url,$IDU) => envoie l'ordre make_event vers VLM en utilisant le cookie récupéré par open_session.

# TODO
* modification de la classe actions.vlm.class.php pour utiliser le setter développé par Paparazzia.
* Si nécessaire, envoyer vers VLM le résultat de getip et getfullip. Solution envisagée pour l'instant, passage de ces infos dans le HEADER http avec CURL (CURLOPT_HTTPHEADER), solution testée.
* ajouter la taille de l'image en paramètres pour la cartographie.
