# Plugin UNH Assets pour GLPI 10.0.7

Plugin de gestion avancée du parc informatique universitaire pour GLPI.

## 📋 Fonctionnalités

### ✅ Tâche 1 : Gestion centralisée du parc informatique

- Base de données complète des équipements (PC, imprimantes, projecteurs, serveurs, etc.)
- Informations détaillées : marque, modèle, localisation, utilisateur, date d’achat, état
- Interface de consultation avec filtrage par type, bâtiment ou salle
- Système de modification et mise à jour par les techniciens
- Alertes pour matériel en panne ou hors service

### ✅ Tâche 2 : Module de réservation de matériel

- Calendrier pour chaque salle et matériel réservable
- Réservation par créneau horaire (date, heure début/fin)
- Notifications de confirmation ou refus
- Historique des réservations
- Blocage automatique des conflits

### ✅ Tâche 3 : Gestion des licences logicielles

- Enregistrement de toutes les licences (nom, version, expiration, postes)
- Alertes automatiques avant expiration (configurable)
- Interface de visualisation des licences valides/expirées
- Suivi par logiciel et département

### ✅ Tâche 4 : Tableau de bord et rapports

- Vue synthétique de l’état du parc
- Statistiques : nombre d’équipements, répartition par salle, incidents
- Graphiques de visualisation
- Export PDF et Excel
- Filtres par bâtiment, département, type
- Suivi des incidents ouverts/résolus

## 🚀 Installation

### Prérequis

- GLPI 10.0.0 minimum (testé sur 10.0.7)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Accès administrateur à GLPI

### Installation étape par étape

1. **Télécharger le plugin**
   
   ```bash
   cd /var/www/html/glpi/plugins/
   ```
1. **Créer le dossier du plugin**
   
   ```bash
   mkdir unhassets
   ```
1. **Copier tous les fichiers dans la structure suivante** :
   
   ```
   plugins/unhassets/
   ├── setup.php
   ├── hook.php
   ├── README.md
   ├── inc/
   │   ├── asset.class.php
   │   ├── reservation.class.php
   │   ├── license.class.php
   │   ├── profile.class.php
   │   └── menu.class.php
   ├── front/
   │   ├── asset.php
   │   ├── asset.form.php
   │   ├── reservation.php
   │   ├── reservation.form.php
   │   ├── license.php
   │   ├── license.form.php
   │   ├── dashboard.php
   │   └── export.php
   └── locales/
       └── fr_FR.php
   ```
1. **Ajuster les permissions**
   
   ```bash
   chown -R www-data:www-data /var/www/html/glpi/plugins/unhassets
   chmod -R 755 /var/www/html/glpi/plugins/unhassets
   ```
1. **Installer depuis l’interface GLPI**
- Connectez-vous à GLPI en tant qu’administrateur
- Allez dans **Configuration > Plugins**
- Trouvez “UNH Assets Management” dans la liste
- Cliquez sur **Installer**
- Puis sur **Activer**
1. **Configurer les droits**
- Allez dans **Administration > Profils**
- Sélectionnez un profil (ex: Super-Admin)
- Dans l’onglet du profil, donnez les droits sur “UNH Assets”

## 📖 Utilisation

### Accès au plugin

Une fois activé, le menu **UNH Assets** apparaît dans le menu principal de GLPI avec les sous-menus :

- **Parc informatique** : Gestion des équipements
- **Réservations** : Gestion des réservations
- **Licences** : Gestion des licences logicielles
- **Tableau de bord** : Vue d’ensemble et rapports

### Gestion du parc informatique

1. **Ajouter un équipement**
- Aller dans “Parc informatique”
- Cliquer sur “+” pour ajouter
- Remplir les informations (bâtiment, salle, marque, modèle, etc.)
- Enregistrer
1. **Lier à un ordinateur existant**
- Ouvrir une fiche ordinateur GLPI
- Onglet “Info UNH Assets”
- Compléter les informations spécifiques

### Réservations

1. **Créer une réservation**
- Aller dans “Réservations”
- Cliquer sur “+”
- Sélectionner l’équipement
- Choisir la date et l’heure
- Indiquer l’objet de la réservation
- Le système vérifie automatiquement les conflits
1. **Approuver/Rejeter**
- Modifier le statut de la réservation
- L’utilisateur reçoit une notification

### Gestion des licences

1. **Ajouter une licence**
- Aller dans “Licences”
- Cliquer sur “+”
- Remplir : nom, logiciel, version, clé, dates
- Configurer le seuil d’alerte (défaut: 30 jours)
1. **Alertes automatiques**
- Le système vérifie quotidiennement les expirations
- Alertes envoyées selon le seuil configuré

### Tableau de bord

- **Vue d’ensemble** : Statistiques en temps réel
- **Filtres** : Par bâtiment, département, type
- **Export** : PDF ou Excel pour rapports

## 🔧 Configuration avancée

### Tâche automatique (Cron)

Pour activer les alertes de licences :

1. Aller dans **Configuration > Actions automatiques**
1. Activer “plugin_unhassets_checkexpiration”
1. Configurer la fréquence (recommandé: quotidien)

### Notifications

Configurer les notifications dans **Configuration > Notifications** pour :

- Nouvelles réservations
- Changements de statut
- Alertes d’expiration de licences

## 🛠️ Personnalisation

### Ajouter des catégories d’équipements

Éditer `inc/asset.class.php`, ligne ~100 :

```php
$categories = ['PC' => 'PC', 'Imprimante' => 'Imprimante', 
               'VotreNouvelleCatégorie' => 'Label'];
```

### Modifier les statuts

Éditer les tableaux `$statuses` dans les fichiers de classe respectifs.

## 📊 Base de données

Le plugin crée 4 tables :

- `glpi_plugin_unhassets_assets` : Équipements
- `glpi_plugin_unhassets_reservations` : Réservations
- `glpi_plugin_unhassets_licenses` : Licences
- `glpi_plugin_unhassets_profiles` : Profils/Droits

## 🐛 Dépannage

### Le plugin n’apparaît pas

- Vérifier les permissions des fichiers
- Vérifier que tous les fichiers sont présents
- Consulter les logs : `files/_log/php-errors.log`

### Erreur lors de l’installation

- Vérifier la version de GLPI (>= 10.0.0)
- Vérifier les droits sur la base de données
- Consulter les logs MySQL

### Les menus ne s’affichent pas

- Vider le cache : **Configuration > Outils > Vider le cache**
- Vérifier les droits du profil utilisateur
- Se déconnecter et reconnecter

## 📝 Support

Pour toute question ou problème :

1. Vérifier la documentation ci-dessus
1. Consulter les logs GLPI
1. Contacter le support technique de votre université

## 📄 Licence

Ce plugin est distribué sous licence GPLv2+

## ✅ Checklist de déploiement

- [ ] GLPI 10.0.7 installé et fonctionnel
- [ ] Fichiers du plugin copiés
- [ ] Permissions configurées
- [ ] Plugin installé via l’interface
- [ ] Plugin activé
- [ ] Droits configurés pour les profils
- [ ] Test de création d’équipement
- [ ] Test de réservation
- [ ] Test de licence
- [ ] Tableau de bord accessible
- [ ] Exports fonctionnels

## 🎯 Prochaines étapes

Une fois le plugin installé, vous pouvez :

1. Importer votre parc existant
1. Former les utilisateurs
1. Configurer les notifications
1. Activer les tâches automatiques
1. Personnaliser selon vos besoins

-----

**Version** : 1.0.0  
**Auteur** : Votre Université  
**Date** : Janvier 2025