#!/bin/bash
# Script de déploiement GLPI - À placer sur le serveur cible

set -e

CONTAINER_NAME="glpi-app"
IMAGE_BASE="ghcr.io/owner/unh_glpi"
NETWORK_NAME="glpi-network"

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

check_prerequisites() {
    log "Vérification des prérequis..."
    command -v docker &>/dev/null || error "Docker non installé"
    docker info &>/dev/null || error "Docker daemon inaccessible"
    log "Prérequis OK"
}

setup_network() {
    if ! docker network ls | grep -q "$NETWORK_NAME"; then
        log "Création du réseau Docker $NETWORK_NAME"
        docker network create "$NETWORK_NAME"
    fi
}

backup_volumes() {
    log "Sauvegarde des volumes..."
    if docker volume ls | grep -q "glpi-data"; then
        docker run --rm \
            -v glpi-data:/source:ro \
            -v "$(pwd)/backups":/backup \
            alpine tar czf "/backup/glpi-data-$(date +%Y%m%d-%H%M%S).tar.gz" -C /source .
    fi
}

deploy() {
    local tag=${1:-stable}
    local image="$IMAGE_BASE:$tag"

    log "Déploiement de $image"
    docker pull "$image"

    if docker ps -q -f name="$CONTAINER_NAME" | grep -q .; then
        log "Arrêt du conteneur existant"
        docker stop "$CONTAINER_NAME" --time=30
        docker rm "$CONTAINER_NAME"
    fi

    log "Démarrage du nouveau conteneur"
    docker run -d \
        --name "$CONTAINER_NAME" \
        --restart unless-stopped \
        --network "$NETWORK_NAME" \
        -p 127.0.0.1:8080:80 \
        -v glpi-data:/var/www/html/files \
        -v glpi-config:/var/www/html/config \
        -e DB_HOST="${DB_HOST}" \
        -e DB_NAME="${DB_NAME}" \
        -e DB_USER="${DB_USER}" \
        -e DB_PASSWORD="${DB_PASSWORD}" \
        --memory="512m" \
        --cpus="1.0" \
        --health-cmd="curl -f http://localhost/status.php || exit 1" \
        --health-interval=30s \
        --health-timeout=10s \
        --health-retries=3 \
        "$image"

    log "Vérification du déploiement"
    sleep 15

    for i in {1..10}; do
        if curl -f http://127.0.0.1:8080/status.php &>/dev/null; then
            log "GLPI déployé avec succès"
            return
        fi
        warn "Tentative $i/10..."
        sleep 10
    done

    error "GLPI ne répond pas"
}

cleanup() {
    log "Nettoyage des images"
    docker image prune -f
}

rollback() {
    [ -z "$1" ] && error "Tag requis"
    warn "Rollback vers $1"
    deploy "$1"
}

case "${1:-deploy}" in
    deploy)
        check_prerequisites
        setup_network
        backup_volumes
        deploy "${2:-stable}"
        cleanup
        ;;
    rollback)
        check_prerequisites
        rollback "$2"
        ;;
    status)
        docker ps -f name="$CONTAINER_NAME"
        docker logs --tail=20 "$CONTAINER_NAME"
        ;;
    *)
        echo "Usage: $0 {deploy|rollback|status} [tag]"
        exit 1
        ;;
esac
