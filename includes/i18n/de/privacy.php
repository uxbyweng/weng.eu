<?php
// Datenschutzerklärung (/datenschutz/). Entwurf, abgeleitet aus der tatsächlichen Technik der Website (Stand Nov. 2026):
// Session-Cookie nur auf der Kontaktseite, Theme im localStorage, Sprache aus der URL, keine CDN-/Tracking-Dienste,
// Hosting bei STRATO, Kontaktformular per E-Mail (ohne Bestätigungsmail; E-Mails werden an ein Gmail-Postfach weitergeleitet), keine eingebundenen Fremdinhalte (kein iframe). TODO Inhaber: anwaltlich prüfen lassen.
//
// Aufbau: Pro Abschnitt privacy.<id>.title und fortlaufend privacy.<id>.1, .2, … Beginnt ein Eintrag mit "- ", ist er ein
// Listenpunkt (aufeinanderfolgende Listenpunkte bilden eine Liste). Platzhalter: {email}, {imprint}, {berlin}, {list}.
return [
  'privacy.meta.title' => 'Datenschutzerklärung – Karsten Weng',
  'privacy.meta.desc'  => 'Datenschutzerklärung von weng.eu: welche Daten verarbeitet werden, zu welchen Zwecken und welche Rechte Sie haben.',
  'privacy.title'      => 'Datenschutzerklärung',
  // Hinweis zur maßgeblichen Fassung: nur in der englischen Datei gefüllt, in der deutschen leer (wird dann nicht angezeigt)
  'privacy.notice'     => '',
  'privacy.date'       => 'Stand:',
  'privacy.date.value' => '13.11.2026',

  'privacy.link.imprint' => 'Impressum',
  'privacy.link.berlin'  => 'Berliner Beauftragte für Datenschutz und Informationsfreiheit',
  'privacy.link.list'    => 'hier',

  'privacy.controller.title' => 'Verantwortlicher',
  'privacy.controller.1' => 'Verantwortlich für die Datenverarbeitung auf dieser Website im Sinne der Datenschutz-Grundverordnung (DSGVO) ist:',
  'privacy.controller.2' => 'E-Mail: {email}',
  'privacy.controller.3' => 'Weitere Angaben finden Sie im {imprint}.',

  'privacy.overview.title' => 'Überblick',
  'privacy.overview.1' => 'Ich verarbeite personenbezogene Daten nur, soweit es für den Betrieb dieser Website technisch erforderlich ist oder Sie mir die Daten selbst mitteilen, zum Beispiel über das Kontaktformular. „Personenbezogene Daten“ sind alle Angaben, mit denen Sie persönlich identifiziert werden können, etwa Ihr Name, Ihre E-Mail-Adresse oder Ihre IP-Adresse.',
  'privacy.overview.2' => 'Auf dieser Website gibt es kein Tracking: keine Analyse- oder Werbetools, keine Social-Media-Plugins und kein Fingerprinting. Schriften, Skripte und Bilder liefere ich von meinem eigenen Server aus.',

  'privacy.hosting.title' => 'Hosting und Server-Log-Dateien',
  'privacy.hosting.1' => 'Diese Website wird bei der STRATO GmbH (Deutschland) gehostet. Mit dem Anbieter besteht ein Vertrag zur Auftragsverarbeitung nach Art. 28 DSGVO.',
  'privacy.hosting.2' => 'Beim Aufruf der Website verarbeitet der Server technisch bedingt automatisch folgende Daten:',
  'privacy.hosting.3' => '- IP-Adresse',
  'privacy.hosting.4' => '- Datum und Uhrzeit des Abrufs',
  'privacy.hosting.5' => '- angeforderte URL',
  'privacy.hosting.6' => '- Referrer-URL (zuvor besuchte Seite), sofern Ihr Browser sie übermittelt',
  'privacy.hosting.7' => '- Angaben zu Browser und Betriebssystem (User-Agent)',
  'privacy.hosting.8' => 'Zweck ist die Auslieferung der Website sowie die Gewährleistung von Sicherheit und Stabilität, etwa zur Abwehr von Angriffen. Rechtsgrundlage ist Art. 6 Abs. 1 lit. f DSGVO. Mein berechtigtes Interesse liegt in einem sicheren und fehlerfreien Betrieb der Website.',
  'privacy.hosting.9' => 'Die Erhebung dieser Daten erfolgt auf dem Server meines Hosting-Anbieters STRATO GmbH, Otto-Ostrowski-Straße 7, 10249 Berlin. STRATO speichert die IP-Adressen der Besucher aus Sicherheitsgründen, zur Erkennung und Abwehr von Angriffen, höchstens 7 Tage. Mir selbst stehen im Kundenbereich des Hosters nur anonymisierte Access-Logs der letzten 6 Wochen zur Verfügung, die keinen Rückschluss auf konkrete Personen erlauben. Eine Zusammenführung dieser Daten mit anderen Datenquellen, die einen Personenbezug herstellen würden, erfolgt nicht.',

  'privacy.cookies.title' => 'Cookies und lokale Speicherung',
  'privacy.cookies.1' => 'Ich setze keine Cookies zu Analyse- oder Werbezwecken. Gespeichert werden nur technisch erforderliche Daten, für die keine Einwilligung nötig ist (§ 25 Abs. 2 Nr. 2 TDDDG):',
  'privacy.cookies.2' => '- Session-Cookie (PHPSESSID): wird nur auf der Kontaktseite gesetzt und schützt das Formular vor Missbrauch und Spam (Sicherheits-Token). Es enthält keine personenbezogenen Inhalte, ist HttpOnly und SameSite=Lax und wird beim Schließen des Browsers gelöscht.',
  'privacy.cookies.3' => '- Anzeigemodus (hell oder dunkel): Wenn Sie den Schalter im Kopfbereich benutzen, speichert Ihr Browser Ihre Wahl im lokalen Speicher (localStorage). Der Wert bleibt in Ihrem Browser und wird nicht an mich übermittelt. Sie können ihn jederzeit in den Browser-Einstellungen löschen.',
  'privacy.cookies.4' => 'Die Sprache (Deutsch oder Englisch) ergibt sich aus der Adresse der Seite und wird nicht gespeichert. Rechtsgrundlage für die genannten Vorgänge ist Art. 6 Abs. 1 lit. f DSGVO.',

  'privacy.contact.title' => 'Kontaktformular und E-Mail',
  'privacy.contact.1' => 'Wenn Sie mir über das Kontaktformular oder per E-Mail schreiben, verarbeite ich Ihren Namen, Ihre E-Mail-Adresse und Ihre Nachricht, um Ihre Anfrage zu beantworten. Das Formular wird per E-Mail an mich übermittelt. Name, E-Mail-Adresse und Nachricht sind Pflichtangaben, damit ich Ihnen antworten kann.',
  'privacy.contact.2' => 'Als Schutz vor Spam enthält das Formular ein unsichtbares Zusatzfeld (Honeypot) und ein Sicherheits-Token (siehe Session-Cookie oben). Daraus werden keine Profile gebildet. Außerdem begrenze ich die Zahl der Anfragen pro IP-Adresse: Dafür speichert der Server höchstens zwei Stunden lang nur einen Hash der IP-Adresse mit einem Zähler, keine Klartext-IP.',
  'privacy.contact.3' => 'Rechtsgrundlage ist Art. 6 Abs. 1 lit. b DSGVO, soweit Ihre Anfrage auf einen Vertrag oder vorvertragliche Maßnahmen gerichtet ist, andernfalls Art. 6 Abs. 1 lit. f DSGVO (mein berechtigtes Interesse, Anfragen zu beantworten).',
  'privacy.contact.4' => 'Ich lösche Ihre Angaben, sobald die Anfrage abschließend bearbeitet ist und keine gesetzlichen Aufbewahrungspflichten entgegenstehen, etwa für Geschäftskorrespondenz. Eine Weitergabe an Dritte erfolgt nicht, abgesehen von der Weiterleitung an mein Postfach (siehe Abschnitt „Empfänger, Drittländer und Speicherdauer“).',

  'privacy.external.title' => 'Externe Links',
  'privacy.external.1' => 'Diese Website enthält Links zu anderen Websites, etwa zu LinkedIn, GitHub und zu Projekten meiner Kundinnen und Kunden. Erst wenn Sie einen Link anklicken, werden Daten wie Ihre IP-Adresse an den jeweiligen Betreiber übertragen. Für dessen Datenverarbeitung gilt die dortige Datenschutzerklärung.',

  'privacy.tls.title' => 'SSL/TLS-Verschlüsselung',
  'privacy.tls.1' => 'Diese Website verwendet SSL/TLS-Verschlüsselung, damit übertragene Daten nicht von Dritten gelesen werden können. Eine verschlüsselte Verbindung erkennen Sie an „https://“ in der Adresszeile und am Schloss-Symbol Ihres Browsers.',

  'privacy.recipients.title' => 'Empfänger, Drittländer und Speicherdauer',
  'privacy.recipients.1' => 'Empfänger Ihrer Daten ist der Hosting-Anbieter (STRATO GmbH) als Auftragsverarbeiter. Auch die E-Mail-Adresse {email} wird bei STRATO betrieben. E-Mails an diese Adresse, auch Nachrichten aus dem Kontaktformular, leite ich an mein persönliches Postfach bei Google (Gmail) weiter. Google ist damit für diese E-Mails ein weiterer Empfänger.',
  'privacy.recipients.2' => 'Dabei können Daten in die USA übermittelt werden. Grundlage ist der Angemessenheitsbeschluss der EU-Kommission zum EU-U.S. Data Privacy Framework. Darüber hinaus übermittle ich keine personenbezogenen Daten in Länder außerhalb der Europäischen Union bzw. des Europäischen Wirtschaftsraums.',
  'privacy.recipients.3' => 'Die IP-Adressen in den Server-Log-Dateien werden nach höchstens 7 Tagen gelöscht (siehe Abschnitt Hosting), Kontaktanfragen wie oben beschrieben. Der Session-Cookie endet mit dem Schließen des Browsers.',

  'privacy.rights.title' => 'Ihre Rechte',
  'privacy.rights.1' => 'Sie haben mir gegenüber folgende Rechte in Bezug auf Ihre personenbezogenen Daten:',
  'privacy.rights.2' => '- Auskunft (Art. 15 DSGVO)',
  'privacy.rights.3' => '- Berichtigung unrichtiger Daten (Art. 16 DSGVO)',
  'privacy.rights.4' => '- Löschung (Art. 17 DSGVO)',
  'privacy.rights.5' => '- Einschränkung der Verarbeitung (Art. 18 DSGVO)',
  'privacy.rights.6' => '- Datenübertragbarkeit (Art. 20 DSGVO)',
  'privacy.rights.7' => '- Widerspruch gegen die Verarbeitung (Art. 21 DSGVO)',
  'privacy.rights.8' => 'Soweit ich Daten auf Grundlage meines berechtigten Interesses (Art. 6 Abs. 1 lit. f DSGVO) verarbeite, können Sie dem aus Gründen, die sich aus Ihrer besonderen Situation ergeben, jederzeit widersprechen. Um Ihre Rechte auszuüben, schreiben Sie mir an {email}.',

  'privacy.complaint.title' => 'Beschwerderecht',
  'privacy.complaint.1' => 'Wenn Sie der Ansicht sind, dass die Verarbeitung Ihrer Daten gegen Datenschutzrecht verstößt, können Sie sich bei einer Aufsichtsbehörde beschweren (Art. 77 DSGVO). Für meinen Sitz zuständig ist die {berlin}. Eine Übersicht aller Aufsichtsbehörden finden Sie {list}.',

  'privacy.automated.title' => 'Automatisierte Entscheidungsfindung',
  'privacy.automated.1' => 'Es findet keine automatisierte Entscheidungsfindung einschließlich Profiling im Sinne von Art. 22 DSGVO statt.',
];
