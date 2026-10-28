# Changelog

## 1.29.1
- Il repository è passato all'organizzazione GitHub `lu3gofficial`: gli aggiornamenti arrivano da https://github.com/lu3gofficial/lu3g-repeater-carousel. I siti con versioni precedenti si aggiornano comunque, perché GitHub reindirizza il vecchio indirizzo.

## 1.29.0
- Nuova sezione *Contenuto → Invito a scorrere (mobile)*: quando su mobile le frecce non si vedono, un'animazione sopra le card invita a scorrere. Cinque animazioni: *Mano che scorre*, *Frecce lampeggianti*, *Etichetta "Scorri"* (testo modificabile), *Tocco con scia*, *Spinta delle card* (senza sovrimpressione). Posizione (centro, bordo destro, in basso) e durata regolabili; colore, sfondo e dimensione in *Stile → Invito a scorrere*.
- Compare una volta, quando il carosello entra nello schermo, solo se c'è qualcosa da scorrere; sparisce al primo tocco o dopo la durata. Con *riduci movimento* attivo nel sistema resta fermo, e la *Spinta delle card* non parte.

## 1.28.2
- Corretto: la sottolineatura non si vedeva sulle card con il solo titolo e il troncamento attivo (che in quel caso tronca il titolo). Il titolo troncato taglia ciò che esce dalle sue righe, e la linea, sul bordo inferiore della scritta, veniva tagliata. Ora sta leggermente più in alto, dentro la riga.
- Le pagine servite da una cache con l'HTML di prima della 1.28 ricevono lo span del titolo dal JS, così la sottolineatura funziona anche prima di svuotare la cache.

## 1.28.1
- Corretto: la sottolineatura e l'evidenziatore non si vedevano sui titoli racchiusi in un paragrafo (`<p>`), come quelli che arrivano da un campo WYSIWYG o da un tag dinamico. I paragrafi attorno al titolo ora vengono tolti, e più paragrafi diventano righe separate.

## 1.28.0
- Nuove animazioni in *Stile → Animazioni*:
  - card: *Sollevamento con ombra*;
  - titolo: *Sottolineatura dal centro*, *Evidenziatore*, *Spaziatura delle lettere*, con *Colore* e *Spessore della linea*;
  - nuovo *Effetto sull'icona*: ingrandimento, rotazione, salto, oscillazione;
  - nuovo *Effetto sul pulsante*: sollevamento, ingrandimento, spinta in avanti; segue *Hover del pulsante* (sulla card o solo sul pulsante).
- Corretto: la sottolineatura del titolo non si vedeva con il titolo troncato, e con *Distribuito* e *Allineato riga per riga* attraversava tutta la card o finiva lontano dal testo. Ora è disegnata sotto le parole, riga per riga, e segue l'allineamento del testo.
- Il titolo ha uno span interno `.lu3g-carousel__text-inner`.

## 1.27.0
- *Card → Stile → Colori propri*: per ogni pulsante anche *Bordo* e *Bordo in hover*. Senza un bordo impostato, il bordo resta del colore dello *Sfondo*, come prima. *Sfondo in hover* non cambia più il colore del bordo.

## 1.26.0
- *Card → tab Stile → Colori propri*: i colori dei pulsanti ora si impostano per ogni pulsante (*Pulsante 1*, *2*, *3*: testo, sfondo, testo in hover, sfondo in hover). I campi del pulsante 2 e 3 compaiono solo se la card ha quel pulsante. Le card già impostate mantengono i colori sul pulsante 1.
- Corretto: dalla 1.25.0 l'hover generale del pulsante poteva sovrascrivere i colori propri della card.

## 1.25.0
- Nuovo *Stile → Pulsante → Hover → Hover del pulsante*: *Passando sulla card* (come prima) oppure *Solo sul pulsante*, per cui colori e spostamento della freccia cambiano solo sul pulsante sotto il mouse. Utile con più pulsanti nella stessa card.

## 1.24.0
- Nuove sezioni *Stile → Pulsante 2* e *Pulsante 3* (sorgente statica): tipografia, colori di testo e sfondo, hover, bordo, raggio e padding per il secondo e il terzo pulsante di ogni card. Ciò che resta vuoto è come nella sezione *Pulsante*. L'hover di questi pulsanti è quello del pulsante stesso, e i loro colori restano anche passando sulla card.
- Sostituisce *Aspetto* e i colori del *pulsante secondario* della 1.23.0.

## 1.23.0
- Card statiche: *Aggiungi un altro pulsante*, fino a tre pulsanti per card, ognuno con testo, link e aspetto (*Come il primo* o *Secondario*).
- *Stile → Pulsante → Più pulsanti*: distanza tra i pulsanti, pulsanti uno sotto l'altro, colori del pulsante secondario (normale e hover). Su card strette i pulsanti vanno a capo da soli.
- Con più pulsanti la card non è cliccabile per intero; se il primo ha il link ma non il testo, diventa un pulsante "Scopri di più".

## 1.22.2
- Corretto: sotto i puntini del testo troncato spuntava la parte alta della riga successiva, che sembrava tagliata di netto. Le cause erano due: il margine dei paragrafi dentro il testo, ora tolto finché il testo è chiuso, e, con *Allineato riga per riga*, l'altezza data al riquadro troncato per allinearlo alle altre card, ora aggiunta sotto il riquadro.

## 1.22.1
- Corretto: dalla 1.19.0 le frecce nelle posizioni *Sotto il carosello*, *A destra del carosello* e la freccia destra di *Ai due lati* non venivano stampate. Una variabile del ciclo dei blocchi di testo sovrascriveva la posizione delle frecce.

## 1.22.0
- *Stile → Icona → Distanza dal testo* accetta valori negativi (fino a -100px), per avvicinare l'icona al testo oltre lo spazio vuoto del disegno. Funziona con l'icona in tutte le posizioni.

## 1.21.0
- Nuovo *Stile → Icona → Icona e testo*: *Insieme* (come prima) oppure *Ai due capi della card*, che porta l'icona in cima e il testo in fondo (o il contrario con l'icona sotto), con tutte le icone alla stessa altezza. Impostabile per dispositivo.
- *Distanza dal testo* arriva fino a 200px.

## 1.20.0
- *Righe visibili* accetta 0: il testo scelto in *Cosa troncare* resta nascosto del tutto e al suo posto c'è solo il pulsante per aprirlo, sempre visibile. Per esempio il secondo blocco di testo nascosto dietro "Scopri di più". Il valore si imposta per dispositivo.

## 1.19.0
- *Opzioni del contenuto → Cosa troncare* ora offre anche il secondo, terzo, quarto e quinto blocco di testo, e *Tutti i blocchi di testo*. Ogni testo troncato ha il suo "Mostra di più" e si apre da solo, anche con lo scorrimento infinito.
- Con un blocco preciso, le card che non ce l'hanno restano intere.

## 1.18.0
- Nuovo *Stile → Card → Effetto vetro*: sfoca ciò che sta dietro le card (backdrop-filter), con sfocatura per dispositivo, saturazione e sfocatura in hover. Funziona anche su Safari e iOS. Richiede uno sfondo della card semitrasparente.

## 1.17.0
- Nuova opzione *Layout → Distribuzione del contenuto → Allineato riga per riga*: icona, etichetta, titolo e ogni blocco di testo prendono l'altezza del più alto tra le card, così titoli e testi partono tutti alla stessa quota anche se un titolo va su più righe. Il pulsante resta in fondo come in *Distribuito*. Le altezze si ricalcolano al ridimensionamento e dopo il caricamento di font e immagini.

## 1.16.0
- Nuova opzione *Scorrimento → Blocca con poche card*. Se le card sono al massimo il numero indicato (*Blocca fino a*, impostabile per dispositivo: di default 3 su desktop, 2 su tablet, 1 su mobile), il carosello diventa una riga ferma: niente scorrimento, frecce, indicatori, scorrimento infinito, autoplay e modalità centrata.
- *Card bloccate*: le card si dividono tutta la larghezza, oppure mantengono la loro larghezza allineate a sinistra, al centro o a destra.
- Se cambiando dispositivo, o ridimensionando la finestra, il blocco si attiva o si disattiva, il carosello si ricostruisce da solo.

## 1.15.0
- Nuovo controllo *Stile → Icona → Allineamento* (sinistra, centro, destra, per dispositivo), per l'icona sopra o sotto il testo.
- Corretto: le icone SVG lette dal repeater JetEngine (*Sottocampo icona*) che usano maschere, come quelle esportate da Figma, mostravano macchie bianche. Il filtro di sicurezza toglieva il tag `<mask>` lasciando visibili le forme che conteneva.
- Gli id interni degli SVG inseriti nella pagina ora hanno un prefisso unico, così due icone diverse con gli stessi id non si scambiano maschere o gradienti.

## 1.14.1
- Corretto: con *Link della card → Da un sottocampo link* il pulsante compariva su tutte le card, anche su quelle con il sottocampo link vuoto, come pulsante non cliccabile. Ora compare solo se la riga ha il link. Se il *Sottocampo link* non è indicato, il pulsante resta come prima.

## 1.14.0
- Nuova opzione *Link della card → Da sottocampi del repeater* per la sorgente dinamica: link e testo del pulsante si leggono da due sottocampi dedicati (*Sottocampo URL*, di default `link_bottone`, e *Sottocampo testo pulsante*, di default `testo_bottone`), con il suo interruttore *Apri in una nuova scheda*. Il testo della card non viene modificato.
- Le card senza URL non hanno il pulsante. Con l'URL e senza testo si usa il *Testo del pulsante* del widget, altrimenti "Scopri di più". `%testo_link%` nel *Testo del pulsante* riprende il valore del sottocampo testo.
- Le modalità esistenti (*Da un sottocampo link*, *Dal primo link nel testo*) funzionano come prima.

## 1.13.0
- Nuova opzione *Opzioni del contenuto → Contenuto del pulsante*: *Testo e icona*, *Solo testo* o *Solo icona*. Con *Solo icona* il pulsante compare su ogni card che ha un link, senza bisogno di scrivere un testo; il testo, se c'è, diventa l'etichetta per i lettori di schermo.
- Sorgente dinamica con *Dal primo link nel testo*: nel testo del pulsante si può usare `%testo_link%` per riprendere le parole del link trovato.

## 1.12.1
- Modalità centrata: all'avvio è centrata la card di mezzo del gruppo visibile. Con 3 card visibili si vede subito piccola, grande, piccola, senza spazi vuoti.
- La card centrale è in rilievo: ombra regolabile (attiva di default) e dimensione che può superare 1.
- Corretto: l'ultima card non arrivava esattamente al centro in fondo al carosello.

## 1.12.0
- Nuova *Modalità centrata* in *Layout*: la card attiva sta al centro, quelle ai lati sono più piccole e sbiadite, con dimensione e opacità regolabili. Funziona con scorrimento infinito, frecce, indicatori ed effetti hover.

## 1.11.0
- Nuova opzione *Frecce → Nascondi se non c'è niente da scorrere*: quando tutte le card sono già visibili le frecce spariscono invece di restare spente, e ricompaiono se la finestra si restringe.

## 1.10.1
- Versione di prova del sistema di aggiornamento automatico da GitHub. Nessuna modifica al funzionamento del carosello.

## 1.10.0
- Nuova opzione *Link della card → Dal primo link nel testo* per la sorgente dinamica: il pulsante compare solo sulle card che hanno un link nei testi, e usa quel link.

## 1.9.2
- Nell'editor, quando la sorgente dinamica non produce card, il messaggio dice quale passaggio non torna e, se il sottocampo è sbagliato, elenca quelli disponibili nel repeater.

## 1.9.1
- Corretto: su iPhone le card non scorrevano con lo swipe. Una regola introdotta nella 1.8.1 per le frecce (`pointer-events: none` sul contenitore che scorre) blocca lo scorrimento al tocco in Safari per iOS. Le frecce restano cliccabili grazie allo `z-index`.

## 1.9.0
- Immagine di sfondo per le singole card statiche: dimensioni, posizione (anche personalizzata), ripetizione, velatura con colore, intensità e intensità in hover.

## 1.8.1
- Corretto: con l'effetto hover *Ombra*, le frecce sopra o sotto il carosello non rispondevano al click, perché la fascia di margine attorno alle card le copriva.

## 1.8.0
- Nuovo tipo di contenuto **Immagini**: carosello di sole foto dalla libreria media o da una galleria dinamica.
- Proporzione delle card, punto di ritaglio, zoom e velatura in hover, lightbox di Elementor.
- In modalità Immagini il pannello nasconde le sezioni dei testi.

## 1.7.0
- La sorgente dinamica ha gli stessi elementi di quella statica: etichetta, blocchi di testo con stile, pulsante con testo fisso o da sottocampo.
- Nuovi indicatori di posizione: puntini, barra di avanzamento, numeri; sotto, sopra, sovrapposti o tra le frecce.
- Nuovo contenitore `__stage` attorno al viewport, riferimento per gli elementi sovrapposti.
- Ripristinato l'interruttore per aggiungere blocchi di testo.

## 1.6.0
- "Numero di frecce" al posto di "Modalità"; "Tipo di contenuto" con le voci Statico e Dinamico.
- Pulsanti per aggiungere i blocchi di testo, sostituiti di nuovo dall'interruttore nella 1.7.0.

## 1.5.0
- Pannello riorganizzato: Card, Opzioni del contenuto, Layout, Scorrimento, Frecce; tab Normale / Hover nelle sezioni di stile.
- Sei posizioni per le frecce, con allineamenti e distanze.
- Corretto: con le frecce sotto, il carosello collassava ad altezza zero.

## 1.4.0
- Blocchi di testo aggiungibili a catena nelle card statiche.
- Tre stili di testo condivisi al posto di uno stile per campo.

## 1.3.0
- Colori propri per singola card.
- Etichetta sopra il titolo, testi con editor visuale.

## 1.2.1
- Corretto il bordo inferiore delle card tagliato dal viewport.
- Corretto il sollevamento in hover bloccato dall'animazione d'ingresso.

## 1.2.0
- Distribuzione del contenuto "Distribuito" e righe riservate per il titolo.

## 1.1.0
- Card statiche con titolo, descrizione e pulsante; tag del titolo; troncamento su titolo o descrizione.

## 1.0.x
- Carosello da repeater JetEngine e da contenuto statico; icone SVG; card visibili e anteprima; larghezza fissa; troncamento; scorrimento infinito; autoplay; animazioni d'ingresso e hover.
- 1.0.1: corretto l'errore fatale dovuto a un metodo in conflitto con Elementor.
