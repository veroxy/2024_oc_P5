# P5 admin page
---



### [CODE SOURCE GITHUB](https://github.com/OpenClassrooms-Student-Center/PHP-blog-emilie-forteroche)
> Emilie a pris contact avec vous, développeur freelance, afin de mettre à jour son blog. Elle souhaiterait ajouter une
> page en partie admin pour lui permettre de
> - monitorer son blog ;
> - supprimer certains des commentaires de ses visiteurs.


j’ai besoin d’une nouvelle page dans la partie admin avec en particulier :

L’affichage du titre de chacun des articles avec en plus sur chaque ligne :

- le nombre de vues ;
- le nombre de commentaires ;
- la date de publication de l’article.
- Ce tableau pourra être trié (croissant et décroissant) en fonction de ces quatres critères (vues, commentaires, date
  et titre).
- Pas besoin de version mobile de cette page, assurez-vous simplement que je puisse l’afficher correctement sur mon **
  ordinateur (1 366 px de large)**.
- Pour la mise en forme, il faut simplement garder l’identité visuelle du reste du site (couleurs, polices, etc.). Je
  voudrais également une ligne sur deux avec un fond de couleur différente pour plus de lisibilité.
- Actuellement, pour supprimer un commentaire, je dois obligatoirement aller dans la base de données. Il me faudrait
  donc un système pour que, lorsque je suis connectée, je puisse facilement supprimer certains commentaires.

- je préfèrerais que vous n’utilisiez pas de librairie tierce. Même si je connais un peu de PHP, je préfère que le code
  reste simple !

---
## STEP BY STEP
### Étape 1 – Initialisez le projet
Récupérez le projet sur GitHub et installez-le en suivant les instructions du readme. Faites un fork du projet sur votre GitHub afin de pouvoir le livrer à la fin de la mission.
Recommandations

L’installation d’un projet peut parfois poser problème ; dans ce cas, pensez à vérifier les points suivants :

    Avez-vous créé votre base de données ? Est-elle lancée ? Est-elle bien remplie avec les tables nécessaires ? Y a-t-il des données dans ces tables ?
    Est-ce que vous avez bien modifié les fichiers de configuration pour vous connecter à votre base ?
    Est-ce que PHP est au moins en version 8 ? 

Si votre projet ne se lance toujours pas, peut-être avez-vous un message d’erreur qui s’affiche ? Que signifie-t-il ?

Et si vraiment après avoir tout tenté vous n’arrivez toujours pas à afficher le projet, demandez conseil à votre mentor, le problème est probablement plus facile à résoudre qu’il n’y paraît !

### Étape 2 – Stockez les informations manquantes

Le nombre de vues d’un article n’est pas stocké pour l’instant, mettez à jour la base de données et le code pour le faire.  
Recommandations

À chaque fois qu’il faut stocker une information supplémentaire, prenez quelques minutes pour vous poser ces questions :

    À quel endroit est-il pertinent / pratique de stocker la donnée ?
    Vaut-il mieux créer une nouvelle table, et dans ce cas, comment la lier à l’existant ? 
    Est-ce qu’ajouter un simple champ dans une table existante est suffisant ? 

Ces questions sont fondamentales, car votre projet repose entièrement sur ces données, et une base de données mal conçue peut ajouter beaucoup de complexité inutile à un projet.

### Étape 3 – Créez la page de monitoring

Créez la page admin de monitoring et affichez dedans l’ensemble des informations demandées.

Rappel : il n’est pas nécessaire que cet affichage soit responsive, il doit juste pouvoir s’afficher sur des écrans d’une taille supérieure ou égale à 1 366 px.  
Recommandations
- À ce stade, vous devez ajouter une nouvelle page ; la bonne question à se poser est donc : comment sont créées les pages actuelles ?
- En vous inspirant de ce qui existe déjà dans le code, vous pourrez créer facilement cette nouvelle page.
- Une autre question qui peut se poser, c’est
  - “Comment accéder à cette page ?” : créer un menu supplémentaire dans la partie administration ? un lien dans le menu actuel ? Ajouter un lien dans la page principale de la partie admin ? Une autre solution ? Essayez de vous mettre à la place d’Emilie qui doit accéder régulièrement à ce site, pour lui proposer une interface la plus agréable possible :-).

### Étape 4 – Mettez en place le tri

Mettez à jour la page de monitoring afin de pouvoir modifier l’affichage pour réaliser le tri. Ce tri devra être réalisé en PHP pur, sans librairie ni autre langage.
Recommandations

Avant de commencer, essayez de vous représenter la page : un tableau, des colonnes, et quand on clique sur les colonnes, la page se réaffiche, triée.

Il faut donc savoir sur quelle colonne l’utilisateur a cliqué. De plus, le tri peut se faire par ordre croissant ou décroissant. Comment stocker cette information ?

Visuellement, comment indiquer à l’utilisateur qu’il peut cliquer ou que l’ordre est croissant/décroissant ?

### Étape 5 – Supprimez les commentaires

Modifier l’interface pour qu’Emilie puisse facilement supprimer les commentaires.
Recommandations

Attention à trouver une interface qui soit agréable. Une page avec l’intégralité des commentaires et un bouton “Supprimer”, par exemple, risque d’être assez difficile à maintenir si les commentaires viennent à se multiplier.

### Étape Dernière étape : Vérifiez votre travail
Une fois votre travail terminé, prenez du recul sur cette activité :

> - Quelles tâches avez-vous réalisées ?
> - Qu'avez-vous appris à faire ?
> - Quels ont été les points de difficulté ?

---
## INSTALLATION utiliser ce projet :
- Commencer par cloner le projet.
- installez le projet chez vous, dans un dossier exécuté par un serveur local (type MAMP, WAMP, LAMP, etc...)
- Une fois installé chez vous, créez un base de données vide appelée : "blog_forteroche"
- Importez le fichier _blog_forteroche.sql_ dans votre base de données.

### Lancez le projet !
Pour la configuration du projet renomez le fichier _\_config.php_ (dans le dossier _config_) en _config.php_ et éditez le si nécessaire.
Ce fichier contient notamment les informations de connextion à la base de données.

Pour vous connecter en partie admin, le login est "Emilie" et le mot de passe est "password" (attention aux majuscules)

### Problèmes courants :

Il est possible que la librairie intl ne soit pas activée sur votre serveur par défaut. Cette librairie sert notamment à traduire les dates en francais. Dans ce cas, vous pouvez soit utiliser l'interface de votre serveur local pour activer l'extention (wamp), soit aller modifier directement le fichier _php.ini_.

Ce projet a été réalisé avec PHP 8.2. Bien que d'autres versions de PHP puissent fonctionner, il n'est pas garanti que le projet fonctionne avec des versions antérieures.

### Copyright :
Projet utilisé dans le cadre d'une formation Openclassrooms. 



