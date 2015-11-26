SeanceBundle
============

Bundle de séance pour le Net BS (https://github.com/sysmoh/intranetBS)

Pré-requis
----------

- http://jmsyst.com/bundles/JMSSerializerBundle
- https://github.com/FriendsOfSymfony/FOSJsRoutingBundle
- http://symfony.com/doc/master/bundles/FOSRestBundle/index.html

Pour utiliser le le frontend angular en dehors de l'intranet BS il vous faudra également ajouter ce fichier de layout (ainsi que les dépendances qui vont avec) :

- https://github.com/sysmoh/intranetBS/blob/master/src/AppBundle/Resources/views/Layout/layout.html.twig


Installation
------------

```
cd path/to/intranetBS
composer require interne/seancebundle --prefer-dist dev-stable
```

Si vous souhaitez utiliser le frontend Angular par défaut 
```
cd path/to/seance/bundle # vendor/interne/seancebundle si installé via composer
bower install # charger les dépendances pour angular
npm install # installer les dépendances grunt
grunt build # générer les fichiers angular minifiés
```

Configuration
-------------

> **Important :**

> Valide uniquement pour 'dev-master' pour le moment

Enregistrer les routes du bundle dans l'application :

```
# app/config/routing.yml

seance_api:
    type:     rest
    resource: "@InterneSeanceBundle/Resources/config/routing_rest.yml"
    prefix:   /intranet/seance-api
    options:
        expose: true

seance:
    resource: "@InterneSeanceBundle/Resources/config/routing.yml"
    prefix:   /intranet/seance


```

Enregistrer les services du bundle dans la config :

```
# app/config/config.yml

imports:
    # ...
    - { resource: "@InterneSeanceBundle/Resources/config/services.yml" }


assetic:
    # ...
    bundles:
        # ...
        - InterneSeanceBundle


fos_rest:
    body_listener: true
    routing_loader:
        default_format: json
        include_format: false

```

Mettre à jour les bundles chargés depuis le kernel Symfony :

```
# /app/AppKernel.php

    $bundles = array (
        // ...
        new Interne\SeanceBundle\InterneSeanceBundle(),
    );
```

Générer les tables en base de données
-------------------------------------

``` php app/console doctrine:schema:update --force ```


Technologies utilisées
----------------------

- http://symfony.com/
- http://1.semantic-ui.com/
- https://angularjs.org/

Voir les fichiers composer.json, bower.json et package.json pour les détails des modules utilisés.
