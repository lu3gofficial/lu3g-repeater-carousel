#!/bin/sh
# Crea dist/lu3g-repeater-carousel.zip (cartella lu3g-repeater-carousel/ all'interno), il pacchetto che WordPress installa e aggiorna.
# Esclude i file che servono solo allo sviluppo (git, script, automazioni, note per Claude).
set -e
cd "$(dirname "$0")/.."
rm -rf dist && mkdir -p dist/lu3g-repeater-carousel
cp -R lu3g-repeater-carousel.php readme.txt CHANGELOG.md DOCUMENTAZIONE.md includes assets dist/lu3g-repeater-carousel/
(cd dist && zip -rq lu3g-repeater-carousel.zip lu3g-repeater-carousel -x '*.DS_Store')
rm -rf dist/lu3g-repeater-carousel
echo "dist/lu3g-repeater-carousel.zip"
