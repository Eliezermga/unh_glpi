-- ============================================================================
-- Données de test - Plugin UNH Assets
-- Université Nouveaux Horizons
-- Version: 1.1.0
-- Date: 13 janvier 2026
-- ============================================================================

-- Cette table contient les configurations du plugin
-- INSERT INTO glpi_configs (context, name, value) VALUES ('unh_assets', 'logo_path', '{"logo_path":"plugins/unh_assets/pics/logos/logo_default.png"}');

-- ============================================================================
-- Bâtiments (Simulating Buildings)
-- ============================================================================

-- Bâtiment Principal - Rector
INSERT INTO glpi_locations (name, address, postcode, town, state, country, comments, entities_id, is_recursive) 
VALUES 
('Bâtiment Rector', '123 Rue de l''Université', '1000', 'Kinshasa', 'Kinshasa', 'Congo RDC', 'Bâtiment principal de l''UNH', 0, 0),
('Bâtiment Scientifique', '125 Rue de l''Université', '1000', 'Kinshasa', 'Kinshasa', 'Congo RDC', 'Laboratoires et locaux scientifiques', 0, 0),
('Bâtiment Administratif', '127 Rue de l''Université', '1000', 'Kinshasa', 'Kinshasa', 'Congo RDC', 'Bureaux administratifs', 0, 0),
('Résidence Étudiante A', '200 Avenue du Campus', '1000', 'Kinshasa', 'Kinshasa', 'Congo RDC', 'Dortoirs étudiants', 0, 0),
('Bibliothèque Centrale', '130 Rue de l''Université', '1000', 'Kinshasa', 'Kinshasa', 'Congo RDC', 'Centre de documentation', 0, 0);

-- ============================================================================
-- Ordinateurs de Bureau
-- ============================================================================

INSERT INTO glpi_computers (name, serial, locations_id, states_id, is_deleted, date_mod, date_creation, users_id, manufacturers_id, computermodels_id, comment) 
VALUES
('PC-RECT-001', 'SN20240501001', 1, 1, 0, NOW(), NOW(), 1, 1, 1, 'Ordinateur de direction'),
('PC-RECT-002', 'SN20240501002', 1, 1, 0, NOW(), NOW(), 2, 1, 1, 'Bureau vice-recteur'),
('PC-SCI-001', 'SN20240502001', 2, 1, 0, NOW(), NOW(), 3, 2, 2, 'Labo informatique'),
('PC-SCI-002', 'SN20240502002', 2, 3, 0, NOW(), NOW(), 4, 2, 2, 'Labo électronique - En maintenance'),
('PC-ADM-001', 'SN20240503001', 3, 1, 0, NOW(), NOW(), 5, 1, 1, 'Finances'),
('PC-ADM-002', 'SN20240503002', 3, 1, 0, NOW(), NOW(), 6, 1, 1, 'Ressources humaines'),
('PC-ADM-003', 'SN20240503003', 3, 1, 0, NOW(), NOW(), 7, 1, 1, 'Scolarité'),
('PC-DORM-001', 'SN20240504001', 4, 2, 0, NOW(), NOW(), 8, 3, 3, 'Salle informatique résidence'),
('PC-BIB-001', 'SN20240505001', 5, 1, 0, NOW(), NOW(), 9, 1, 1, 'Catalogue en ligne'),
('PC-BIB-002', 'SN20240505002', 5, 1, 0, NOW(), NOW(), 10, 1, 1, 'Accueil bibliothèque');

-- ============================================================================
-- Imprimantes et Périphériques
-- ============================================================================

INSERT INTO glpi_printers (name, serial, locations_id, states_id, printermodels_id, comment, is_deleted, date_mod, date_creation) 
VALUES
('IMP-RECT-001', 'SN-IMP-001', 1, 1, 1, 'Imprimante direction', 0, NOW(), NOW()),
('IMP-RECT-002', 'SN-IMP-002', 1, 1, 2, 'Photocopieur multifonction', 0, NOW(), NOW()),
('IMP-ADM-001', 'SN-IMP-003', 3, 1, 1, 'Imprimante département administratif', 0, NOW(), NOW()),
('IMP-SCI-001', 'SN-IMP-004', 2, 3, 3, 'Imprimante 3D - En réparation', 0, NOW(), NOW()),
('IMP-BIB-001', 'SN-IMP-005', 5, 1, 2, 'Imprimante réseau bibliothèque', 0, NOW(), NOW());

-- ============================================================================
-- Routeurs et Équipements Réseau
-- ============================================================================

INSERT INTO glpi_networkequipments (name, serial, locations_id, states_id, comment, is_deleted, date_mod, date_creation) 
VALUES
('ROUTER-PRINCIPAL', 'SN-ROUTER-001', 1, 1, 'Routeur principal - salle serveur', 0, NOW(), NOW()),
('SWITCH-RECT', 'SN-SWITCH-001', 1, 1, 'Commutateur réseau bâtiment Rector', 0, NOW(), NOW()),
('SWITCH-SCI', 'SN-SWITCH-002', 2, 1, 'Commutateur réseau bâtiment Scientifique', 0, NOW(), NOW()),
('SWITCH-ADM', 'SN-SWITCH-003', 3, 1, 'Commutateur réseau bâtiment Administratif', 0, NOW(), NOW()),
('AP-WIFI-001', 'SN-AP-001', 1, 1, 'Point d''accès WiFi - Hall principal', 0, NOW(), NOW()),
('AP-WIFI-002', 'SN-AP-002', 2, 1, 'Point d''accès WiFi - Labo', 0, NOW(), NOW()),
('AP-WIFI-003', 'SN-AP-003', 5, 1, 'Point d''accès WiFi - Bibliothèque', 0, NOW(), NOW());

-- ============================================================================
-- Serveurs
-- ============================================================================

INSERT INTO glpi_servers (name, serial, locations_id, states_id, comment, is_deleted, date_mod, date_creation) 
VALUES
('SRV-PRINCIPAL', 'SN-SRV-001', 1, 1, 'Serveur principal - Active Directory', 0, NOW(), NOW()),
('SRV-BD', 'SN-SRV-002', 1, 1, 'Serveur base de données - MySQL', 0, NOW(), NOW()),
('SRV-WEB', 'SN-SRV-003', 1, 2, 'Serveur web - En démarrage', 0, NOW(), NOW()),
('SRV-BACKUP', 'SN-SRV-004', 1, 1, 'Serveur de sauvegarde', 0, NOW(), NOW()),
('SRV-MAIL', 'SN-SRV-005', 1, 1, 'Serveur de messagerie', 0, NOW(), NOW());

-- ============================================================================
-- Données fictives d'alertes
-- ============================================================================

-- Note: Vous devez adapter ces inserts selon votre table d'alertes réelle
-- Ceci est un exemple basé sur une structure typique GLPI

-- Alertes critiques (priorité haute)
-- INSERT INTO glpi_plugin_unh_assets_alerts (equipement_id, type_alerte, severity, description, date_creation, status)
-- VALUES 
-- (4, 'maintenance', 'critical', 'Équipement PC-SCI-002 en maintenance depuis 15 jours', NOW(), 'unresolved'),
-- (14, 'maintenance', 'critical', 'Imprimante 3D en réparation depuis 1 mois', NOW(), 'unresolved'),
-- (16, 'warning', 'high', 'Serveur web en démarrage - À vérifier', NOW(), 'unresolved');

-- ============================================================================
-- INSTRUCTIONS D'UTILISATION
-- ============================================================================

/*
1. IMPORTER CES DONNÉES :
   - Via phpMyAdmin : Coller ce contenu dans l'onglet "SQL"
   - Via ligne de commande :
     mysql -u [user] -p [database] < test_data.sql
   
2. ADAPTER LES VALEURS :
   - entities_id : Remplacer par votre entité GLPI
   - locations_id : Vérifier les IDs des emplacements
   - users_id : Remplacer par les IDs des utilisateurs réels
   - manufacturers_id : Adapter aux fabricants existants
   - computermodels_id : Adapter aux modèles existants

3. POUR LES TABLES SPÉCIFIQUES AU PLUGIN :
   - Créer d'abord les tables via la migration GLPI
   - Puis adapter les INSERT pour correspondre à votre schéma

4. VIDER CES DONNÉES (si besoin de nettoyer) :
   - DELETE FROM glpi_computers WHERE serial LIKE 'SN2024%';
   - DELETE FROM glpi_locations WHERE name LIKE 'Bâtiment%';
   - DELETE FROM glpi_printers WHERE serial LIKE 'SN-IMP%';

5. VÉRIFIER APRÈS IMPORT :
   - Allez au dashboard du plugin
   - Vérifiez que les équipements s'affichent
   - Testez les filtres par bâtiment, état, etc.
*/

-- ============================================================================
-- FIN DES DONNÉES DE TEST
-- ============================================================================
