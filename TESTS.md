# Rapport de Tests Unitaires - Projet GLPI (UNH)

## 1. Description de l'unité testée
* **Fichiers concernés :** `softwarelicence.html.twig` et `Line.html.twig`
* **Fonctionnalité :** Affichage des licences et calcul automatique du montant total des lignes.

## 2. Méthodologie
* **Type de test :** Test Unitaire (Boîte Blanche).
* **Environnement :** PHP 8.x via XAMPP.
* **Outil :** Script de test manuel PHP simulant les données Twig.

## 3. Scénarios de test
| Cas de test | Résultat attendu | Résultat obtenu | Statut |
| :--- | :--- | :--- | :--- |
| Calcul du total | Prix (50) x Qté (3) = 150 | 150 | ✅ SUCCÈS |
| Affichage nom | Nom non vide | "GLPI UNH Enterprise" | ✅ SUCCÈS |

## 4. Preuve d'exécution
*(Voir la capture d'écran jointe dans le dossier ou ci-dessous)*

## . Test d'Intégration
- **Objectif :** Vérifier la présence du fichier dans l'arborescence GLPI.
- **Chemin :** templates/pages/management/softwarelicense.html.twig
- **Résultat :** [OK] - Fichier détecté et intégré.