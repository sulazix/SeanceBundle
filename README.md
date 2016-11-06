SeanceBundle
============

Gestionnaire de séances pour Symfony

Pré-requis
----------

- http://jmsyst.com/bundles/JMSSerializerBundle
- https://github.com/FriendsOfSymfony/FOSJsRoutingBundle
- http://symfony.com/doc/master/bundles/FOSRestBundle/index.html
- https://packagist.org/packages/ensepar/html2pdf-bundle
- http://symfony.com/doc/2.8/assetic/asset_management.html # Symfony >= 2.8



Installation
------------

```
cd path/to/symfony
# installer le bundle
composer require interne/seancebundle --prefer-dist dev-stable
# installer les bundle de dépendences
composer require jms/serializer-bundle friendsofsymfony/jsrouting-bundle friendsofsymfony/rest-bundle ensepar/html2pdf-bundle
composer require symfony/assetic-bundle # symfony >= 2.8

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
    prefix:   /seance-api
    options:
        expose: true

seance:
    resource: "@InterneSeanceBundle/Resources/config/routing.yml"
    prefix:   /seance


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

# PDF Exports
ensepar_html2pdf:
    orientation: P
    format: A4
    lang: fr
    unicode: true
    encoding: UTF-8
    margin: [10,15,10,15]

```

Mettre à jour les bundles chargés depuis le kernel Symfony :

```
# /app/AppKernel.php

    $bundles = array (
        // ...
        new Interne\SeanceBundle\InterneSeanceBundle(),

        // Si pas encore activés :
        new Ensepar\Html2pdfBundle\EnseparHtml2pdfBundle(),
        new JMS\SerializerBundle\JMSSerializerBundle(),
        new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
        new FOS\RestBundle\FOSRestBundle(),
        new Symfony\Bundle\AsseticBundle\AsseticBundle(),
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
