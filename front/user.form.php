<?php

use Glpi\Event;

include('../inc/includes.php');

if (empty($_GET["id"])) {
    $_GET["id"] = "";
}

$user      = new User();
$groupuser = new Group_User();

if (isset($_POST["add"])) {
    $user->check(-1, CREATE, $_POST);
    $user->add($_POST);
    Html::redirect("user.php");

} else if (isset($_POST["update"])) {
    $user->check($_POST['id'], UPDATE);
    $user->update($_POST);
    Html::redirect("user.php");

} else if (isset($_POST["delete"])) {
    $user->check($_POST['id'], DELETE);
    $user->delete($_POST);
    Html::redirect("user.php");

} else {

    $menus = ["admin", "user"];

    Html::header(User::getTypeName(Session::getPluralNumber()), '', $menus[0], $menus[1]);

    User::displayFullPageForItem($_GET["id"], $menus, [
        'formoptions' => "data-track-changes=true"
    ]);

    echo "
    <div style='margin:15px'>
        <a class='btn btn-secondary' href='user.php'>⬅ Retour à la liste</a>
    </div>
    ";

    Html::footer();
}
?>

<script>
document.addEventListener("DOMContentLoaded", function(){

   let table = document.querySelector("table.tab_cadre_fixe");

   if(table){

      let row = document.createElement("tr");

      row.innerHTML = 
         <td>Type d'utilisateur</td>
         <td>
            <select name="user_type" class="form-control">
               <option value="">-- Choisir --</option>
               <option value="Étudiant">Étudiant</option>
               <option value="Enseignant">Enseignant</option>
               <option value="Administratif">Administratif</option>
               <option value="IT">IT</option>
            </select>
         </td>
      ;

      table.appendChild(row);
   }

});
</script>
