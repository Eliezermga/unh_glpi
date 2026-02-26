# Calendrier académique UNH

## Script de création des congés

Le script `create_university_holidays.php` crée les congés académiques de l'Université Nouveaux Horizons dans GLPI.

### Congés créés

| Nom | Période type |
|-----|--------------|
| Rentrée universitaire | 1er septembre |
| Vacances de Noël | 23 décembre - 5 janvier |
| Session d'examens - Semestre 1 | 15-22 décembre |
| Vacances de Pâques | 1er-15 avril |
| Session d'examens - Semestre 2 | 15 mai - 15 juin |
| Vacances d'été | 1er juillet - 31 août |

### Utilisation

**En ligne de commande :**
```bash
php scripts/create_university_holidays.php [année]
# Exemple pour 2025 :
php scripts/create_university_holidays.php 2025
```

**Via le navigateur :**
Accédez à `https://votre-glpi/scripts/create_university_holidays.php`

### Après l'exécution

1. Allez dans **Configuration > Calendriers**
2. Éditez le calendrier à utiliser (ex. Calendrier par défaut)
3. Dans l'onglet **Congés**, associez les congés créés au calendrier

### Personnalisation

Les dates sont configurables dans le script. Modifiez le tableau `$holidays_data` pour adapter aux dates réelles de l'année académique UNH.
