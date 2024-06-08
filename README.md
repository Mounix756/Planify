#Je suppose qu'on aura aussi à faire le mobile plutard pour nous même, c'est pourquoi je crée dans le controller le dossier api
#Dans le dossier API on mettra toutes les fonctions qui auront trait avec notre api et dans Web ceux qui auront trait avec le web.

#Pour l'instant on ne va pas toucher l'api, je vais finir l'authentication et lorsque vous seriez sur d'autres fonctionnalités, je vais essayer de faire l'api et si possible le mobile.

#On va créer des branches sur github, mais ça je vais le faire avec mon pc perso, chacun créer une branche avec son nom.

#J'avais déjà intégrer le template du coup j'ai fais juste copier coller, maintenant on va attaquer le register.
#Toi tu peux parler hein, parce que si tu écris il va falloir que je retourne d'abord sur le meet pour lire.

Bon on va gérer le logo après.

# On fait l'inscription
1. On va faire la migration de la table users.
2. Je vais ajouter un attribut token dans cette table, c'est lui qui va contenir le code secret.
3. Je vais aussi ajouter un attribut verified_at, j'utilise une logique selon laquelle, l'utilisateur doit cliquer sur le lien ou bien entrer son otp dans les 5min suivant l'envoi du lien, sinon après le lien s'expire.
4. On y va. Tu me suis? Tu peux parler. Je ne t'entend pas, ou bien tu dors?

# Je viens de créer le mail, c'est une classe qu'on va lui faire prendre des trucs en parametre.


