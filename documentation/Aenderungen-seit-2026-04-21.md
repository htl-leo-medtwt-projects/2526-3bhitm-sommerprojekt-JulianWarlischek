
# Projektbericht ab 21.04.2026

## Projektinformationen
- Zeitraum: 21.04.2026 — 05.05.2026
- Entwickler: Julian Warlischek

## Wichtige Änderungen
- Wiederherstellung des Badge-Sliders in `project/pages/profile.php` (Markup + Close-Icon).
- Badge-Logik/Autoopen via URL-Parameter in `project/script/profile.js` (`?badges=true`, `?myData=true`).
- Prefetch für Friends/Requests in `project/script/friends.js` (schnelleres Laden durch gestartete Promises).
- Repo-Memory ergänzt: Hinweis zur Badge-Implementierung.

## Ziele
- Änderungen an den Events werden in der Datenbank gespeichert.
- Events können bearbeitet werden.
- Erster Dateiupload bei User (Profilbild).

## Kurzfazit
Badges wiederhergestellt und Ladeverhalten der Freundesdaten verbessert. Rückwärtskompatibel und getestet auf Syntaxfehler.
