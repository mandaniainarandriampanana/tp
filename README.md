1- lancer composer install

2- lancer la commande: php bin/console cache:clear

3- la collection postman de l'api est qui se trouve au racine du projet

3- l'url d'entré du client est "/" comme le dis le sujet

4- Remarque:
	a- l'api REST et sa client se trouve dans la meme appli,pourtant:
		- touts traitements concernant l'API se trouve dans ApiBundle
		- ceux du client dans ClientBundle
    b- pour respecter le sujet, j'ai mis un champ slug à remplir mais dans une vraie application, on genere le slug exemple: slug = md5("new Dtaetime(now)");
	
Merci, bon test ;)