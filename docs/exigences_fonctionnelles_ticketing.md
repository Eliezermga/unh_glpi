# Exigences Fonctionnelles du Système de Ticketing GLPI UNH

**Version**: 1.0  
**Date**: 24 janvier 2026  
**Référence GitHub**: Issue #39  
**Auteur**: Groupe 7 - Projet GLPI UNH  

---

## 1. Objectif du Document

Ce document formalise les exigences fonctionnelles du système de ticketing GLPI personnalisé pour l'Université Nationale d'Haïti (UNH). Il sert de référence pour le développement, les tests et la validation des fonctionnalités.

---

## 2. Gestion Multi-Sites (Par Faculté)

### 2.1 Exigences de Structure Organisationnelle

| ID | Exigence | Priorité | Description |
|----|----------|----------|-------------|
| MS-001 | Entités par faculté | **MUST** | Le système doit permettre la création d'entités distinctes pour chaque faculté de l'UNH |
| MS-002 | Hiérarchie organisationnelle | **MUST** | Les entités doivent supporter une structure hiérarchique (UNH → Faculté → Département) |
| MS-003 | Affectation automatique | **SHOULD** | Les tickets créés par un utilisateur doivent être automatiquement affectés à son entité de rattachement |
| MS-004 | Visibilité inter-entités | **SHOULD** | Les administrateurs doivent pouvoir consulter les tickets de toutes les entités (vision globale) |
| MS-005 | Isolation des données | **MUST** | Les utilisateurs standards ne doivent voir que les tickets de leur propre entité |

### 2.2 Entités Prévues

```
UNH (Entité racine)
├── Faculté des Sciences
│   ├── Département Informatique
│   ├── Département Mathématiques
│   └── Département Physique
├── Faculté de Médecine
├── Faculté de Droit
├── Faculté d'Agronomie
├── Faculté des Sciences Humaines
└── Administration Centrale
```

### 2.3 Critères d'Acceptation

- [ ] Un ticket créé par un étudiant de la Faculté des Sciences apparaît uniquement dans cette entité
- [ ] Un technicien peut être assigné à plusieurs entités
- [ ] Les statistiques peuvent être filtrées par entité

---

## 3. Catégorisation des Tickets

### 3.1 Catégories Principales

| ID | Catégorie | Sous-catégories | Description |
|----|-----------|-----------------|-------------|
| CAT-001 | **Matériel** | Ordinateur, Imprimante, Écran, Périphériques, Réseau physique | Problèmes liés aux équipements physiques |
| CAT-002 | **Logiciel** | Installation, Mise à jour, Erreur application, Licence, Configuration | Problèmes liés aux applications |
| CAT-003 | **Réseau** | Connexion Internet, WiFi, VPN, Accès serveur, DNS | Problèmes de connectivité |
| CAT-004 | **Compte/Accès** | Création compte, Réinitialisation mot de passe, Droits d'accès | Gestion des identités |
| CAT-005 | **Impression** | File d'impression, Bourrage papier, Cartouche, Connexion imprimante | Services d'impression |
| CAT-006 | **Autre** | Demande générale, Formation, Conseil | Demandes diverses |

### 3.2 Exigences de Catégorisation

| ID | Exigence | Priorité | Description |
|----|----------|----------|-------------|
| CT-001 | Catégorie obligatoire | **MUST** | Tout ticket doit être associé à une catégorie |
| CT-002 | Catégorie modifiable | **SHOULD** | Un technicien peut recatégoriser un ticket si mal classé |
| CT-003 | Priorité automatique | **COULD** | Certaines catégories peuvent définir une priorité par défaut |
| CT-004 | Template par catégorie | **SHOULD** | Chaque catégorie peut avoir un formulaire personnalisé |

### 3.3 Niveaux de Priorité

| Niveau | Nom | Délai de réponse | Délai de résolution | Exemple |
|--------|-----|------------------|---------------------|---------|
| 1 | **Critique** | 1 heure | 4 heures | Serveur en panne, réseau global KO |
| 2 | **Haute** | 4 heures | 8 heures | Poste de travail critique HS |
| 3 | **Moyenne** | 8 heures | 24 heures | Logiciel non fonctionnel |
| 4 | **Basse** | 24 heures | 72 heures | Demande d'installation |
| 5 | **Planifiée** | 48 heures | 1 semaine | Amélioration, suggestion |

---

## 4. Notifications Automatisées

### 4.1 Événements Déclencheurs

| ID | Événement | Destinataire(s) | Priorité |
|----|-----------|-----------------|----------|
| NOT-001 | Création de ticket | Demandeur + Technicien assigné + Responsable entité | **MUST** |
| NOT-002 | Affectation/Réaffectation | Nouveau technicien assigné | **MUST** |
| NOT-003 | Mise à jour (commentaire) | Demandeur + Technicien | **MUST** |
| NOT-004 | Changement de statut | Demandeur | **MUST** |
| NOT-005 | Résolution | Demandeur | **MUST** |
| NOT-006 | Clôture | Demandeur (avec enquête satisfaction) | **SHOULD** |
| NOT-007 | Rappel SLA proche | Technicien + Superviseur | **SHOULD** |
| NOT-008 | SLA dépassé | Superviseur + Direction IT | **MUST** |
| NOT-009 | Ticket inactif (>72h) | Demandeur + Technicien | **COULD** |

### 4.2 Canaux de Notification

| Canal | Description | Priorité |
|-------|-------------|----------|
| Email | Notification principale | **MUST** |
| Notification GLPI | Alerte dans l'interface | **MUST** |
| SMS | Pour urgences critiques (optionnel) | **COULD** |

### 4.3 Contenu des Notifications

```
[UNH GLPI] Ticket #{ID} - {Titre}

Statut : {Statut actuel}
Priorité : {Priorité}
Catégorie : {Catégorie}
Assigné à : {Technicien}

Dernière mise à jour :
{Contenu du suivi}

---
Accéder au ticket : {URL}
```

### 4.4 Exigences Techniques

| ID | Exigence | Priorité | Description |
|----|----------|----------|-------------|
| NOT-T01 | Personnalisation templates | **SHOULD** | Les templates d'email doivent être personnalisables |
| NOT-T02 | Historique notifications | **MUST** | Toutes les notifications envoyées doivent être tracées |
| NOT-T03 | Opt-out partiel | **COULD** | Utilisateurs peuvent désactiver certaines notifications |

---

## 5. Base de Connaissances Publique

### 5.1 Exigences Fonctionnelles

| ID | Exigence | Priorité | Description |
|----|----------|----------|-------------|
| KB-001 | Accès public | **MUST** | La base doit être consultable sans authentification |
| KB-002 | Recherche plein texte | **MUST** | Moteur de recherche efficace sur le contenu des articles |
| KB-003 | Catégorisation articles | **MUST** | Articles organisés par catégories (alignées avec les tickets) |
| KB-004 | Articles liés aux tickets | **SHOULD** | Possibilité de lier un article FAQ à un ticket |
| KB-005 | Statistiques consultation | **SHOULD** | Suivi des articles les plus consultés |
| KB-006 | Suggestion auto | **COULD** | Lors de la création de ticket, suggérer des articles pertinents |
| KB-007 | Feedback utilisateur | **COULD** | Permettre de noter l'utilité d'un article |

### 5.2 Structure de la Base

```
Base de Connaissances
├── 📁 Matériel
│   ├── Comment connecter une imprimante réseau
│   ├── Problèmes courants avec les ordinateurs UNH
│   └── Guide de maintenance préventive
├── 📁 Logiciels
│   ├── Installation de la suite Office
│   ├── Configuration VPN UNH
│   └── Accès aux ressources pédagogiques
├── 📁 Réseau
│   ├── Connexion au WiFi campus
│   ├── Diagnostic problème Internet
│   └── Configuration proxy
├── 📁 Comptes & Accès
│   ├── Réinitialisation mot de passe
│   ├── Première connexion étudiant
│   └── Demande de droits supplémentaires
└── 📁 Guides Généraux
    ├── Comment créer un ticket
    ├── FAQ du helpdesk
    └── Horaires et contacts support
```

### 5.3 Critères d'Acceptation

- [ ] Un utilisateur non connecté peut consulter les articles publics
- [ ] La recherche retourne des résultats pertinents en moins de 2 secondes
- [ ] Les articles sont formatés clairement (titres, captures d'écran, étapes numérotées)

---

## 6. Tableaux de Bord & Statistiques

### 6.1 Métriques Clés (KPIs)

| Métrique | Description | Fréquence | Priorité |
|----------|-------------|-----------|----------|
| Volume de tickets | Nombre total de tickets créés | Quotidien/Mensuel | **MUST** |
| Tickets par catégorie | Répartition par type de problème | Mensuel | **MUST** |
| Tickets par entité | Répartition par faculté | Mensuel | **MUST** |
| Temps moyen de réponse | Délai entre création et premier commentaire | Mensuel | **MUST** |
| Temps moyen de résolution | Délai entre création et résolution | Mensuel | **MUST** |
| Taux de résolution au 1er contact | % de tickets résolus sans suivi | Mensuel | **SHOULD** |
| Taux de respect SLA | % de tickets résolus dans les délais | Mensuel | **MUST** |
| Taux de satisfaction | Note moyenne des enquêtes de satisfaction | Mensuel | **SHOULD** |
| Tickets en retard | Nombre de tickets ayant dépassé le SLA | Temps réel | **MUST** |
| Charge par technicien | Nombre de tickets assignés par agent | Hebdomadaire | **SHOULD** |

### 6.2 Tableaux de Bord

#### 6.2.1 Dashboard Opérationnel (Techniciens)

| Widget | Contenu |
|--------|---------|
| Mes tickets ouverts | Liste des tickets assignés à l'utilisateur |
| Tickets en attente | Tickets non assignés dans mon entité |
| Alertes SLA | Tickets proches ou au-delà du SLA |
| Activité récente | Dernières mises à jour de mes tickets |

#### 6.2.2 Dashboard Superviseur

| Widget | Contenu |
|--------|---------|
| Vue d'ensemble entité | Tickets ouverts/fermés par statut |
| Performance équipe | Temps de résolution par technicien |
| Tendances | Graphique d'évolution du volume |
| Top catégories | Catégories les plus fréquentes |

#### 6.2.3 Dashboard Direction

| Widget | Contenu |
|--------|---------|
| KPIs globaux | Synthèse mensuelle tous sites |
| Comparaison inter-sites | Performance par faculté |
| Satisfaction utilisateurs | Score NPS et commentaires |
| Coûts et ressources | Charge de travail globale |

### 6.3 Rapports Mensuels

| Rapport | Contenu | Destinataires |
|---------|---------|---------------|
| Rapport d'activité | Volume, catégories, résolutions | Direction IT |
| Rapport SLA | Conformité aux engagements | Direction |
| Rapport par entité | Statistiques par faculté | Responsables facultés |
| Rapport satisfaction | Résultats enquêtes | Direction IT |

### 6.4 Exigences Techniques

| ID | Exigence | Priorité | Description |
|----|----------|----------|-------------|
| STAT-001 | Export données | **MUST** | Possibilité d'exporter en CSV/PDF |
| STAT-002 | Filtres personnalisés | **SHOULD** | Filtrage par période, entité, catégorie, technicien |
| STAT-003 | Graphiques interactifs | **SHOULD** | Visualisations dynamiques (camemberts, barres, tendances) |
| STAT-004 | Planification rapports | **COULD** | Envoi automatique des rapports par email |
| STAT-005 | Temps réel | **SHOULD** | Actualisation des données sans rechargement |

---

## 7. Matrice de Priorisation (MoSCoW)

### 7.1 MUST HAVE (Obligatoire)

- ✅ Gestion multi-entités par faculté
- ✅ Catégorisation des tickets (6 catégories principales)
- ✅ Notifications email à la création, mise à jour, résolution
- ✅ Base de connaissances accessible publiquement
- ✅ Statistiques de volume et délais de résolution

### 7.2 SHOULD HAVE (Important)

- 🔶 Templates personnalisés par catégorie
- 🔶 Enquêtes de satisfaction post-résolution
- 🔶 Dashboard temps réel pour superviseurs
- 🔶 Suggestion automatique d'articles FAQ
- 🔶 Alertes SLA automatiques

### 7.3 COULD HAVE (Souhaitable)

- 🔷 Notifications SMS pour urgences
- 🔷 Planification automatique des rapports
- 🔷 Opt-out personnalisé des notifications
- 🔷 Système de notation des articles KB

### 7.4 WON'T HAVE (Hors périmètre v1)

- ❌ Application mobile native
- ❌ Chatbot d'assistance
- ❌ Intégration messagerie instantanée (Teams/Slack)

---

## 8. Annexes

### 8.1 Glossaire

| Terme | Définition |
|-------|------------|
| **Ticket** | Demande d'assistance ou incident signalé |
| **SLA** | Service Level Agreement - Engagement de délai |
| **Entité** | Division organisationnelle (faculté, département) |
| **KB** | Knowledge Base - Base de connaissances |
| **KPI** | Key Performance Indicator - Indicateur clé |

### 8.2 Références

- [Documentation GLPI officielle](https://glpi-project.org/documentation/)
- [Memory Bank - Project Brief](../memory-bank/projectbrief.md)
- [Memory Bank - Product Context](../memory-bank/productContext.md)

---

## 9. Historique des Versions

| Version | Date | Auteur | Modifications |
|---------|------|--------|---------------|
| 1.0 | 24/01/2026 | Groupe 7 | Version initiale |

---

> [!NOTE]
> Ce document est un livrable vivant. Il sera mis à jour au fur et à mesure de l'avancement du projet et des retours utilisateurs.
