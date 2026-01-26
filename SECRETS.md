# Configuration des Secrets GitHub Actions

## Secrets requis dans le repository GitHub

### Déploiement SSH
- `DEPLOY_HOST` : Adresse IP ou nom d'hôte du serveur (ex: 192.168.1.100)
- `DEPLOY_USER` : Nom d'utilisateur SSH (ex: deploy)
- `DEPLOY_PASSWORD` : Mot de passe SSH
- `DEPLOY_PORT` : Port SSH (optionnel, défaut: 22)

### Base de données
- `DB_HOST` : Hôte de la base de données (ex: db.example.com)
- `DB_NAME` : Nom de la base de données (ex: glpi_prod)
- `DB_USER` : Utilisateur de la base de données
- `DB_PASS` : Mot de passe de la base de données

## Configuration dans GitHub

1. Aller dans Settings > Secrets and variables > Actions
2. Cliquer sur "New repository secret"
3. Ajouter chaque secret avec sa valeur

## Exemple de configuration serveur

```bash
# Création de l'utilisateur de déploiement
sudo useradd -m -s /bin/bash deploy
sudo usermod -aG docker deploy

# Configuration SSH (optionnel - clé recommandée)
sudo mkdir -p /home/deploy/.ssh
sudo chown deploy:deploy /home/deploy/.ssh
sudo chmod 700 /home/deploy/.ssh

# Installation Docker si nécessaire
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker deploy
```

## Sécurité

- Utiliser des mots de passe forts
- Considérer l'authentification par clé SSH
- Restreindre l'accès SSH par IP si possible
- Utiliser un utilisateur dédié avec permissions minimales

