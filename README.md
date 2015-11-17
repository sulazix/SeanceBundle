SeanceBundle
============

Bundle de séance pour le Net BS (https://github.com/sysmoh/intranetBS)

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


framework: # if not using twig
    templating:
        engines: ['twig']

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

nelmio_api_doc: ~
```

Mettre à jour les bundles chargés depuis le kernel Symfony :

```
# /app/AppKernel.php

    $bundles = array (
        // ...
        new Interne\SeanceBundle\InterneSeanceBundle(),
        new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
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
