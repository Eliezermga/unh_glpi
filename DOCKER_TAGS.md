# Stratégie de Tags Docker pour GLPI

## Principe
- **Pas de tag `latest` en production** pour éviter les déploiements accidentels
- Tags basés sur les branches et commits pour traçabilité complète
- Rotation automatique des anciennes images

## Tags générés automatiquement

### Branche main
- `stable` : Version stable courante (équivalent latest mais explicite)
- `main-<sha>` : Version spécifique avec hash du commit
- `main` : Dernière version de la branche main

### Branche CI/CD_DEP
- `ci-cd-dep-<sha>` : Version spécifique avec hash du commit
- `ci-cd-dep` : Dernière version de la branche de développement

## Exemples de tags
```
ghcr.io/owner/unh_glpi:stable
ghcr.io/owner/unh_glpi:main-a1b2c3d
ghcr.io/owner/unh_glpi:ci-cd-dep-x9y8z7w
```

## Déploiement
- **Production** : Utilise toujours `stable`
- **Staging** : Utilise `ci-cd-dep` ou tags spécifiques
- **Rollback** : Utilise un tag spécifique `main-<sha>`

## Nettoyage
- Images non taguées supprimées automatiquement après déploiement
- Conservation des 10 dernières versions par branche
- Nettoyage hebdomadaire des images obsolètes