<?php
/**
 * GLPI UNH - Réponses Rapides
 * Page accessible depuis le menu GLPI
 */

include ('../inc/includes.php');

Session::checkRight("ticket", READ);

Html::header(__('Réponses Rapides UNH'), $_SERVER['PHP_SELF'], "helpdesk", "ticket");

require_once(GLPI_ROOT . '/inc/unh_reponses_rapides.php');

echo '<div class="container-fluid">';
echo '<div class="row">';
echo '<div class="col-12">';

echo '<div class="card">';
echo '<div class="card-header">';
echo '<h3>📋 Réponses Rapides - Support UNH</h3>';
echo '<p class="text-muted">Cliquez sur "Copier" pour utiliser une réponse dans vos tickets</p>';
echo '</div>';
echo '<div class="card-body">';

$responses = [
    [
        'title' => '🔑 Réinitialisation mot de passe',
        'content' => UNH_ReponsesRapides::passwordReset(),
        'category' => 'Compte'
    ],
    [
        'title' => '📶 Connexion Wi-Fi campus',
        'content' => UNH_ReponsesRapides::wifiConnection(),
        'category' => 'Réseau'
    ],
    [
        'title' => '📚 Accès Moodle',
        'content' => UNH_ReponsesRapides::moodleAccess(),
        'category' => 'Logiciel'
    ],
    [
        'title' => '🖨️ Problème matériel',
        'content' => UNH_ReponsesRapides::hardwareIssue(),
        'category' => 'Matériel'
    ],
    [
        'title' => '👤 Création de compte',
        'content' => UNH_ReponsesRapides::accountCreation(),
        'category' => 'Compte'
    ],
    [
        'title' => '🔒 Configuration VPN',
        'content' => UNH_ReponsesRapides::vpnSetup(),
        'category' => 'Réseau'
    ],
    [
        'title' => '💿 Installation logiciel',
        'content' => UNH_ReponsesRapides::softwareInstallation(),
        'category' => 'Logiciel'
    ],
    [
        'title' => '✅ Ticket résolu',
        'content' => UNH_ReponsesRapides::ticketResolved(),
        'category' => 'Général'
    ]
];

foreach ($responses as $index => $response) {
    echo '<div class="card mb-3" style="border-left: 4px solid #007bff;">';
    echo '<div class="card-header d-flex justify-content-between align-items-center">';
    echo '<h5 class="mb-0">' . $response['title'] . '</h5>';
    echo '<span class="badge badge-info">' . $response['category'] . '</span>';
    echo '</div>';
    echo '<div class="card-body">';
    echo '<pre id="response-' . $index . '" style="white-space: pre-wrap; background: #f8f9fa; padding: 15px; border-radius: 4px;">' . htmlspecialchars($response['content']) . '</pre>';
    echo '<button class="btn btn-primary btn-sm" onclick="copyToClipboard(' . $index . ', this)">';
    echo '<i class="fas fa-copy"></i> Copier';
    echo '</button>';
    echo '</div>';
    echo '</div>';
}

echo '</div>';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</div>';

?>

<script>
function copyToClipboard(index, button) {
    const text = document.getElementById('response-' + index).textContent;
    navigator.clipboard.writeText(text).then(() => {
        const originalHTML = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i> Copié !';
        button.classList.remove('btn-primary');
        button.classList.add('btn-success');
        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('btn-success');
            button.classList.add('btn-primary');
        }, 2000);
    });
}
</script>

<?php
Html::footer();
