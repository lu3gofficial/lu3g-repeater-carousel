<?php
/**
 * Icone automatiche: sceglie un'icona dal testo della card, senza servizi esterni.
 *
 * Elenco di parole italiane collegate alle icone. Una parola vale anche come inizio di parola
 * ("spedizion" trova "spedizioni"); con "!" in fondo vale solo la parola esatta ("auto!" non trova
 * "automatico"). Testo senza accenti e minuscolo. Conta di più il titolo; a parità vince la parola più lunga.
 *
 * Icone: Lucide 0.460.0 (https://lucide.dev), licenza ISC, vedi LICENSE-lucide.txt.
 * Stile unico a tratti: seguono il colore dell'icona impostato nel widget.
 */

namespace LU3G\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Auto_Icons {

	/** Nome dell'icona => parole. */
	const KEYWORDS = array(
		'truck' => 'spedizion,corriere,logistic,trasport,consegn,spedisc,camion,furgon,traslo',
		'utensils' => 'ristorazion,gastronom,ristorant,trattoria,catering,osteria,cucina,mangia,pasta!,piatti,piatto,pranzo,cucin,menu!,cena,chef',
		'phone' => 'numero verde,centralino,chiamata,contatt,telefon,chiama',
		'mail' => 'newsletter,scrivici,e-mail,email,mail!,posta',
		'map-pin' => 'come arrivare,raggiungici,dove siamo,indirizzo,posizione,mappa,sede',
		'clock' => 'puntual,orario,veloce,orari,rapid,tempo,ore!',
		'calendar' => 'appuntament,prenotazion,calendario,prenota,scadenz,agenda,eventi,evento,data!,date!',
		'users' => 'collaborator,chi siamo,community,dipendent,comunita,famiglia,persone,squadra,gruppi,gruppo,staff,team',
		'user' => 'consulente,account,cliente,clienti,persona,profilo',
		'shield-check' => 'assicurazion,certificat,affidabil,protezion,sicurezza,garantit,garanzia,sicura,sicuro',
		'circle-check' => 'controllo,verificat,approvat,completa,completo,conform,qualita,soddisf',
		'star' => 'valutazion,recension,eccellen,migliore,migliori,premium,stella,stelle',
		'heart' => 'benessere,dedizione,passione,salute,amore,cuore,cura!',
		'leaf' => 'sostenibil,ambiente,biologic,ecologic,natural,vegetal,foglia,green!,natura,bio!,erbe',
		'wrench' => 'assistenza tecnica,manutenzion,riparazion,idraulic,meccanic,officina,guasti,guasto,ripara',
		'settings' => 'personalizza,impostazion,automazion,tecnologia,configura,impianti,impianto,processi,processo',
		'trending-up' => 'performance,statistich,fatturato,marketing,risultati,strategia,crescita,analisi,vendite,seo!',
		'euro' => 'preventiv,risparmio,economic,listino,finanz,prezzi,prezzo,tariff,costi,costo,euro!',
		'credit-card' => 'carta di credito,bonifico,pagament,rateizz,rate!',
		'shopping-cart' => 'e-commerce,ecommerce,carrello,prodotti,prodotto,acquist,negozio,compra,store!,shop!',
		'gift' => 'promozion,offerta,offerte,omaggio,regali,regalo,sconti,sconto,buono',
		'house' => 'appartament,ristruttura,abitazion,domicilio,edilizia,residenz,immobil,villa!,casa',
		'building-2' => 'condomin,albergo,azienda,aziende,impresa,imprese,societa,ufficio,uffici,hotel',
		'car' => 'autonoleggio,concessionar,carrozzeria,autoveicol,parcheggio,automobil,noleggio,veicol,auto!',
		'plane' => 'escursion,viaggio,turism,vacanz,viaggi,aereo,voli,volo',
		'graduation-cap' => 'universita,didattica,formazion,studenti,insegna,lezioni,laurea,scuola,corsi,corso',
		'book-open' => 'biblioteca,catalogo,racconto,lettura,manuale,storia,guida,libri,libro',
		'laptop' => 'gestionale,informatic,computer,digitale,siti web,sito web,software,online',
		'smartphone' => 'applicazion,smartphone,cellulare,mobile,app!',
		'globe' => 'internazional,traduzion,globale,estero,lingue,mondo,sito!,web!',
		'lightbulb' => 'illuminazion,innovazion,consiglio,creativit,consigli,progetti,progetto,soluzion,idea,idee',
		'palette' => 'decorazion,creativ,grafica,pittura,artist,colore,colori,design,arte!',
		'camera' => 'servizio fotografico,reportage,fotograf,immagini,foto!',
		'music' => 'orchestra,concerti,concerto,strument,musica,canto,dj!',
		'coffee' => 'caffetteria,cappuccino,colazion,caffe,pausa,bar!',
		'wine' => 'degustazion,aperitiv,brindisi,cantina,enoteca,vigneto,vini,vino',
		'pizza' => 'forno a legna,pizzeria,pizza',
		'fish' => 'frutti di mare,acquario,mare e,pesca!,pesce,sushi',
		'sprout' => 'agricol,giardin,coltiv,pianta,piante,semina,vivaio,orto!',
		'trees' => 'montagna verde,foresta,alberi,albero,bosco,parco',
		'sun' => 'fotovoltaic,spiaggia,terrazza,estate,solare,estiv,luce,sole',
		'droplets' => 'lavanderia,lavaggio,fontana,piscina,pulizia,pulizie,sanific,idrata,acqua,igien',
		'zap' => 'impianto elettrico,luce e gas,batteria,batterie,elettric,ricarica,energia,potenza',
		'recycle' => 'economia circolare,riciclabil,riciclo,rifiuti,riuso',
		'stethoscope' => 'ambulatorio,cardiolog,diagnosi,ospedale,sanitari,clinica,pediatr,dottor,visita,visite,medic',
		'pill' => 'cura farmacologica,integrator,farmacia,medicina,farmaci,farmaco,terapia,terapie',
		'dumbbell' => 'personal trainer,fisioterapia,allenament,palestra,fitness,atleti,muscol,sport',
		'paw-print' => 'veterinar,animale,animali,gatti,gatto,cane,cani,pet!',
		'baby' => 'pediatria,infanzia,bambin,neonat,asilo,bimbi,bimbo,mamma',
		'handshake' => 'collaborazion,consulenza,consulenze,mediazion,accordi,accordo,fiducia,partner',
		'award' => 'certificazion,riconosciment,esperienza,storia dal,tradizione,anni di,premio,premi',
		'trophy' => 'obiettivi raggiunti,competizion,vittoria,campion,torneo,gara,gare',
		'lock' => 'cassaforte,password,riservat,serratur,accesso,privacy,gdpr',
		'key' => 'agenzia immobiliare,vendita casa,locazion,affitt,chiave,chiavi',
		'search' => 'indagine,esplora,ricerca,scopri,cerca,trova',
		'message-circle' => 'comunicazion,assistenza,messaggio,parla con,messaggi,supporto,whatsapp,ascolto,domande,chat,faq!',
		'file-text' => 'commercialist,contabil,contratt,document,pratiche,burocra,pratica,fattur,fiscal,moduli,modulo,fisco,tasse',
		'megaphone' => 'social media,comunicati,pubblicit,annuncio,campagna,annunci,notizie,social!,novita',
		'rocket' => 'partenza,decolla,startup,lancio,start!,subito,avvio',
		'paint-roller' => 'carta da parati,rivestiment,verniciatur,tinteggi,imbianc,pareti',
		'hammer' => 'installazion,costruzion,montaggio,artigian,falegnam,cantier,lavori,posa!,edil',
		'shirt' => 'abbigliament,sartoria,camicie,maglie,stoffe,tessut,vestit,abiti,abito,moda',
		'gem' => 'matrimoni,esclusiv,preziosi,diamant,gioiell,lusso,nozze,orafo,sposa,sposi',
		'flower-2' => 'trattamenti,bellezza,estetica,massaggi,bouquet,fiorist,fiore,fiori,spa!',
		'bed' => 'bed and breakfast,soggiorno,alloggio,materass,alloggi,dormire,pernott,camera,camere,riposo,b&b',
		'bike' => 'bicicletta,e-bike,ebike,bici,cicl,mtb',
		'ship' => 'crociera,nautica,barche,marina,barca,porto,nave,navi',
		'mountain' => 'natura incontaminata,dolomiti,montagna,sentieri,trekking,neve e,alpi!,monti,sci!',
		'map' => 'visite guidate,territorio,itinerar,percorsi,percorso,tour!,zona,zone',
		'ticket' => 'abbonament,prevendita,biglietti,biglietto,ingressi,ingresso,lotteria',
		'video' => 'videochiamata,streaming,filmati,riprese,cinema,film!,video',
		'scissors' => 'acconciatur,parrucchier,sartoriale,barbier,capelli,salone,taglio',
		'smile' => 'divertiment,odontoiatr,ortodonz,dentist,sorriso,felici,dente,denti',
		'wheat' => 'pasticceria,panetteria,panificio,cereali,farina,forno!,dolci,grano,pane',
		'thermometer' => 'termoidraulic,riscaldament,temperatura,climatizza,caldaia,caldaie,termico',
		'snowflake' => 'condizionator,refrigera,invernal,surgelat,inverno,freddo,neve',
		'flame' => 'barbecue,griglia,camino,brace,fuoco,stufa,stufe,gas!',
		'sparkles' => 'novita assolute,brillante,detailing,restyling,splendore,trasforma,speciale,effetto,magia',
		'target' => 'precisione,obiettivi,obiettivo,mission,visione,focus,mira',
		'piggy-bank' => 'finanziament,investiment,incentiv,risparmi,prestit,bonus!,banca,mutui,mutuo',
		'scale' => 'giustizia,tribunale,giuridic,avvocat,diritto,legale,notaio,causa,notai',
		'briefcase' => 'consulenza aziendale,professional,assunzion,business,carriera,curricul,impiego,lavoro',
		'hard-hat' => 'sicurezza sul lavoro,impresa edile,cantiere,geometra,ingegner,operai',
		'ruler' => 'progettazion,architett,planimetr,su misura,rilievo,misura,misure',
		'sofa' => 'arredament,soggiorno,interni,salotto,arredi,arredo,divani,divano,mobili',
		'lamp' => 'lampadari,illumina,faretti,lampad,luci',
		'bath' => 'idromassaggio,sanitari per,termale,doccia,bagni,bagno,terme,vasca',
		'package' => 'imballagg,magazzino,ordine,ordini,pacchi,ritiro,scatol,pacco,box!',
		'clipboard-check' => 'sopralluogo,checklist,procedura,procedure,collaudo,ispezion,servizio,verifica,servizi',
		'headphones' => 'assistenza clienti,customer care,call center,ascolta,podcast,audio',
		'wifi' => 'connession,internet,network,fibra,rete!,wi-fi,wifi',
		'code' => 'programmazion,developer,wordpress,sviluppo,codice,plugin',
		'cloud' => 'archiviazion,hosting,server!,backup,cloud',
		'image' => 'foto gallery,portfolio,galleria,gallery,album',
		'pen-tool' => 'immagine coordinata,illustrazion,tipografia,branding,logotipo,disegno,brand!,logo',
	);

	/** Nome dell'icona => forme SVG. */
	const SHAPES = array(
		'truck' => '<path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/>',
		'utensils' => '<path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>',
		'phone' => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail' => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
		'map-pin' => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
		'clock' => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'calendar' => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
		'users' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'user' => '<path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
		'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
		'circle-check' => '<circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>',
		'star' => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
		'heart' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
		'leaf' => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/>',
		'wrench' => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
		'settings' => '<path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/>',
		'trending-up' => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
		'euro' => '<path d="M4 10h12"/><path d="M4 14h9"/><path d="M19 6a7.7 7.7 0 0 0-5.2-2A7.9 7.9 0 0 0 6 12c0 4.4 3.5 8 7.8 8 2 0 3.8-.8 5.2-2"/>',
		'credit-card' => '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>',
		'shopping-cart' => '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>',
		'gift' => '<rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"/>',
		'house' => '<path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>',
		'building-2' => '<path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>',
		'car' => '<path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/>',
		'plane' => '<path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>',
		'graduation-cap' => '<path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
		'book-open' => '<path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/>',
		'laptop' => '<path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"/>',
		'smartphone' => '<rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>',
		'globe' => '<circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/>',
		'lightbulb' => '<path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/>',
		'palette' => '<circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/>',
		'camera' => '<path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/>',
		'music' => '<path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>',
		'coffee' => '<path d="M10 2v2"/><path d="M14 2v2"/><path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1"/><path d="M6 2v2"/>',
		'wine' => '<path d="M8 22h8"/><path d="M7 10h10"/><path d="M12 15v7"/><path d="M12 15a5 5 0 0 0 5-5c0-2-.5-4-2-8H9c-1.5 4-2 6-2 8a5 5 0 0 0 5 5Z"/>',
		'pizza' => '<path d="m12 14-1 1"/><path d="m13.75 18.25-1.25 1.42"/><path d="M17.775 5.654a15.68 15.68 0 0 0-12.121 12.12"/><path d="M18.8 9.3a1 1 0 0 0 2.1 7.7"/><path d="M21.964 20.732a1 1 0 0 1-1.232 1.232l-18-5a1 1 0 0 1-.695-1.232A19.68 19.68 0 0 1 15.732 2.037a1 1 0 0 1 1.232.695z"/>',
		'fish' => '<path d="M6.5 12c.94-3.46 4.94-6 8.5-6 3.56 0 6.06 2.54 7 6-.94 3.47-3.44 6-7 6s-7.56-2.53-8.5-6Z"/><path d="M18 12v.5"/><path d="M16 17.93a9.77 9.77 0 0 1 0-11.86"/><path d="M7 10.67C7 8 5.58 5.97 2.73 5.5c-1 1.5-1 5 .23 6.5-1.24 1.5-1.24 5-.23 6.5C5.58 18.03 7 16 7 13.33"/><path d="M10.46 7.26C10.2 5.88 9.17 4.24 8 3h5.8a2 2 0 0 1 1.98 1.67l.23 1.4"/><path d="m16.01 17.93-.23 1.4A2 2 0 0 1 13.8 21H9.5a5.96 5.96 0 0 0 1.49-3.98"/>',
		'sprout' => '<path d="M7 20h10"/><path d="M10 20c5.5-2.5.8-6.4 3-10"/><path d="M9.5 9.4c1.1.8 1.8 2.2 2.3 3.7-2 .4-3.5.4-4.8-.3-1.2-.6-2.3-1.9-3-4.2 2.8-.5 4.4 0 5.5.8z"/><path d="M14.1 6a7 7 0 0 0-1.1 4c1.9-.1 3.3-.6 4.3-1.4 1-1 1.6-2.3 1.7-4.6-2.7.1-4 1-4.9 2z"/>',
		'trees' => '<path d="M10 10v.2A3 3 0 0 1 8.9 16H5a3 3 0 0 1-1-5.8V10a3 3 0 0 1 6 0Z"/><path d="M7 16v6"/><path d="M13 19v3"/><path d="M12 19h8.3a1 1 0 0 0 .7-1.7L18 14h.3a1 1 0 0 0 .7-1.7L16 9h.2a1 1 0 0 0 .8-1.7L13 3l-1.4 1.5"/>',
		'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
		'droplets' => '<path d="M7 16.3c2.2 0 4-1.83 4-4.05 0-1.16-.57-2.26-1.71-3.19S7.29 6.75 7 5.3c-.29 1.45-1.14 2.84-2.29 3.76S3 11.1 3 12.25c0 2.22 1.8 4.05 4 4.05z"/><path d="M12.56 6.6A10.97 10.97 0 0 0 14 3.02c.5 2.5 2 4.9 4 6.5s3 3.5 3 5.5a6.98 6.98 0 0 1-11.91 4.97"/>',
		'zap' => '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>',
		'recycle' => '<path d="M7 19H4.815a1.83 1.83 0 0 1-1.57-.881 1.785 1.785 0 0 1-.004-1.784L7.196 9.5"/><path d="M11 19h8.203a1.83 1.83 0 0 0 1.556-.89 1.784 1.784 0 0 0 0-1.775l-1.226-2.12"/><path d="m14 16-3 3 3 3"/><path d="M8.293 13.596 7.196 9.5 3.1 10.598"/><path d="m9.344 5.811 1.093-1.892A1.83 1.83 0 0 1 11.985 3a1.784 1.784 0 0 1 1.546.888l3.943 6.843"/><path d="m13.378 9.633 4.096 1.098 1.097-4.096"/>',
		'stethoscope' => '<path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/>',
		'pill' => '<path d="m10.5 20.5 10-10a4.95 4.95 0 1 0-7-7l-10 10a4.95 4.95 0 1 0 7 7Z"/><path d="m8.5 8.5 7 7"/>',
		'dumbbell' => '<path d="M14.4 14.4 9.6 9.6"/><path d="M18.657 21.485a2 2 0 1 1-2.829-2.828l-1.767 1.768a2 2 0 1 1-2.829-2.829l6.364-6.364a2 2 0 1 1 2.829 2.829l-1.768 1.767a2 2 0 1 1 2.828 2.829z"/><path d="m21.5 21.5-1.4-1.4"/><path d="M3.9 3.9 2.5 2.5"/><path d="M6.404 12.768a2 2 0 1 1-2.829-2.829l1.768-1.767a2 2 0 1 1-2.828-2.829l2.828-2.828a2 2 0 1 1 2.829 2.828l1.767-1.768a2 2 0 1 1 2.829 2.829z"/>',
		'paw-print' => '<circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/><path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/>',
		'baby' => '<path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M19 6.3a9 9 0 0 1 1.8 3.9 2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1"/>',
		'handshake' => '<path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/>',
		'award' => '<path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/>',
		'trophy' => '<path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/>',
		'lock' => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
		'key' => '<path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"/><path d="m21 2-9.6 9.6"/><circle cx="7.5" cy="15.5" r="5.5"/>',
		'search' => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
		'message-circle' => '<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>',
		'file-text' => '<path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/>',
		'megaphone' => '<path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
		'rocket' => '<path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/>',
		'paint-roller' => '<rect width="16" height="6" x="2" y="2" rx="2"/><path d="M10 16v-2a2 2 0 0 1 2-2h8a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect width="4" height="6" x="8" y="16" rx="1"/>',
		'hammer' => '<path d="m15 12-8.373 8.373a1 1 0 1 1-3-3L12 9"/><path d="m18 15 4-4"/><path d="m21.5 11.5-1.914-1.914A2 2 0 0 1 19 8.172V7l-2.26-2.26a6 6 0 0 0-4.202-1.756L9 2.96l.92.82A6.18 6.18 0 0 1 12 8.4V10l2 2h1.172a2 2 0 0 1 1.414.586L18.5 14.5"/>',
		'shirt' => '<path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>',
		'gem' => '<path d="M6 3h12l4 6-10 13L2 9Z"/><path d="M11 3 8 9l4 13 4-13-3-6"/><path d="M2 9h20"/>',
		'flower-2' => '<path d="M12 5a3 3 0 1 1 3 3m-3-3a3 3 0 1 0-3 3m3-3v1M9 8a3 3 0 1 0 3 3M9 8h1m5 0a3 3 0 1 1-3 3m3-3h-1m-2 3v-1"/><circle cx="12" cy="8" r="2"/><path d="M12 10v12"/><path d="M12 22c4.2 0 7-1.667 7-5-4.2 0-7 1.667-7 5Z"/><path d="M12 22c-4.2 0-7-1.667-7-5 4.2 0 7 1.667 7 5Z"/>',
		'bed' => '<path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/>',
		'bike' => '<circle cx="18.5" cy="17.5" r="3.5"/><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="15" cy="5" r="1"/><path d="M12 17.5V14l-3-3 4-3 2 3h2"/>',
		'ship' => '<path d="M2 21c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1 .6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1"/><path d="M19.38 20A11.6 11.6 0 0 0 21 14l-9-4-9 4c0 2.9.94 5.34 2.81 7.76"/><path d="M19 13V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6"/><path d="M12 10v4"/><path d="M12 2v3"/>',
		'mountain' => '<path d="m8 3 4 8 5-5 5 15H2L8 3z"/>',
		'map' => '<path d="M14.106 5.553a2 2 0 0 0 1.788 0l3.659-1.83A1 1 0 0 1 21 4.619v12.764a1 1 0 0 1-.553.894l-4.553 2.277a2 2 0 0 1-1.788 0l-4.212-2.106a2 2 0 0 0-1.788 0l-3.659 1.83A1 1 0 0 1 3 19.381V6.618a1 1 0 0 1 .553-.894l4.553-2.277a2 2 0 0 1 1.788 0z"/><path d="M15 5.764v15"/><path d="M9 3.236v15"/>',
		'ticket' => '<path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>',
		'video' => '<path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/><rect x="2" y="6" width="14" height="12" rx="2"/>',
		'scissors' => '<circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M14.8 14.8 20 20"/>',
		'smile' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/>',
		'wheat' => '<path d="M2 22 16 8"/><path d="M3.47 12.53 5 11l1.53 1.53a3.5 3.5 0 0 1 0 4.94L5 19l-1.53-1.53a3.5 3.5 0 0 1 0-4.94Z"/><path d="M7.47 8.53 9 7l1.53 1.53a3.5 3.5 0 0 1 0 4.94L9 15l-1.53-1.53a3.5 3.5 0 0 1 0-4.94Z"/><path d="M11.47 4.53 13 3l1.53 1.53a3.5 3.5 0 0 1 0 4.94L13 11l-1.53-1.53a3.5 3.5 0 0 1 0-4.94Z"/><path d="M20 2h2v2a4 4 0 0 1-4 4h-2V6a4 4 0 0 1 4-4Z"/><path d="M11.47 17.47 13 19l-1.53 1.53a3.5 3.5 0 0 1-4.94 0L5 19l1.53-1.53a3.5 3.5 0 0 1 4.94 0Z"/><path d="M15.47 13.47 17 15l-1.53 1.53a3.5 3.5 0 0 1-4.94 0L9 15l1.53-1.53a3.5 3.5 0 0 1 4.94 0Z"/><path d="M19.47 9.47 21 11l-1.53 1.53a3.5 3.5 0 0 1-4.94 0L13 11l1.53-1.53a3.5 3.5 0 0 1 4.94 0Z"/>',
		'thermometer' => '<path d="M14 4v10.54a4 4 0 1 1-4 0V4a2 2 0 0 1 4 0Z"/>',
		'snowflake' => '<line x1="2" x2="22" y1="12" y2="12"/><line x1="12" x2="12" y1="2" y2="22"/><path d="m20 16-4-4 4-4"/><path d="m4 8 4 4-4 4"/><path d="m16 4-4 4-4-4"/><path d="m8 20 4-4 4 4"/>',
		'flame' => '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>',
		'sparkles' => '<path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/>',
		'target' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
		'piggy-bank' => '<path d="M19 5c-1.5 0-2.8 1.4-3 2-3.5-1.5-11-.3-11 5 0 1.8 0 3 2 4.5V20h4v-2h3v2h4v-4c1-.5 1.7-1 2-2h2v-4h-2c0-1-.5-1.5-1-2V5z"/><path d="M2 9v1c0 1.1.9 2 2 2h1"/><path d="M16 11h.01"/>',
		'scale' => '<path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>',
		'briefcase' => '<path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/>',
		'hard-hat' => '<path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"/><path d="M14 6a6 6 0 0 1 6 6v3"/><path d="M4 15v-3a6 6 0 0 1 6-6"/><rect x="2" y="15" width="20" height="4" rx="1"/>',
		'ruler' => '<path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"/><path d="m14.5 12.5 2-2"/><path d="m11.5 9.5 2-2"/><path d="m8.5 6.5 2-2"/><path d="m17.5 15.5 2-2"/>',
		'sofa' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M4 18v2"/><path d="M20 18v2"/><path d="M12 4v9"/>',
		'lamp' => '<path d="M8 2h8l4 10H4L8 2Z"/><path d="M12 12v6"/><path d="M8 22v-2c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2H8Z"/>',
		'bath' => '<path d="M10 4 8 6"/><path d="M17 19v2"/><path d="M2 12h20"/><path d="M7 19v2"/><path d="M9 5 7.621 3.621A2.121 2.121 0 0 0 4 5v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5"/>',
		'package' => '<path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"/><path d="M12 22V12"/><path d="m3.3 7 7.703 4.734a2 2 0 0 0 1.994 0L20.7 7"/><path d="m7.5 4.27 9 5.15"/>',
		'clipboard-check' => '<rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/>',
		'headphones' => '<path d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3"/>',
		'wifi' => '<path d="M12 20h.01"/><path d="M2 8.82a15 15 0 0 1 20 0"/><path d="M5 12.859a10 10 0 0 1 14 0"/><path d="M8.5 16.429a5 5 0 0 1 7 0"/>',
		'code' => '<polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>',
		'cloud' => '<path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9Z"/>',
		'image' => '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>',
		'pen-tool' => '<path d="M15.707 21.293a1 1 0 0 1-1.414 0l-1.586-1.586a1 1 0 0 1 0-1.414l5.586-5.586a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 1 0 1.414z"/><path d="m18 13-1.375-6.874a1 1 0 0 0-.746-.776L3.235 2.028a1 1 0 0 0-1.207 1.207L5.35 15.879a1 1 0 0 0 .776.746L13 18"/><path d="m2.3 2.3 7.286 7.286"/><circle cx="11" cy="11" r="2"/>',
	);

	/**
	 * Testo pronto per il confronto: senza HTML, accenti e maiuscole.
	 *
	 * @param string $text Testo della card.
	 * @return string
	 */
	private static function normalize( $text ) {
		$text = html_entity_decode( wp_strip_all_tags( (string) $text ), ENT_QUOTES, 'UTF-8' );

		return strtolower( remove_accents( $text ) );
	}

	/**
	 * La parola compare nel testo? Sempre a inizio di parola; con "!" anche finita lì.
	 *
	 * @param string $word Parola dell'elenco.
	 * @param string $text Testo normalizzato.
	 * @return bool
	 */
	private static function has_word( $word, $text ) {
		$exact = '!' === substr( $word, -1 );
		$word  = rtrim( $word, '!' );

		if ( '' === $word || false === strpos( $text, $word ) ) {
			return false;
		}

		return (bool) preg_match( '/(?<![a-z0-9])' . preg_quote( $word, '/' ) . ( $exact ? '(?![a-z0-9])' : '' ) . '/', $text );
	}

	/**
	 * Parole personalizzate del widget: una riga "parola, parola = nome-icona".
	 * Le righe con un'icona che non esiste vengono ignorate.
	 *
	 * @param string $lines Testo del campo.
	 * @return array Nome dell'icona => parole normalizzate.
	 */
	public static function parse_custom( $lines ) {
		$out = array();

		foreach ( preg_split( '/\r\n|\r|\n/', (string) $lines ) as $line ) {
			$parts = explode( '=', $line, 2 );

			if ( 2 !== count( $parts ) ) {
				continue;
			}

			$icon = strtolower( trim( $parts[1] ) );

			if ( ! isset( self::SHAPES[ $icon ] ) ) {
				continue;
			}

			$words = array_filter( array_map( 'trim', explode( ',', self::normalize( $parts[0] ) ) ) );

			$out[ $icon ] = array_merge( isset( $out[ $icon ] ) ? $out[ $icon ] : array(), $words );
		}

		return $out;
	}

	/**
	 * Sceglie l'icona: un testo alla volta, dal più importante; le parole personalizzate vincono.
	 *
	 * @param array $texts  Testi della card, dal più importante.
	 * @param array $custom Risultato di parse_custom().
	 * @return string Nome dell'icona, vuoto se nessuna parola corrisponde.
	 */
	public static function pick( array $texts, array $custom = array() ) {
		foreach ( $texts as $raw ) {
			$text = self::normalize( $raw );

			if ( '' === trim( $text ) ) {
				continue;
			}

			$best = '';
			$size = 0;

			foreach ( $custom as $icon => $words ) {
				foreach ( $words as $word ) {
					if ( strlen( $word ) > $size && self::has_word( $word, $text ) ) {
						$best = $icon;
						$size = strlen( $word );
					}
				}
			}

			if ( '' !== $best ) {
				return $best;
			}

			foreach ( self::KEYWORDS as $icon => $list ) {
				foreach ( explode( ',', $list ) as $word ) {
					if ( strlen( $word ) > $size && self::has_word( $word, $text ) ) {
						$best = $icon;
						$size = strlen( $word );
					}
				}
			}

			if ( '' !== $best ) {
				return $best;
			}
		}

		return '';
	}

	/**
	 * SVG di un'icona, che prende il colore dal testo.
	 *
	 * @param string $icon Nome dell'icona.
	 * @return string
	 */
	public static function markup( $icon ) {
		if ( ! isset( self::SHAPES[ $icon ] ) ) {
			return '';
		}

		return '<svg class="lu3g-carousel__auto-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . self::SHAPES[ $icon ] . '</svg>';
	}
}
