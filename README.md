SeanceBundle
============

Bundle de séance pour le Net BS (https://github.com/sysmoh/intranetBS)

Installation
------------

``` composer require interne/seancebundle --prefer-dist dev-stable ```


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

```

```
# /app/AppKernel.php

	$bundles = array (
		// ...
		new Interne\SeanceBundle\InterneSeanceBundle(),
	);
```