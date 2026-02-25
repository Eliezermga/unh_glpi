-- =====================================================
-- Script d'insertion des articles FAQ dans GLPI UNH
-- Issue #50 - Base de connaissances utilisateur
-- =====================================================
-- 
-- Instructions:
-- 1. Ouvrir phpMyAdmin (http://localhost/phpmyadmin)
-- 2. Sélectionner la base de données GLPI (ex: glpi ou glpi_unh)
-- 3. Aller dans l'onglet SQL
-- 4. Coller et exécuter ce script
-- =====================================================

-- Récupérer l'ID utilisateur glpi (généralement 2)
SET @user_id = 2;

-- Date actuelle
SET @current_date = NOW();

-- Table temporaire pour tracer précisément les IDs insérés
DROP TEMPORARY TABLE IF EXISTS `tmp_inserted_faq_ids`;
CREATE TEMPORARY TABLE `tmp_inserted_faq_ids` (
    `knowbaseitems_id` INT UNSIGNED NOT NULL PRIMARY KEY
);

-- =====================================================
-- Article 1: Comment créer un ticket de support ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment créer un ticket de support ?',
    '<h3>Guide pour créer un ticket dans GLPI UNH</h3>
    <ol>
        <li><strong>Connectez-vous</strong> à GLPI avec vos identifiants universitaires</li>
        <li>Cliquez sur <strong>Assistance</strong> dans le menu principal</li>
        <li>Sélectionnez <strong>Support Technique</strong> ou <strong>Créer un ticket</strong></li>
        <li>Remplissez le formulaire :
            <ul>
                <li><strong>Titre</strong> : décrivez brièvement votre problème</li>
                <li><strong>Catégorie</strong> : sélectionnez le type (Matériel, Logiciel, Réseau)</li>
                <li><strong>Description</strong> : expliquez en détail</li>
            </ul>
        </li>
        <li>Cliquez sur <strong>Envoyer</strong></li>
    </ol>
    <p>✅ Vous recevrez un email de confirmation avec le numéro de ticket.</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 2: Comment réinitialiser mon mot de passe ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment réinitialiser mon mot de passe ?',
    '<h3>Réinitialiser votre mot de passe GLPI</h3>
    <h4>Option 1 : Via la page de connexion</h4>
    <ol>
        <li>Accédez à la page de connexion GLPI</li>
        <li>Cliquez sur <strong>Mot de passe oublié ?</strong></li>
        <li>Entrez votre adresse email universitaire</li>
        <li>Consultez votre boîte mail et suivez le lien</li>
    </ol>
    <h4>Option 2 : Contactez le support</h4>
    <p>Si vous n''avez pas accès à votre email, créez un ticket ou contactez le service informatique.</p>
    <p>💡 <strong>Conseil</strong> : Choisissez un mot de passe d''au moins 8 caractères avec majuscules, minuscules et chiffres.</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 3: Comment se connecter au WiFi du campus ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment se connecter au WiFi du campus ?',
    '<h3>Connexion au WiFi UNH</h3>
    <p><strong>Réseaux disponibles</strong> : <code>UNH-Campus</code> (personnel) ou <code>UNH-Etudiant</code> (étudiants)</p>
    <h4>Étapes de connexion</h4>
    <ol>
        <li>Activez le WiFi sur votre appareil</li>
        <li>Sélectionnez le réseau approprié</li>
        <li>Entrez vos identifiants :
            <ul>
                <li><strong>Identifiant</strong> : votre matricule universitaire</li>
                <li><strong>Mot de passe</strong> : votre mot de passe universitaire</li>
            </ul>
        </li>
    </ol>
    <h4>Problèmes courants</h4>
    <ul>
        <li>❌ "Impossible de se connecter" → Vérifiez la zone de couverture</li>
        <li>❌ "Mot de passe incorrect" → Attention à la casse</li>
        <li>❌ Connexion lente → Essayez un autre point d''accès</li>
    </ul>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 4: Mon ordinateur ne démarre plus
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Mon ordinateur ne démarre plus, que faire ?',
    '<h3>Ordinateur en panne - Premiers diagnostics</h3>
    <h4>Vérifications de base</h4>
    <ul>
        <li>✅ Le câble d''alimentation est-il branché ?</li>
        <li>✅ L''écran est-il allumé (voyant lumineux) ?</li>
        <li>✅ Avez-vous maintenu le bouton power 10 secondes ?</li>
    </ul>
    <h4>Actions selon les symptômes</h4>
    <table border="1" cellpadding="5">
        <tr><th>Symptôme</th><th>Action</th></tr>
        <tr><td>Écran noir total</td><td>Vérifiez l''alimentation</td></tr>
        <tr><td>Ventilateur tourne, écran noir</td><td>Problème carte graphique possible</td></tr>
        <tr><td>Bips au démarrage</td><td>Notez le nombre de bips</td></tr>
        <tr><td>Écran bleu</td><td>Contactez le support</td></tr>
    </table>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 5: Comment installer un logiciel ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment installer un logiciel ?',
    '<h3>Installation de logiciels sur les postes UNH</h3>
    <h4>Logiciels disponibles sans demande</h4>
    <ul>
        <li>Microsoft Office (Word, Excel, PowerPoint)</li>
        <li>Navigateurs web (Chrome, Firefox)</li>
        <li>VLC Media Player, 7-Zip</li>
    </ul>
    <h4>Pour installer un autre logiciel</h4>
    <ol>
        <li>Allez dans <strong>Assistance > Support Technique</strong></li>
        <li>Catégorie : <strong>Logiciel > Installation</strong></li>
        <li>Précisez le nom, la version et la raison</li>
    </ol>
    <p>⚠️ <strong>Note</strong> : L''installation de logiciels non autorisés est interdite.</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 6: L'imprimante ne fonctionne pas
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'L''imprimante ne fonctionne pas',
    '<h3>Problèmes d''impression - Solutions rapides</h3>
    <h4>Vérifications préliminaires</h4>
    <ol>
        <li>L''imprimante est-elle allumée (voyant vert) ?</li>
        <li>Y a-t-il du papier dans le bac ?</li>
        <li>Message d''erreur sur l''écran ?</li>
    </ol>
    <h4>Solutions par problème</h4>
    <table border="1" cellpadding="5">
        <tr><th>Problème</th><th>Solution</th></tr>
        <tr><td>Imprimante hors ligne</td><td>Redémarrez, vérifiez le câble</td></tr>
        <tr><td>Bourrage papier</td><td>Ouvrez le capot, retirez le papier</td></tr>
        <tr><td>Impression floue</td><td>Cartouche à remplacer</td></tr>
        <tr><td>File bloquée</td><td>Annulez les travaux</td></tr>
    </table>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 7: Comment accéder à mes fichiers à distance ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment accéder à mes fichiers à distance ?',
    '<h3>Accès distant aux ressources UNH</h3>
    <h4>Option 1 : Portail web</h4>
    <ol>
        <li>Accédez à <strong>https://portail.unh.edu</strong></li>
        <li>Connectez-vous avec vos identifiants</li>
        <li>Naviguez vers vos fichiers</li>
    </ol>
    <h4>Option 2 : VPN (accès complet)</h4>
    <ol>
        <li>Téléchargez le client VPN depuis le portail</li>
        <li>Installez-le sur votre ordinateur</li>
        <li>Lancez le VPN et connectez-vous</li>
    </ol>
    <p><strong>Configuration VPN</strong> : Serveur <code>vpn.unh.edu</code>, Type SSL/TLS</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 8: Mon écran reste noir ou figé
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Mon écran reste noir ou figé',
    '<h3>Écran noir ou figé - Que faire ?</h3>
    <h4>Écran complètement noir</h4>
    <ol>
        <li>Vérifiez que l''écran est allumé</li>
        <li>Vérifiez le câble vidéo (HDMI, VGA)</li>
        <li>Essayez un autre port si disponible</li>
    </ol>
    <h4>Écran figé</h4>
    <ol>
        <li>Attendez 2-3 minutes</li>
        <li>Essayez <strong>Ctrl + Alt + Suppr</strong></li>
        <li>Maintenez le bouton power 10 secondes</li>
    </ol>
    <p>💡 Après un écran bleu, notez le code d''erreur et créez un ticket.</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 9: Comment suivre l'état de mon ticket ?
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Comment suivre l''état de mon ticket ?',
    '<h3>Suivre l''avancement de votre ticket</h3>
    <h4>Via GLPI</h4>
    <ol>
        <li>Connectez-vous à GLPI</li>
        <li>Allez dans <strong>Assistance > Tickets</strong></li>
        <li>Cliquez sur votre ticket</li>
    </ol>
    <h4>États possibles</h4>
    <table border="1" cellpadding="5">
        <tr><th>État</th><th>Signification</th></tr>
        <tr><td>🆕 Nouveau</td><td>Non encore traité</td></tr>
        <tr><td>📋 En cours</td><td>Technicien assigné</td></tr>
        <tr><td>⏳ En attente</td><td>Attente d''info de votre part</td></tr>
        <tr><td>✅ Résolu</td><td>En attente de validation</td></tr>
        <tr><td>🔒 Clos</td><td>Terminé et archivé</td></tr>
    </table>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Article 10: Les raccourcis clavier utiles
-- =====================================================
INSERT INTO `glpi_knowbaseitems` 
(`name`, `answer`, `is_faq`, `users_id`, `view`, `date_creation`, `date_mod`) 
VALUES (
    'Les raccourcis clavier utiles',
    '<h3>Raccourcis clavier pour gagner du temps</h3>
    <h4>Windows - Essentiels</h4>
    <table border="1" cellpadding="5">
        <tr><th>Raccourci</th><th>Action</th></tr>
        <tr><td>Ctrl + C</td><td>Copier</td></tr>
        <tr><td>Ctrl + V</td><td>Coller</td></tr>
        <tr><td>Ctrl + Z</td><td>Annuler</td></tr>
        <tr><td>Ctrl + S</td><td>Enregistrer</td></tr>
        <tr><td>Alt + Tab</td><td>Changer de fenêtre</td></tr>
        <tr><td>Win + L</td><td>Verrouiller la session</td></tr>
    </table>
    <h4>Dans GLPI</h4>
    <table border="1" cellpadding="5">
        <tr><td>Alt + B</td><td>Base de connaissances</td></tr>
        <tr><td>Alt + T</td><td>Créer un ticket</td></tr>
    </table>
    <p>💡 <strong>Conseil</strong> : Utilisez <strong>Win + L</strong> pour verrouiller votre poste !</p>',
    1, @user_id, 0, @current_date, @current_date
);

-- =====================================================
SET @last_faq_id = LAST_INSERT_ID();
INSERT INTO `tmp_inserted_faq_ids` (`knowbaseitems_id`) VALUES (@last_faq_id);

-- Rendre les articles visibles à tous (entité racine)
-- =====================================================
-- Insérer la visibilité pour tous les articles créés
INSERT INTO `glpi_entities_knowbaseitems` (`knowbaseitems_id`, `entities_id`, `is_recursive`)
SELECT `knowbaseitems_id`, 0, 1 FROM `tmp_inserted_faq_ids`;

DROP TEMPORARY TABLE IF EXISTS `tmp_inserted_faq_ids`;

-- =====================================================
-- Vérification
-- =====================================================
SELECT id, name, is_faq, date_creation FROM glpi_knowbaseitems ORDER BY id DESC LIMIT 10;
