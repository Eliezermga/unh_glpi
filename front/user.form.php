<?php
/**
 * UNH GLPI - User Form
 * Correction : suppression de l'injection JS fragile,
 * ajout de Session::checkCSRF() et Event::log()
 */

use Glpi\Event;

include('../inc/includes.php');

if (empty($_GET["id"])) {
    $_GET["id"] = "";
}

$user      = new User();
$groupuser = new Group_User();

if (isset($_POST["add"])) {
    // 🔒 CSRF
    Session::checkCSRF($_POST);
    $user->check(-1, CREATE, $_POST);
    $newid = $user->add($_POST);

    // 📋 AUDIT LOG
    if ($newid) {
        Event::log(
            $newid,
            'users',
            4,
            'UNH User Management',
            sprintf(__('%s added user #%d'), $_SESSION['glpiname'], $newid)
        );
    }
    Html::redirect("user.php");

} elseif (isset($_POST["update"])) {
    // 🔒 CSRF
    Session::checkCSRF($_POST);
    $user->check($_POST['id'], UPDATE);
    $user->update($_POST);

    // 📋 AUDIT LOG
    Event::log(
        $_POST['id'],
        'users',
        4,
        'UNH User Management',
        sprintf(__('%s updated user #%d'), $_SESSION['glpiname'], $_POST['id'])
    );
    Html::redirect("user.php");

} elseif (isset($_POST["delete"])) {
    // 🔒 CSRF
    Session::checkCSRF($_POST);
    $user->check($_POST['id'], DELETE);
    $user->delete($_POST);

    // 📋 AUDIT LOG
    Event::log(
        $_POST['id'],
        'users',
        4,
        'UNH User Management',
        sprintf(__('%s deleted user #%d'), $_SESSION['glpiname'], $_POST['id'])
    );
    Html::redirect("user.php");

} else {
    $menus = ["admin", "user"];

    Html::header(
        User::getTypeName(Session::getPluralNumber()),
        '',
        $menus[0],
        $menus[1]
    );

    User::displayFullPageForItem($_GET["id"], $menus, [
        'formoptions' => "data-track-changes=true"
    ]);

    echo "<div style='margin:15px'>
        <a class='btn btn-secondary' href='user.php'>&#8592; " . __('Back to list') . "</a>
    </div>";

    Html::footer();
}
// NOTE : Le champ user_type est géré directement dans src/User.php
// via Dropdown::showFromArray() avec __() — NE PAS utiliser d'injection JS.