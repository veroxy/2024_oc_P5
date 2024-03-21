Développez des sites avec PHP et le modèle MVC
Pourquoi réaliser cet exercice ?
---

> Le but de cet exercice est de vous entraîner à la programmation orientée objet. Il permettra également d’utiliser le langage PHP d’une manière moins classique puisque vous l’utiliserez directement en ligne de commande. L’avantage ici est que vous n’aurez pas à vous soucier de problèmes d’affichage pour vous concentrer uniquement sur les nouvelles notions. 
Découvrez votre exercice

Fonctionnalités
- Afficher la liste des contacts : list.
- Afficher le détail d’un contact : detail.
- Ajouter un contact : create [name], [email], [phone number].
- Supprimer un contact : delete [id].
- Quitter le programme : quit.
- En bonus : vous pouvez décider d’ajouter une commande pour afficher l’aide et une autre pour modifier un contact. 

Dans cet exercice, vous allez créer un gestionnaire de carnet d’adresses utilisable dans un terminal en ligne de commande. Lorsque votre programme sera lancé, il devra proposer plusieurs options dans la console : 

- Afficher la liste des contacts : list.
- Afficher le détail d’un contact : detail.
- Ajouter un contact : create [name], [email], [phone number].
- Supprimer un contact : delete [id].
- Quitter le programme : quit.
- En bonus : vous pouvez décider d’ajouter une commande pour afficher l’aide et une autre pour modifier un contact. 

Voici un exemple de l’usage du programme lorsque vous l’aurez créé : 
```
Entrez votre commande (aide, lister, détailler, créer, supprimer, quitter) : aide                                                                                                                                              

help : affiche cette aide

list : liste les contacts

create [name], [email], [phone number] : crée un contact

delete [id] : supprime un contact

quit : quitte le programme

 Attention à la syntaxe des commandes, les espaces et virgules sont importants.

Entrez votre commande (help, list, detail, create, delete, quit) : list                                                                                                                                          

Liste des contacts :
id, name, email, phone number
3, Gandalf le gris, gandalf@istari.com, 01013021
4, Buffy Summer, buffy@sunnydale.com, 01091901
5, Hermione Granger, hermione@magie.com, 19091979
Entrez votre commande (help, list, detail, create, delete, quit) : detail 3     
3, Gandalf le gris, gandalf@istari.com, 01013021

Entrez votre commande (help, list, detail, create, delete, quit) : quit
```
Lorsque l’outil affiche les détails d’un utilisateur, c’est son id qui s’affiche en premier et qui nous servira à identifier l’utilisateur que l’on veut gérer. Ici, les utilisateurs 1 et 2 ont été supprimés, c’est pourquoi nous n’avons que 3, 4 et 5 dans la liste.

Cet exercice est entièrement guidé. Suivez pas à pas les étapes ci-dessous afin de créer le code vous-même. 

Les étapes 1 à 6 vous guideront pour mettre en place votre code et votre première commande. C’est toujours la première commande qui prend le plus de temps ! C’est donc normal de passer la majorité du projet sur la première commande, puis d’aller plus vite sur les autres. À l’étape 7, vous compléterez votre code pour y intégrer les 4 autres commandes en réutilisant ce que vous aurez appris et déjà mis en place.
