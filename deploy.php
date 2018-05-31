<?php
/* On inclut la recette pour une application Symfony 3.
 * Si vous �tes encore sur Symfony 2, il faut inclure la recette recipe/symfony.php */
require 'recipe/symfony.php';

/* Dans notre exemple, on a qu'un serveur. On le nomme localhost car on d�ploie directement sur ce serveur.
 * Ce qui explique l�utilisation de la fonction localServer() sinon il faut utiliser la fonction server().
 * On le met dans la cat�gorie "prod" car il s'agit d'un serveur de production.
 * On indique le r�pertoire o� doit �tre d�ploy� le projet. */
host('http://bayrouti.parallaxsoft.tn')
    ->stage('prod')
    ->env('deploy_path', '/www/_dev/bayrouti/');

/* On utilise Git pour r�cup�rer le projet : on indique l'URL du d�p�t du projet */
set('repository', 'git@github.com:walidhorchani11/bayrouti.git');

/* Ce qui vient par la suite est optionnel. Il existe plein de variables personnalisables (Cf documentation).
 * Ici, cela permet de demander � Deployer de ne pas utiliser la commande sudo pour changer les droits des fichiers.
 * C'est utile par exemple quand cette commande n'est pas disponible sur le serveur */
set('writable_use_sudo', false);

/* A chaque d�ploiement, l'ancienne version est archiv�e.
 * Cette variable permet d'indiquer le nombre maximum de version que l'on souhaite conserver. */
set('keep_releases', 5);