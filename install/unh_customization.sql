-- ============================================
-- GLPI UNH - Personnalisation des Tickets
-- ============================================

-- 1. CATÉGORIES DE TICKETS
INSERT INTO `glpi_itilcategories` (`name`, `completename`, `comment`, `level`, `knowbaseitemcategories_id`, `is_incident`, `is_request`, `is_problem`, `is_change`) VALUES
-- Matériel
('Matériel', 'Matériel', 'Problèmes liés au matériel informatique', 1, 0, 1, 1, 1, 0),
('Ordinateur portable', 'Matériel > Ordinateur portable', 'Problèmes avec les ordinateurs portables', 2, 0, 1, 1, 1, 0),
('Ordinateur fixe', 'Matériel > Ordinateur fixe', 'Problèmes avec les ordinateurs de bureau', 2, 0, 1, 1, 1, 0),
('Imprimante', 'Matériel > Imprimante', 'Problèmes d\'impression', 2, 0, 1, 1, 1, 0),
('Projecteur', 'Matériel > Projecteur', 'Problèmes avec les projecteurs', 2, 0, 1, 1, 1, 0),

-- Logiciel
('Logiciel', 'Logiciel', 'Problèmes liés aux logiciels', 1, 0, 1, 1, 1, 0),
('Moodle', 'Logiciel > Moodle', 'Plateforme d\'apprentissage Moodle', 2, 0, 1, 1, 1, 0),
('Office', 'Logiciel > Office', 'Suite Microsoft Office', 2, 0, 1, 1, 1, 0),
('Antivirus', 'Logiciel > Antivirus', 'Logiciel antivirus', 2, 0, 1, 1, 1, 0),

-- Réseau
('Réseau', 'Réseau', 'Problèmes de connectivité réseau', 1, 0, 1, 1, 1, 0),
('Wi-Fi campus', 'Réseau > Wi-Fi campus', 'Connexion Wi-Fi sur le campus', 2, 0, 1, 1, 1, 0),
('VPN', 'Réseau > VPN', 'Accès VPN', 2, 0, 1, 1, 1, 0),
('Ethernet', 'Réseau > Ethernet', 'Connexion filaire', 2, 0, 1, 1, 1, 0),

-- Compte
('Compte', 'Compte', 'Gestion des comptes utilisateurs', 1, 0, 1, 1, 0, 0),
('Réinitialisation mot de passe', 'Compte > Réinitialisation mot de passe', 'Réinitialisation de mot de passe', 2, 0, 1, 1, 0, 0),
('Création compte', 'Compte > Création compte', 'Création d\'un nouveau compte', 2, 0, 0, 1, 0, 0),
('Droits d\'accès', 'Compte > Droits d\'accès', 'Modification des droits d\'accès', 2, 0, 0, 1, 0, 0);

-- 2. TEMPLATES DE TICKETS
INSERT INTO `glpi_tickettemplates` (`name`, `comment`, `is_recursive`) VALUES
('Template Étudiant', 'Template par défaut pour les étudiants', 1),
('Template Enseignant', 'Template par défaut pour les enseignants', 1),
('Template Personnel', 'Template par défaut pour le personnel administratif', 1);

-- 3. SLA (Service Level Agreements)
INSERT INTO `glpi_slas` (`name`, `comment`, `type`, `number_time`, `definition_time`) VALUES
('SLA Étudiant - 72h', 'Résolution sous 72 heures pour les étudiants', 1, 72, 'hour'),
('SLA Enseignant - 24h', 'Résolution sous 24 heures pour les enseignants', 1, 24, 'hour'),
('SLA Personnel - 48h', 'Résolution sous 48 heures pour le personnel', 1, 48, 'hour'),
('SLA Urgent - 4h', 'Résolution urgente sous 4 heures', 1, 4, 'hour');

-- 4. GROUPES TECHNIQUES
INSERT INTO `glpi_groups` (`name`, `comment`, `is_assign`) VALUES
('Support Réseau', 'Équipe en charge des problèmes réseau', 1),
('Support Matériel', 'Équipe en charge du matériel', 1),
('Support Logiciel', 'Équipe en charge des logiciels', 1),
('Support Comptes', 'Équipe en charge de la gestion des comptes', 1);
