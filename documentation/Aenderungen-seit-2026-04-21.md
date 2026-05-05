
# Projektbericht ab 21.04.2026

## Projektinformationen
- Zeitraum: 21.04.2026 — 05.05.2026
- Entwickler: Julian Warlischek

## Wichtige Änderungen

## Ziele
- Änderungen an den Events werden in der Datenbank gespeichert.

## Änderungen (detaillierter)

- Badge-Slider (Profil)
	- Datei: `project/pages/profile.php`
		- Wieder eingefügt: Container `#profile-badge-slider` mit Close-Icon, Header und Inhalt-Container `#profile-badges`.
	- Datei: `project/script/profile.js`
		- Funktionen: `openBadges()` / `closeBadges()` steuern `pointerEvents`, `opacity` und `document.body.style.overflow`.
		- `loadBadgesOfUser()` lädt via `fetch('../../api/badge-api.php?userId=...')`, baut HTML für jede Badge (wechselnde Layout-Reihenfolge) und schreibt es in `#profile-badges`.
		- Auto-Open: beim `DOMContentLoaded` werden URL-Parameter geprüft und bei `?badges=true` bzw. `?myData=true` die entsprechenden Slider geöffnet.
	- Datei: `project/style/profile.css`
		- Enthält Styles für `#profile-badge-slider`, Header, `.user-badge`, `.user-badge-img` und Trennlinien; keine Style-Änderung notwendig, Markup nutzt vorhandene Regeln.

- Friends Prefetch / UX
	- Datei: `project/script/friends.js`
		- Prefetch-Promises: `friendsPromise`, `requestsPromise`, `sentRequestsPromise` werden direkt beim Laden des Scripts gestartet (parallel zum Page-Parsing).
		- `loadAllFriends()` wurde so angepasst, dass es die Daten aus `friendsPromise` verwendet (DOM-Aufbau, `loadBadgesFromUser()` für je 2 Badges pro Freund, `loadFriendCount()` optional aufrufen).
		- `loadAllRequests()` nutzt `requestsPromise` und bleibt asynchron, ruft für jeden Request `getRequestId()` auf, bevor die Accept/Decline-Buttons erzeugt werden.
		- Vorteil: Datenanforderungen beginnen früher, sichtbare Ladezeit sinkt; Hinweis: bei vielen gleichzeitigen Prefetches könnte ein AbortController nützlich sein.

- API / Backend
	- `api/badge-api.php` liefert entweder alle Badges oder nur Badges eines Users (`?userId=`) — die Frontend-Fetches nutzen diese API.

- Repo-Memory
	- `/memories/repo/sommerprojekt.md` wurde um einen Hinweis ergänzt, dass `#profile-badge-slider` und `#profile-badges` in `project/pages/profile.php` erwartet werden.

## Test / Quick-Checks

- Öffne Profil mit `?badges=true` → Badge-Slider sollte erscheinen (CSS overlay + Close-Icon funktional).
- Öffne Profil mit `?myData=true` → My-Data-Slider sollte erscheinen.
- Friends-Seite: lade die Seite und prüfe in DevTools → Network: ob `user-api.php?friends=true` / `?requests=true` bereits beim Laden gestartet wurden.
- Console-Log prüfen: `loadBadgesOfUser()` und Prefetch-Catches loggen Fehler, falls API nicht antwortet.

## Ziele (angepasst)
- Änderungen an den Events werden in der Datenbank gespeichert.
- Events können bearbeitet werden.
- Erster Dateiupload bei User (Profilbild).
- Events können bearbeitet werden.
- Erster Dateiupload bei User (Profilbild).

## Kurzfazit
Badges wiederhergestellt und Ladeverhalten der Freundesdaten verbessert. Rückwärtskompatibel und getestet auf Syntaxfehler.
