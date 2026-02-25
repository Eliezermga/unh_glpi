# Documentation — Module Assistance UNH GLPI

**Projet** : UNH GLPI — Instance universitaire  
**Date** : Février 2026  
**Service** : Service Informatique UNH

---

## Table des matières

1. [Organisation de l'inventaire](#1-organisation-de-linventaire)
2. [Support technique](#2-support-technique)
3. [Foire aux questions (FAQ)](#3-foire-aux-questions-faq)

---

## 1. Organisation de l'inventaire

### 1.1 Statuts des équipements

Six statuts ont été définis pour suivre le cycle de vie du matériel universitaire. Ils sont accessibles depuis le champ **Statut** de chaque fiche d'équipement.

| Statut | Description | Applicable aux licences / certificats |
|--------|-------------|:-------------------------------------:|
| En service | Equipement opérationnel et assigné à un utilisateur | Oui |
| En maintenance | Maintenance planifiée ou préventive en cours | Non |
| Hors service | Equipement défaillant ou mis au rebut | Non |
| En réparation | Envoyé en atelier ou chez un prestataire | Non |
| En stock | Disponible mais non attribué (réserve) | Non |
| Réservé | Bloqué pour un usage ou un projet spécifique | Non |

### 1.2 Types de lieux

Les lieux sont qualifiés par un champ `Type de lieu` qui permet de hiérarchiser et filtrer les emplacements sur le campus.

| Type | Usage |
|------|-------|
| Site | Bâtiment principal ou campus entier |
| Bâtiment | Immeuble ou aile spécifique |
| Etage | Niveau dans un bâtiment |
| Salle | Salle de cours, bureau, laboratoire |
| Autre | Espace non catégorisé |

### 1.3 Consulter l'inventaire

1. Menu principal → **Inventaire**
2. Choisir le type d'équipement (Ordinateurs, Moniteurs, Réseau, Imprimantes, etc.)
3. Utiliser les filtres **Statut**, **Lieu**, **Utilisateur** ou **Groupe** pour affiner la recherche
4. Exporter les résultats en CSV si nécessaire

---

## 2. Support technique

### 2.1 Catégories de tickets

Les tickets sont classés selon une arborescence à deux niveaux. Cette classification est visible lors de la création d'un ticket via **Assistance > Créer un ticket**.

**Support Etudiant**

| Sous-catégorie | Type |
|----------------|------|
| Problème de connexion | Incident |
| Demande de compte | Demande |
| Logiciel pédagogique | Incident / Demande |
| Plateforme pédagogique | Incident |
| Imprimante / Impression | Incident |

**Support Enseignant**

| Sous-catégorie | Type |
|----------------|------|
| Equipement salle de cours | Incident |
| Vidéoprojecteur | Incident |
| Ordinateur portable / Bureau | Incident |
| Plateforme pédagogique | Incident / Demande |
| Logiciel pédagogique | Incident / Demande |

**Support Réseau**

| Sous-catégorie | Type | Visible Self-Service |
|----------------|------|:--------------------:|
| WiFi / Sans fil | Incident | Oui |
| Câblage réseau | Incident | Non (technique seul) |
| Serveurs | Incident / Problème | Non (technique seul) |
| Infrastructure réseau | Incident / Problème | Non (technique seul) |

**Support Matériel**

| Sous-catégorie | Type |
|----------------|------|
| Ordinateur | Incident / Demande |
| Ecran / Moniteur | Incident |
| Imprimante | Incident |
| Périphérique | Incident / Demande |
| Téléphone / VoIP | Incident |

**Support Logiciel**

| Sous-catégorie | Type |
|----------------|------|
| Installation logiciel | Demande |
| Licence logicielle | Demande |
| Panne logicielle | Incident |
| Mise à jour / Mise à niveau | Demande |

**Support Administratif**

| Sous-catégorie | Type |
|----------------|------|
| Système de gestion | Incident |
| Accès aux données | Demande |
| Equipement bureautique | Incident |

**Sécurité**

| Sous-catégorie | Type |
|----------------|------|
| Virus / Malware | Incident |
| Tentative d'intrusion | Incident (technique seul) |
| Perte de données | Incident |

### 2.2 Cycle de vie d'un ticket

```
Nouveau  →  En cours (attribué)  →  En attente  →  Résolu  →  Clos
```

| Etat | Description |
|------|-------------|
| Nouveau | Ticket soumis, non encore pris en charge |
| En cours (attribué) | Un technicien est assigné et travaille sur le ticket |
| En attente | Le technicien attend une réponse ou une information de l'utilisateur |
| Résolu | La solution a été appliquée, en attente de validation |
| Clos | Ticket terminé et archivé |

L'utilisateur reçoit une notification email à chaque changement d'état.

### 2.3 Gabarits de tâches

Des gabarits pré-remplis sont disponibles pour les techniciens afin d'accélérer la saisie des tâches.

| Gabarit | Durée estimée |
|---------|:---:|
| Diagnostic matériel — Ordinateur | 2h |
| Diagnostic réseau — Connexion | 1h |
| Diagnostic logiciel — Plantage | 1h30 |
| Maintenance préventive — Ordinateur | 1h30 |
| Remplacement d'équipement | 3h |
| Mise à jour firmware — Réseau | 2h |
| Installation logicielle — Application | 1h30 |
| Configuration système — Nouveau poste | 2h30 |
| Configuration utilisateur — Nouveau compte | 1h |
| Formation logicielle — Utilisateur | 2h |
| Support à distance — Assistance | 1h |
| Support sur site — Intervention | 2h |

Pour utiliser un gabarit : ouvrir un ticket, aller dans l'onglet **Tâches**, cliquer sur **+ Ajouter**, puis sélectionner **Utiliser un gabarit**.

---

## 3. Foire aux questions (FAQ)

La base de connaissances est accessible depuis **Outils > Base de connaissances** ou depuis le portail Self-Service. Dix articles sont disponibles pour les utilisateurs.

### 3.1 Liste des articles

| N° | Sujet | Catégorie | Public |
|----|-------|-----------|--------|
| 1 | Comment créer un ticket de support ? | Guide Général | Tous |
| 2 | Comment réinitialiser mon mot de passe ? | Compte / Accès | Tous |
| 3 | Comment se connecter au WiFi du campus ? | Réseau | Etudiants, Personnel |
| 4 | Mon ordinateur ne démarre plus, que faire ? | Matériel | Tous |
| 5 | Comment installer un logiciel ? | Logiciel | Etudiants, Personnel |
| 6 | L'imprimante ne fonctionne pas | Impression | Tous |
| 7 | Comment accéder à mes fichiers à distance ? | Réseau | Personnel, Enseignants |
| 8 | Mon écran reste noir ou figé | Matériel | Tous |
| 9 | Comment suivre l'état de mon ticket ? | Guide Général | Tous |
| 10 | Les raccourcis clavier utiles | Guide Général | Tous |

### 3.2 Résumé des articles

**Article 1 — Créer un ticket**  
Procédure pas à pas : connexion, menu Assistance, remplissage du formulaire (titre, catégorie, description, urgence), envoi. Une confirmation par email est envoyée automatiquement.

**Article 2 — Réinitialiser son mot de passe**  
Deux méthodes : lien «Mot de passe oublié» sur la page de connexion (via email universitaire), ou contact direct du support si l'accès email est perdu.

**Article 3 — Connexion WiFi**  
Réseaux disponibles : `UNH-Campus` (personnel) et `UNH-Etudiant` (étudiants). Identifiant = matricule universitaire, mot de passe = mot de passe universitaire.

**Article 4 — Ordinateur qui ne démarre pas**  
Vérifications de base (alimentation, câble écran, bouton power). Tableau de diagnostic par symptôme. Si le problème persiste, créer un ticket en précisant la marque, le modèle et les symptômes.

**Article 5 — Installation d'un logiciel**  
Logiciels disponibles sans demande : MS Office, Chrome, Firefox, VLC, 7-Zip. Pour tout autre logiciel, soumettre une demande via Assistance > Support Technique > Logiciel > Installation.

**Article 6 — Problèmes d'imprimante**  
Vérifications préliminaires (alimentation, papier, message d'erreur). Solutions pour les cas courants : hors ligne, bourrage papier, impression floue, file d'impression bloquée.

**Article 7 — Accès à distance**  
Portail web `portail.unh.edu` ou client VPN (`vpn.unh.edu`, type SSL/TLS) avec les identifiants universitaires. Disponible pour le personnel et les enseignants.

**Article 8 — Ecran noir ou figé**  
Procédure selon le symptôme : vérification des câbles pour écran noir, Ctrl+Alt+Suppr pour un système figé, mode sans échec après un écran bleu. Noter le code d'erreur Windows pour le ticket.

**Article 9 — Suivre son ticket**  
Navigation : Assistance > Tickets > clic sur le ticket. Les cinq états possibles sont expliqués. Des notifications email sont envoyées automatiquement.

**Article 10 — Raccourcis clavier**  
Principaux raccourcis Windows (Ctrl+C/V/Z/S, Alt+Tab, Win+L) et raccourcis GLPI (Alt+B, Alt+T, Alt+H).

### 3.3 Importer un article dans la base de connaissances

1. Se connecter en tant qu'administrateur
2. Aller dans **Outils > Base de connaissances**
3. Cliquer sur **+ Ajouter**
4. Copier-coller le contenu depuis `docs/articles_faq_knowbase.md`
5. Cocher **Publier en FAQ** pour rendre l'article visible publiquement
6. Assigner la catégorie appropriée et enregistrer

---

*Documentation UNH GLPI — Service Informatique — Février 2026*
