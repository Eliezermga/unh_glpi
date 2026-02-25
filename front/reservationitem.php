<?php

/**
 * ---------------------------------------------------------------------
 * MODULE : Réservations
 * Auteur : ILUNGA MWAKU Prodiges
 * Description :
 * Permet aux étudiants et enseignants de réserver des salles,
 * du matériel et équipements avec gestion des disponibilités.
 * ---------------------------------------------------------------------
 */

include('../inc/includes.php');

// ===============================
// 1️⃣ Vérification des droits
// ===============================

Session::checkRightsOr('reservation', [READ, ReservationItem::RESERVEANITEM]);

// ===============================
// 2️⃣ Header selon interface
// ===============================

if (Session::getCurrentInterface() == "helpdesk") {
    Html::helpHeader(__('Réservations - Interface simplifiée'), 'reservation');
} else {
    Html::header(
        Reservation::getTypeName(Session::getPluralNumber()),
        $_SERVER['PHP_SELF'],
        "tools",
        "reservationitem"
    );
}

// ===============================
// 3️⃣ Message d'information
// ===============================

echo "<div class='center'>";
echo "<h2>📅 Module de Réservation</h2>";
echo "<p>
Ce module permet aux <strong>étudiants et enseignants</strong> de réserver :
<br>✔ Salles
<br>✔ Matériel
<br>✔ Équipements pédagogiques
<br><br>
Vous pouvez consulter les disponibilités, créer ou annuler une réservation.
</p>";
echo "</div><br>";

// ===============================
// 4️⃣ Affichage des réservations
// ===============================

$reservation = new ReservationItem();
$reservation->display($_GET);

// ===============================
// 5️⃣ Gestion sauvegarde formulaire
// ===============================

if (isset($_POST['submit'])) {
    $_SESSION['glpi_saved']['ReservationItem'] = $_POST;
} else {
    unset($_SESSION['glpi_saved']['ReservationItem']);
}

// ===============================
// 6️⃣ Footer selon interface
// ===============================

if (Session::getCurrentInterface() == "helpdesk") {
    Html::helpFooter();
} else {
    Html::footer();
}