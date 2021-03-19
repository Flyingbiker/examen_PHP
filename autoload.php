<?php

// cette fonction est appelée dès que le code
// a besoin d'utiliser une classe
spl_autoload_register(function ($class) {
    // $class contient le namespace + nom de classe complet
    // e.g: "Component\Request"
    // pour charger le fichier correspondant, il suffit de remplacer
    // les anti-slash "\" par des slash "/"
    // puis de concaténer l'extension .php afin d'obtenir
    // "Component/Request.php"
    $file = str_replace('\\', '/', $class) . '.php';
    // cela fonctionne car les noms des dossiers correspondent
    // aux namespaces des classes
    if (is_file($file)) {        
        require $file; // equiv: require "Component/Request.php";
    }
});