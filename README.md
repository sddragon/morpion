Voici les prompts:
Remplacez la route d’accueil existante par une route GET / vers la méthode index de PartieController,
nommée parties.index: est ce que cette ligne respecte la consigne

Créez un gabarit layouts/app.blade.php (structure HTML, titre « Morpion », un peu de CSS, un emplacement
@yield(’contenu’)): est ce que cette ligne respecte la consigne:<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Morpion</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <h1>Bonjour !</h1>
  <p>Ceci est une page HTML de base.</p>
  @yield('content')
  
</body>
</html>

Créez la vue parties/show.blade.php qui étend ce gabarit et affiche les 9 cases à partir d’une variable
$cases (tableau de 9 éléments), avec @foreach.: est ce que mon code respecte la consigne :@extends('layouts.app')
@foreach ($parties as $partie)
    <div>
        <h2>Morpion</h2>

<table style="width:100%">
  <tr>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>                   </td>
  </tr>
  <tr>
    <td></td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>

  1. Remplacez la route d’accueil existante par une route GET / vers la méthode index de PartieController,
nommée parties.index.
2. Créez un gabarit layouts/app.blade.php (structure HTML, titre « Morpion », un peu de CSS, un emplacement
@yield(’contenu’)).
3. Créez la vue parties/show.blade.php qui étend ce gabarit et affiche les 9 cases à partir d’une variable
$cases (tableau de 9 éléments), avec @foreach.
4. Dans index, construisez un tableau de 9 cases vides (indice : array_fill) et transmettez-le à la vue
parties.show.

les caese sont en lignes


1. Complétezlamigration,puislancez-la.
2. DanslemodèlePartie:autorisezl’affectationdemassedeplateauetjoueur_courant(propriété
$fillable,ouattribut#[Fillable]deLaravel13)etajoutezuneméthodecases(): arrayqui renvoieles9
casesduplateau(indice:str_split).
3. AjoutezlesroutesPOST /parties storeetGET /parties/{partie} show(noms:voir laciblefinale).
4. storecréeunepartie(lesvaleurspardéfautsuffisent)puisredirigeversparties.show;show(Partie
$partie)afficheparties.showaveclescasesdecettepartieet laphrase«Autourde:X».
5. indexaffichemaintenantunenouvellevueparties/index.blade.phpcontenantunformulairePOSTavecun
bouton«Nouvellepartie».

peux tu me faire chaque etape de ce document


    </div>
