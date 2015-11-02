SeanceBundle
============

Bundle de séance pour le Net BS (https://github.com/sysmoh/intranetBS)

Installation
------------

``` composer require interne/seancebundle --prefer-dist dev-stable ```

> **Note :**

> Veillez à bien lancer la commande ``` bower install ``` dans le répertoire racine du bundle afin d'installer les composants requis pour le frontend


Configuration
-------------

> **Important :**

> Valide uniquement pour 'dev-master' pour le moment

Enregistrer les routes du bundle dans l'application :

```
# app/config/routing.yml

interne_seance:
    resource: "@InterneSeanceBundle/Resources/config/routing.yml"
    prefix:   /interne/seance


seance_api:
    type:     rest
    resource: "@InterneSeanceBundle/Resources/config/routing_rest.yml"
    prefix:   /api


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
- http://vitalets.github.io/angular-xeditable/
- https://angularjs.org/