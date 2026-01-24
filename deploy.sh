#!/bin/bash
# Script de déploiement GLPI - À placer sur le serveur cible

set -e

# Configuration
CONTAINER_NAME="glpi-app"
IMAGE_BASE="ghcr.io/owner/unh_glpi"
NETWORK_NAME="glpi-network"

# Couleurs pour les logs
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

log() {
    echo -e "${GREEN}[$(date +'%Y-%m-%d %H:%M:%S')] $1${NC}"
}

warn() {
    echo -e "${YELLOW}[$(date +'%Y-%m-%d %H:%M:%S')] WARNING: $1${NC}"
}

error() {
    echo -e "${RED}[$(date +'%Y-%m-%d %H:%M:%S')] ERROR: $1${NC}"
    exit 1
}

# Vérification des prérequis
check_prerequisites() {
    log "Vérification des prérequis..."
    
    if ! command -v docker &> /dev/null; then
        error "Docker n'est pas installé"
    fi
    
    if ! docker info &> /dev/null; then
        error "Docker daemon n'est pas accessible"
    fi
    
    log "Prérequis OK"
}

# Création du réseau Docker si nécessaire
setup_network() {
    if ! docker network ls | grep -q "$NETWORK_NAME"; then
        log "Création du réseau Docker $NETWORK_NAME"
        docker network create "$NETWORK_NAME"
    fi
}

# Sauvegarde avant déploiement
backup_volumes() {
    log "Sauvegarde des volumes..."
    
    if docker volume ls | grep -q "glpi-data"; then
        docker run --rm \
            -v glpi-data:/source:ro \
            -v "$(pwd)/backups":/backup \
            alpine tar czf "/backup/glpi-data-$(date +%Y%m%d-%H%M%S).tar.gz" -C /source .
    fi
}

# Déploiement principal
deploy() {
    local tag=${1:-stable}
    local image="$IMAGE_BASE:$tag"
    
    log "Déploiement de $image"
    
    # Pull de la nouvelle image
    log "Téléchargement de l'image..."
    docker pull "$image"
    
    # Arrêt gracieux du conteneur existant
    if docker ps -q -f name="$CONTAINER_NAME" | grep -q .; then
        log "Arrêt du conteneur existant..."
        docker stop "$CONTAINER_NAME" --time=30
        docker rm "$CONTAINER_NAME"
    fi
    
    # Démarrage du nouveau conteneur
    log "Démarrage du nouveau conteneur..."
    docker run -d \
        --name "$CONTAINER_NAME" \
        --restart unless-stopped \
        --network "$NETWORK_NAME" \
        -p 127.0.0.1:8080:8080 \
        -v glpi-data:/var/www/html/files \
        -v glpi-config:/var/www/html/config \
        -e DB_HOST="${DB_HOST}" \
        -e DB_NAME="${DB_NAME}" \
        -e DB_USER="${DB_USER}" \
        -e DB_PASS="${DB_PASS}" \
        --memory="512m" \
        --cpus="1.0" \
        --health-cmd="curl -f http://localhost:8080/status.php || exit 1" \
        --health-interval=30s \
        --health-timeout=10s \
        --health-retries=3 \
        "$image"
    
    # Vérification du déploiement
    log "Vérification du déploiement..."
    sleep 15
    
    if ! docker ps | grep -q "$CONTAINER_NAME"; then
        error "Le conteneur n'est pas démarré"
    fi
    
    # Test de santé
    for i in {1..10}; do
        if curl -f http://127.0.0.1:8080/status.php &>/dev/null; then
            log "Application déployée avec succès"
            return 0
        fi
        warn "Tentative $i/10 - En attente de l'application..."
        sleep 10
    done
    
    error "L'application ne répond pas après le déploiement"
}

# Nettoyage
cleanup() {
    log "Nettoyage des images obsolètes..."
    docker image prune -f
    
    # Suppression des anciennes images GLPI (garde les 3 dernières)
    docker images "$IMAGE_BASE" --format "table {{.Repository}}:{{.Tag}}\t{{.CreatedAt}}" | \
        tail -n +2 | sort -k2 -r | tail -n +4 | awk '{print $1}' | \
        xargs -r docker rmi 2>/dev/null || true
}

# Rollback
rollback() {
    local previous_tag=$1
    
    if [ -z "$previous_tag" ]; then
        error "Tag de rollback requis"
    fi
    
    warn "Rollback vers $previous_tag"
    deploy "$previous_tag"
}

# Menu principal
case "${1:-deploy}" in
    "deploy")
        check_prerequisites
        setup_network
        backup_volumes
        deploy "${2:-stable}"
        cleanup
        ;;
    "rollback")
        check_prerequisites
        rollback "$2"
        ;;
    "status")
        docker ps -f name="$CONTAINER_NAME"
        docker logs --tail=20 "$CONTAINER_NAME"
        ;;
    *)
        echo "Usage: $0 {deploy|rollback|status} [tag]"
        exit 1
        ;;
esac