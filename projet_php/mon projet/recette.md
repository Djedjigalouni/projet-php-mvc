## Une recette, c'est :

un titre ;

un auteur ;

un statut activé ;

et des instructions (la recette à suivre).

## Nous allons découvrir la création de fonctions à travers trois exemples :

Vérifier si la recette est valide.

Récupérer des recettes à afficher.

Récupérer le nom d'un utilisateur en fonction de l'e-mail associé à la création d'une recette.

## le formulaire de connexion
 Au problème que vous vous posez (qu'est-ce que je veux arriver à faire ?).

Au schéma du code, c'est-à-dire que vous allez commencer à le découper en plusieurs morceaux, eux-mêmes découpés en petits morceaux (c'est plus facile à avaler).

Aux fonctions et aux connaissances en PHP dont vous allez avoir besoin (pour être sûr que vous les utilisez convenablement).

Et pour montrer l'exemple, nous allons suivre cette liste.

1. Posez le problème
On doit soumettre un e-mail et un mot de passe dans un formulaire de connexion.

Si le formulaire est valide, nous affichons un message de succès, et sinon un message d'erreur. La liste de recettes n'est affichée qu'à un utilisateur qui s'est connecté avec succès.

2. Schématisez le code
Pour que l'utilisateur puisse entrer le mot de passe, le plus simple est de créer un formulaire. Celui-ci sera directement intégré dans la page d'accueil du site telle que nous la connaissons déjà.

Trois situations peuvent survenir :

Vous n'êtes pas connecté : auquel cas, le formulaire de contact s'affiche, et la liste des recettes ne s'affiche pas.

Vous avez soumis le formulaire avec le bon mot de passe pour l'utilisateur : le message de succès s'affiche, le formulaire de connexion ne s'affiche pas et les recettes s'affichent.

Vous avez soumis le formulaire avec le mauvais mot de passe pour l'utilisateur : le message d'erreur s'affiche, le formulaire de connexion s'affiche et les recettes ne s'affichent pas.

Vous devez donc créer une nouvelle page et adapter la page d'accueil :

login.php : contient un simple formulaire comme vous savez les faire ;

index.php : qui doit maintenant inclure un formulaire de connexion et une condition sur l'affichage des recettes.

## Comprenez le fonctionnement des sessions
Voici les trois étapes à connaître :

Étape 1 : création d'une session unique
Un visiteur arrive sur votre site.

On demande à créer une session pour lui.

PHP génère alors un numéro unique.

Ce numéro est souvent très grand. Exemple : a02bbffc6198e6e0cc2715047bc3766f.
Ce numéro sert d'identifiant ; c'est ce qu'on appelle un « ID de session » ou  PHPSESSID  .

PHP transmet automatiquement cet ID de page en page, en utilisant généralement un cookie.

Étape 2 : création de variables pour la session
Une fois la session générée, on peut créer une infinité de variables de session pour nos besoins.

Par exemple, on peut créer :

une variable qui contient le nom du visiteur : $_SESSION['nom'] 

une autre qui contient son prénom : $_SESSION['prenom'] 

etc.

Le serveur conserve ces variables même lorsque la page PHP a fini d'être générée. Autrement dit : quelle que soit la page de votre site, vous pourrez récupérer le nom et le prénom du visiteur via la superglobale $_SESSION !

Étape 3 : suppression de la session
Lorsque le visiteur se déconnecte de votre site, la session est fermée et PHP « oublie » alors toutes les variables de session que vous avez créées.

Il est en fait difficile de savoir précisément quand un visiteur quitte votre site. En effet, lorsqu'il ferme son navigateur ou va sur un autre site, le vôtre n'en est pas informé.

Soit le visiteur clique sur un bouton « Déconnexion » (que vous aurez créé) avant de s'en aller, soit on attend quelques minutes d'inactivité pour le déconnecter automatiquement : on parle alors de "timeout". Le plus souvent, le visiteur est déconnecté par un timeout.

Pour activer ou détruire une session, deux fonctions sont à connaître :

 session_start() : démarre le système de sessions. Si le visiteur vient d'arriver sur le site, alors un numéro de session est généré pour lui. 

 session_destroy() : ferme la session du visiteur. Cette fonction est automatiquement appelée lorsque le visiteur ne charge plus de page de votre site pendant plusieurs minutes (c'est le timeout), mais vous pouvez aussi créer une page « Déconnexion » si le visiteur souhaite se déconnecter manuellement.

Il faut appeler session_start() sur chacune de vos pages AVANT d'écrire le moindre code HTML ou PHP (avant même la balise  <!DOCTYPE>  ). 

Si vous oubliez de lancer session_start()  , vous ne pourrez pas accéder à la variable superglobale   $_SESSION  .

Si vous voulez détruire manuellement la session du visiteur, vous pouvez faire un lien « Déconnexion » amenant vers une page qui fait appel à la fonction  session_destroy()  .

Néanmoins, sachez que sa session sera automatiquement détruite au bout d'un certain temps d'inactivité.

Concrètement, les sessions peuvent servir dans de nombreux cas sur votre site (et pas seulement pour retenir un nom et un prénom !).

Voici quelques exemples :

Imaginez un script qui demande un identifiant et un mot de passe pour qu'un visiteur puisse se « connecter » (s'authentifier). On peut enregistrer ces informations dans des variables de session et se souvenir de l'identifiant du visiteur sur toutes les pages du site !

Puisqu'on retient son identifiant et que la variable de session n'est créée que s'il a réussi à s'authentifier, on peut l'utiliser pour restreindre certaines pages de notre site à certains visiteurs uniquement. Cela permet de créer toute une zone d'administration sécurisée : si la variable de session login existe, on affiche le contenu, sinon on affiche une erreur. Cela devrait vous rappeler l'exercice sur la protection d'une page par mot de passe, sauf qu'ici, on peut se servir des sessions pour protéger automatiquement plusieurs pages.

On se sert activement des sessions sur les sites de vente en ligne. Cela permet de gérer un « panier » : on retient les produits que commande le client quelle que soit la page où il est. Lorsqu'il valide sa commande, on récupère ces informations et… on le fait payer. 


## Apportons des modifications à notre projet
Nous allons effectuer plusieurs ajustements sur notre projet afin de le préparer pour la suite de ce cours.

1. Affichons les recettes même si l'utilisateur n'est pas connecté.

Dans le chapitre précédent, nous avions limité l'affichage des recettes aux utilisateurs connectés pour que vous ayez des bases solides pour la suite. Cependant, dans la vraie vie, nous souhaitons que nos recettes soient visibles par tous. Par conséquent, nous allons afficher à nouveau nos recettes. Modifions index.php :

1-2.**Séparons notre fichier login.php en deux fichiers**, tout comme nous l'avons fait pour le formulaire de contact.

Dans le fichier login.php, nous allons afficher notre formulaire de connexion :

Désormais, lors de la soumission du formulaire, nous appellerons le fichier submit_login.php :

Ensuite, nous allons transférer le traitement du formulaire dans le fichier submit_login.php :

La fonction  redirectToUrl('index.php');  que nous utilisons dans ce contexte sert à rediriger l'utilisateur vers une autre page. Dans ce cas précis, elle nous redirige vers la page d'accueil du site, qui est située à l'URL index.php. Lorsqu'un utilisateur soumet le formulaire de connexion avec des informations correctes, nous souhaitons le rediriger vers la page d'accueil.

3. Ajoutons la fonction  redirectToUrl()  dans functions.php.
En utilisant la fonction  header("Location: {$url}")  , on indique au navigateur web qu'il doit charger une nouvelle page dont l'adresse est spécifiée par $url.

4.Ensuite,  exit()  est utilisé pour arrêter immédiatement le reste du code PHP. Cela garantit que la redirection s'effectue sans problème, sans que d'autres instructions perturbent ce processus.

En somme, la fonction  redirectToUrl  est utile pour envoyer vers une autre page web, par exemple après une connexion réussie, une action sur un formulaire ou toute autre situation où l'on souhaite que l'utilisateur soit redirigé vers une nouvelle page.

## Conservez les données grâce aux cookies

Comme une variable, un cookie a un nom et une valeur.
Pour écrire un cookie, on utilise la fonction PHP setcookie  (qui signifie « Placer un cookie », en anglais).
On lui donne en général trois paramètres, dans l'ordre suivant :

Le nom du cookie (exemple : LOGGED_USER ).

La valeur du cookie (exemple :  utilisateur@exemple.com ).

La date d'expiration du cookie, sous forme de "timestamp" (exemple :  1090521508 ).

Le paramètre correspondant à la date d'expiration du cookie mérite quelques explications. Il s'agit d'un timestamp, c'est-à-dire du nombre de secondes écoulées depuis le 1er janvier 1970. Le timestamp est une valeur qui augmente de 1 toutes les secondes. Pour obtenir le timestamp actuel, on fait appel à la fonction time() . Pour définir une date d'expiration du cookie, il faut ajouter au « moment actuel » le nombre de secondes au bout duquel il doit expirer.

**Si vous voulez supprimer le cookie dans un an, il vous faudra donc écrire :time() + 365*24*3600** 

## Sécurisez un cookie avec les propriétés httpOnly et secure
Configurons les options httpOnly et secure sur le cookie.

Sans rentrer dans les détails, cela rendra votre cookie inaccessible en JavaScript sur tous les navigateurs qui supportent cette option (c'est le cas de tous les navigateurs récents). Cette option permet de réduire drastiquement les risques de faille XSS sur votre site, au cas où vous auriez oublié d'utiliser htmlspecialchars à un moment.

En écrivant les cookies de cette façon, vous diminuez le risque qu'un jour l'un de vos visiteurs puisse se faire voler le contenu d'un cookie à cause d'une faille XSS.


## Affichez et récupérez un cookie
Avant de commencer à travailler sur une page, PHP lit les cookies du client pour récupérer toutes les informations qu'ils contiennent. Ces informations sont placées dans la superglobale  $_COOKIE sous forme d'un tableau (array), comme d'habitude.

De ce fait, si je veux ressortir l'e-mail du visiteur que j'avais inscrit dans un cookie, il suffit d'écrire :  $_COOKIE['LOGGED_USER'] 

À noter que si le cookie n'existe pas, la variable superglobale n'existe pas. Il faut donc faire un  isset  pour vérifier si le cookie existe ou non.

Les cookies viennent du visiteur. Comme toute information qui vient du visiteur, elle n'est pas sûre. N'importe quel visiteur peut créer des cookies et envoyer ainsi de fausses informations à votre site.

## Modifiez un cookie existant
Vous vous demandez peut-être comment modifier un cookie déjà existant ? Il faut refaire appel à  setcookie en gardant le même nom de cookie, ce qui « écrasera » l'ancien.


## Exercez-vous
Et si nous ajoutions la fonctionnalité de déconnexion (logout) à votre site web !

Ah là là, encore un truc à ajouter ! Le chapitre était déjà super long… Et maintenant, la déconnexion ? J'ai vraiment besoin d'un coup de main !

Je comprends, ce chapitre a été assez dense, et l'ajout de la fonction de déconnexion peut sembler un peu intimidant. Mais ne vous inquiétez pas, pour rendre les choses plus simples, je vous suggère de diviser la tâche en étapes.

Créez un nouveau fichier PHP et nommez-le logout.php.

Dans ce fichier logout.php, programmez le code nécessaire pour déconnecter un utilisateur. Vous pouvez utiliser les connaissances que vous avez acquises jusqu'à présent dans ce cours pour gérer la session de l'utilisateur et supprimer ses données de connexion.

Ensuite, redirigez l'utilisateur vers la page d'accueil (index.php) une fois la déconnexion effectuée.

Dans le fichier header.php, ajoutez une condition pour afficher le lien vers logout.php uniquement si l'utilisateur est connecté. Cela permettra aux utilisateurs connectés d'accéder facilement à la déconnexion.

Testez si la déconnexion fonctionne correctement sur le site web. Pour cela :

Connectez-vous en utilisant l'email : mathieu.nebra@exemple.com et le mot de passe MiamMiam

Une fois connecté, assurez-vous que le lien "Déconnexion" est visible.

Cliquez sur le lien Déconnexion. Vérifiez que les informations de l'utilisateur ainsi que le lien Déconnexion disparaissent.

## base de donnees
Pour vous donner quelques exemples concrets, voici le nom des tables que vous allez devoir créer pour compléter votre site de partage de recettes :

users : stocke tous les comptes utilisateur de votre site ;

recipes : stocke toutes les recettes de votre site ;

comments : stocke tous les commentaires liés aux recettes.

## Ajoutez, modifiez et supprimez des recettes !

**Exercez-vous**
Ajoutez une fonctionnalité au projet fil rouge qui permettra aux utilisateurs de visualiser les détails d'une recette :

Sur la page d'index, ajoutez un lien sur le titre de chaque recette, permettant d'accéder au détail de cette recette.

Créez une nouvelle page, par exemple recipes_read.php, pour afficher les détails d'une recette.

Sur cette page, récupérez les informations de la recette sélectionnée à partir de la base de données.

## Ajoutez des commentaires grâce aux jointures SQL

Modélisez une relation
Si on considère une page qui affiche la recette avec la possibilité que les utilisateurs puissent commenter, voire évaluer la recette, alors un commentaire a les propriétés suivantes :

un identifiant unique ;

une recette ;

un auteur ;

une date de publication ;

une note (disons de 0 à 5).



Maintenant, il faut modifier la structure de la table comments pour faire référence aux données disponibles dans la table users  .

Pour cela, le mieux est de créer un champ user_id dans la table comments  qui fait référence au champ user_id dans la table  users  :

## Exercez-vous
Et si vous mettiez en place les commentaires sur la page détail des recettes ?

Étape 1 : Création de la table des commentaires

Utilisez le script SQL fourni (add_comment.sql) pour créer la table des commentaires dans la base de données.

Étape 2 : Affichage des commentaires sur la page détail d'une recette

Modifiez le fichier recipes_read.php pour afficher les commentaires associés à une recette sur la page détail. Chaque commentaire doit afficher le nom de l'utilisateur qui l'a postée et le texte du commentaire. S'il n'y a pas de commentaires, alors il faut afficher le message "Aucun commentaire".

Étape 3 : Affichage du formulaire de commentaire

Sur la page détail d'une recette, affichez le formulaire permettant à un utilisateur connecté d'ajouter un commentaire. Assurez-vous que seuls les utilisateurs connectés peuvent voir et utiliser ce formulaire.

Étape 4 : Validation du formulaire de commentaire

Utilisez les règles suivantes pour valider le formulaire de commentaire avant de l'ajouter à la base de données :


Les données nécessaires, telles que le texte du commentaire et l'identifiant de la recette, sont présentes et correctes.

Le commentaire ne peut pas être vide.

## Allez plus loin avec les fonctions SQL

Nous allons mettre en application deux cas d'utilisation qui complèteront votre projet :

Récupérer et afficher la moyenne des notes obtenues pour une recette.

Améliorer les commentaires en ajoutant une date de publication.

## Exercez-vous
Il est temps de retrouver pour la dernière fois notre fil rouge.

Ajoutons un système de notation et une date de création des commentaires :

Étape 1 : Mise en place de la date de création sur les commentaires

Utilisez le script SQL fourni (improve_comments.sql) pour ajouter un champ de date de création et champ pour la note à la table des commentaires.

Étape 2 : Affichage des commentaires de la date la plus récente à la plus ancienne

Modifiez le fichier recipes_read.php pour afficher les commentaires associés à une recette dans l’ordre antichronologique (du plus récent au plus ancien). Vous pouvez afficher la date de création.

Étape 3 : Saisie d'une note d'évaluation de 1 à 5 sur les recettes

Ajoutez un formulaire sur la page détail d'une recette permettant à l'utilisateur de saisir une note d'évaluation de 1 à 5. Validez et enregistrez cette note dans la base de données.

Étape 4 : Affichage de la moyenne des notes en haut de la page

Affichez en haut de la page détail de la recette la moyenne des notes des commentaires associés à cette recette.