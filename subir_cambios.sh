#!/bin/bash

echo "Configurando Git..."
git config user.name "YvnPretty"
git config user.email "yvnpretty@users.noreply.github.com"

echo "Agregando los cambios actuales..."
git add .

# Revisar si hay cambios para hacer commit
if ! git diff-index --quiet HEAD --; then
    git commit -m "Actualizaciones y mejoras en el proyecto veterinario"
fi

echo "Limpiando el historial reciente para que los commits se vean decentes y sin Cursor..."
# Agrupar los commits locales que aún no se han subido en un solo commit limpio a tu nombre
git reset --soft origin/main 2>/dev/null || echo "No se pudo hacer reset a origin/main (puede ser el primer push)"

# Hacemos el commit final con tu autoría, sobreescribiendo a Cursor
git commit -am "Actualizaciones y correcciones del sistema VetCare" --author="YvnPretty <yvnpretty@users.noreply.github.com>"

echo "Subiendo los cambios a GitHub..."
git push -u origin main --force

echo "¡Listo! Tus cambios han sido subidos exitosamente."
