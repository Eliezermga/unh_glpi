<?php
/**
 * GLPI UNH - Réponses Rapides (Canned Responses)
 * Groupe Assistance
 * 
 * Utilisation : Copier-coller les réponses dans les tickets GLPI
 */

class UNH_ReponsesRapides {
    
    /**
     * Réinitialisation mot de passe
     */
    public static function passwordReset() {
        return "Bonjour,

Votre mot de passe a été réinitialisé avec succès.

Procédure de connexion :
1. Rendez-vous sur le portail : https://unhsun300.com/inscription
2. Utilisez votre identifiant universitaire
3. Votre mot de passe temporaire vous a été envoyé par email
4. Vous serez invité à changer votre mot de passe lors de la première connexion

Pour toute question, n'hésitez pas à nous contacter.

Cordialement,
Support Informatique UNH";
    }
    
    /**
     * Connexion Wi-Fi campus
     */
    public static function wifiConnection() {
        return "Bonjour,

Pour vous connecter au Wi-Fi du campus :

1. Sélectionnez le réseau : UNH-Campus
2. Utilisez vos identifiants universitaires
3. Si problème persiste, vérifiez que votre appareil est autorisé

Zones de couverture Wi-Fi :
- Bibliothèque
- Salles de cours (Bâtiments 1, 2, 3)
- Espaces communs

En cas de difficulté, contactez-nous avec le modèle de votre appareil.

Cordialement,
Support Réseau UNH";
    }
    
    /**
     * Accès Moodle
     */
    public static function moodleAccess() {
        return "Bonjour,

Pour accéder à la plateforme UNH SUN300 :

URL : https://unhsun300.com
Identifiant : Votre numéro étudiant/employé
Mot de passe : Votre mot de passe universitaire

Problèmes courants :
- Cours non visible : Contactez votre enseignant pour l'inscription
- Erreur de connexion : Vérifiez vos identifiants ou réinitialisez votre mot de passe
- Problème de téléchargement : Vérifiez votre connexion internet

Cordialement,
Support Logiciel UNH";
    }
    
    /**
     * Problème matériel
     */
    public static function hardwareIssue() {
        return "Bonjour,

Nous avons bien reçu votre demande concernant le matériel.

Vérifications rapides :
1. Le matériel est-il allumé et correctement branché ?
2. Avez-vous redémarré l'équipement ?
3. Les câbles et connexions sont-ils bien fixés ?

Un technicien interviendra dans les meilleurs délais pour diagnostiquer et résoudre le problème.

Cordialement,
Support Matériel UNH";
    }
    
    /**
     * Création de compte
     */
    public static function accountCreation() {
        return "Bonjour,

Votre compte a été créé avec succès.

Vos identifiants vous ont été envoyés par email.

Services accessibles :
- Portail étudiant/employé
- Moodle
- Email universitaire
- Wi-Fi campus

Vous devez changer votre mot de passe lors de la première connexion.

Cordialement,
Support Comptes UNH";
    }
    
    /**
     * Configuration VPN
     */
    public static function vpnSetup() {
        return "Bonjour,

Pour configurer le VPN UNH :

1. Téléchargez le client VPN : [LIEN_TELECHARGEMENT]
2. Installez le logiciel
3. Configuration :
   - Serveur : vpn.unh.edu.ht
   - Type : SSL VPN
   - Identifiants : Vos identifiants universitaires

Le VPN vous permet d'accéder aux ressources de l'université à distance.

Cordialement,
Support Réseau UNH";
    }
    
    /**
     * Installation logiciel
     */
    public static function softwareInstallation() {
        return "Bonjour,

Votre demande d'installation de logiciel a été enregistrée.

Un technicien vous contactera pour planifier l'installation.
Délai estimé : 2-3 jours ouvrables

Cordialement,
Support Logiciel UNH";
    }
    
    /**
     * Ticket résolu
     */
    public static function ticketResolved() {
        return "Bonjour,

Votre ticket a été résolu.

Si le problème persiste ou si vous avez des questions, n'hésitez pas à :
- Rouvrir ce ticket
- Créer un nouveau ticket
- Nous contacter directement

Merci de votre confiance.

Cordialement,
Support Informatique UNH";
    }
}

// ============================================
// EXEMPLES D'UTILISATION
// ============================================

/*
// Exemple 1 : Réinitialisation mot de passe
echo UNH_ReponsesRapides::passwordReset();

// Exemple 2 : Wi-Fi
echo UNH_ReponsesRapides::wifiConnection();

// Exemple 3 : Création compte
echo UNH_ReponsesRapides::accountCreation();

// Exemple 4 : Problème matériel
echo UNH_ReponsesRapides::hardwareIssue();

// Exemple 5 : Ticket résolu
echo UNH_ReponsesRapides::ticketResolved();
*/
