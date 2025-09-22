
# HB Starter Theme (HubSpot CMS)

Ein leichter Startpunkt für dein Händlerbund-Interview:
- **Templates**: base, landing, page (Drag & Drop fähig)
- **Partials**: Header/Footer
- **Module**: HB Hero, HB Feature Card
- **Assets**: main.css, main.js
- **Theme Settings**: Brand-Farbe, Containerbreite

## Nutzung

### Option A: Design Manager (UI)
1. In HubSpot: *Marketing > Dateien & Vorlagen > Design-Tools* öffnen.
2. **Ordner hochladen** und `hb-starter-theme` importieren (ZIP entpacken ist nicht nötig, du kannst den gesamten Ordner hochladen, oder per CLI deployen).
3. Unter **Einstellungen > Website > Themes** das Theme auswählen und eine neue Seite auf Basis der Templates erstellen.

### Option B: HubSpot CLI (empfohlen für Devs)
1. Node.js installieren, dann CLI installieren:  
   `npm install -g @hubspot/cli`
2. Auth einrichten:  
   `hs init`
3. Upload:  
   `hs upload themes/hb-starter-theme themes/hb-starter-theme`
4. In HubSpot eine neue Seite erstellen und als Theme **HB Starter Theme** wählen.

## Hinweise
- Die Templates sind *Drag-and-Drop*-fähig (`{% dnd_area %}`), so kann das Marketing Module frei platzieren.
- Module-Felder sind sprechend benannt (z. B. `headline`, `cta_text`), damit Nicht-Techies Inhalte ohne Code pflegen können.
- Du kannst die Brand-Farbe und Containerbreite unter Theme-Settings ändern.

Viel Erfolg im Interview!


---

## Extras (für dein Interview)
- **HubDB Listing**: `templates/hubdb-team.html` – erstelle in HubDB eine Tabelle **team** (Spalten: name, role, photo, email) und zeige das Listing an.
- **E-Mail-Template**: `templates/email.html` – responsives Marketing-Template.
- **API-Demos**: `integrations/api-demo` – `create-contact.js`, `get-contacts.js` (Private App Token nötig).
- **Webhook-Demo**: `integrations/webhook-demo` – Express-Server zum Empfangen von HubSpot-Webhooks.

### HubDB Schnellanleitung
1. Einstellungen → **Website** → **HubDB** → neue Tabelle **team**.
2. Spalten anlegen: `name` (Text), `role` (Text), `photo` (Bild), `email` (Text).
3. 2–3 Zeilen anlegen, veröffentlichen.
4. Seite mit Template `hubdb-team.html` erstellen – Grid sollte die Einträge anzeigen.

### E-Mail-Template nutzen
1. Marketing → **E-Mail** → Neue E-Mail → Tab **Benutzerdefiniert** → Template `email.html` wählen.
2. Betreff/CTA im Editor anpassen.

### API-Demos nutzen
- `.env` mit `HUBSPOT_TOKEN` (Private App Token) erstellen.
- `node create-contact.js` – legt einen Beispielkontakt an.
- `node get-contacts.js` – listet 5 Kontakte.

### Webhook-Demo testen
- `node server.js` starten (Port 3000).
- Tunnel (z. B. ngrok) starten und URL in HubSpot-Webhooks konfigurieren.
