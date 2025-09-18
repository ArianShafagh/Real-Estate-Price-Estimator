<?php
$predictedPrice = null;
$error = null;
$provinces = [
"salerno" => ["praiano", "santa-marina", "scario", "valva", "capaccio-paestum", "vibonati", "giungano", "san-giovanni-a-piro", "palinuro", "ascea", "torraca", "ogliastro-cilento", "pisciotta", "sapri", "centola", "prignano-cilento", "castellabate", "nocera-inferiore", "agropoli", "ispani", "castel-san-lorenzo", "montecorice", "fisciano", "salerno", "orria", "ravello", "corleto-monforte", "angri", "serre", "casal-velino", "buccino", "vietri-sul-mare", "castelnuovo-cilento", "montano-antilia", "scafati", "torchiara", "positano"],
"lucca" => ["lucca", "barga", "bagni-di-lucca", "piazza-al-serchio", "forte-dei-marmi", "pietrasanta", "camporgiano", "montecarlo", "gallicano", "capannori", "vagli-sotto", "san-romano-in-garfagnana", "villa-collemandina", "coreglia-antelminelli", "camaiore", "fosciandora", "massarosa", "borgo-a-mozzano", "minucciano", "viareggio", "pescaglia", "seravezza", "pieve-fosciana", "castelnuovo-di-garfagnana", "altopascio", "molazzana", "castiglione-di-garfagnana", "careggine", "stazzema", "villa-basilica", "sillano-giuncugnano", "fabbriche-di-vergemoli", "porcari"],
"rimini" => ["rimini", "san-clemente", "montefiore-conca", "pennabilli", "verucchio", "mondaino", "bellaria-igea-marina", "riccione", "misano-adriatico", "cattolica", "san-leo", "poggio-torriana", "santarcangelo-di-romagna", "saludecio", "montescudo-monte-colombo", "sassofeltrio", "maiolo", "montegridolfo"],
"isernia" => ["agnone", "roccamandolfi", "cantalupo-nel-sannio", "pietrabbondante", "venafro", "castelverrino", "belmonte-del-sannio", "castelpetroso", "poggio-sannita", "civitanova-del-sannio", "pescolanciano", "conca-casale", "pettoranello-del-molise", "filignano", "macchiagodena", "bagnoli-del-trigno", "vastogirardi"],
"como" => ["carate-urio", "san-siro", "maslianico", "tremezzina", "como", "argegno", "cernobbio", "sorico", "alserio", "cremia", "menaggio", "cerano-d-intelvi", "campione-d-italia", "centro-valle-intelvi", "domaso", "grandola-ed-uniti", "musso", "gravedona-ed-uniti", "moltrasio", "dizzasco", "capiago-intimiano", "valsolda", "tavernerio", "plesio", "torno", "longone-al-segrino", "dongo", "griante", "colonno", "proserpio", "faggeto-lario", "carugo", "brienno", "bellagio", "dosso-del-liro", "erba", "pianello-del-lario", "asso", "appiano-gentile", "claino-con-osteno", "laglio", "carlazzo", "porlezza", "sormano", "albese-con-cassano", "blevio", "anzano-del-parco", "villa-guardia", "gera-lario", "carimate", "colverde", "montorfano", "vercana", "brunate", "rovellasca", "san-fermo-della-battaglia", "olgiate-comasco", "sala-comacina", "garzeno", "casnate-con-bernate", "albavilla", "oltrona-di-san-mamette", "fino-mornasco", "ronago", "albiolo", "magreglio", "inverigo", "cassina-rizzardi", "schignano", "eupilio", "pusiano", "limido-comasco", "lipomo", "cantu", "pognana-lario", "nesso", "monguzzo", "alta-valle-intelvi", "lezzeno"],
"vercelli" => ["piode", "campertogno", "roasio", "palazzolo-vercellese", "borgosesia", "valduggia", "postua", "mollia", "alagna-valsesia", "cellio-con-breia", "vercelli", "fobello", "scopa"],
"milan" => ["ozzero", "san-donato-milanese", "milan", "morimondo", "trezzo-sull-adda", "motta-visconti", "trezzano-sul-naviglio", "san-colombano-al-lambro", "sesto-san-giovanni", "basiglio", "truccazzano", "vermezzo-con-zelo", "peschiera-borromeo", "corbetta", "assago", "parabiago", "inveruno", "segrate", "melegnano", "abbiategrasso", "paderno-dugnano", "pogliano-milanese", "cornaredo", "gaggiano"],
"lecco" => ["oliveto-lario", "montevecchia", "lecco", "galbiate", "valmadrera", "oggiono", "varenna", "imbersago", "olgiate-molgora", "robbiate", "dorio", "mandello-del-lario", "verderio", "bellano", "lierna", "colico", "calolziocorte", "abbadia-lariana", "lomagna", "perledo", "monticello-brianza", "cassago-brianza", "dervio", "barzano", "barzago", "calco", "ello", "introbio"],
"perugia" => ["perugia", "castiglione-del-lago", "spello", "panicale", "todi", "citta-della-pieve", "gubbio", "magione", "nocera-umbra", "lisciano-niccone", "citta-di-castello", "piegaro", "passignano-sul-trasimeno", "massa-martana", "collazzone", "citerna", "montone", "costacciaro", "tuoro-sul-trasimeno", "bettona", "paciano", "marsciano", "monte-santa-maria-tiberina", "san-giustino", "umbertide", "assisi", "sellano", "trevi", "bevagna", "spoleto", "gualdo-cattaneo", "preci", "cannara", "foligno", "corciano", "norcia", "cerreto-di-spoleto", "pietralunga", "cascia", "bastia-umbra", "campello-sul-clitunno", "castel-ritaldi", "valtopina", "monte-castello-di-vibio", "scheggia-e-pascelupo", "fratta-todina", "fossato-di-vico", "montefalco", "valfabbrica", "deruta", "sant-anatolia-di-narco", "scheggino", "giano-dell-umbria", "gualdo-tadino"],
"trento" => ["pinzolo", "massimeno", "isera", "spiazzo", "amblar-don", "trento", "tione-di-trento", "bondone", "primiero-san-martino-di-castrozza", "mazzin", "rovereto", "valdaone", "caderzone", "cavalese", "comano-terme", "pieve-di-bono-prezzo", "bocenago", "fornace", "stenico", "sella-giudicarie", "mezzolombardo", "rabbi", "calliano", "sfruz", "commezzadura", "strembo", "storo", "mori", "porte-di-rendena", "pergine-valsugana", "besenello", "folgaria", "nago-torbole", "castello-tesino", "predaia"],
"syracuse" => ["noto", "pachino", "syracuse", "avola", "rosolini", "augusta", "carlentini", "melilli", "lentini", "canicattini-bagni", "floridia", "palazzolo-acreide", "ferla", "sortino", "priolo-gargallo", "francofonte", "solarino", "buscemi", "buccheri", "portopalo-di-capo-passero"],
"trapani" => ["calatafimi-segesta", "marsala", "castellammare-del-golfo", "trapani", "valderice", "vita", "alcamo", "favignana", "pantelleria", "erice", "custonaci", "san-vito-lo-capo", "mazara-del-vallo", "castelvetrano", "salemi", "buseto-palizzolo", "partanna"],
"bergamo" => ["solto-collina", "cenate-sopra", "foppolo", "monasterolo-del-castello", "sovere", "mozzo", "pontirolo-nuovo", "trescore-balneario", "ponte-san-pietro", "lovere", "grassobbio", "bergamo", "gromo", "parzanica", "ardesio", "roncola", "gazzaniga", "palazzago", "gandellino", "sant-omobono-terme", "sorisole", "predore", "gorno", "lenna", "valbondione", "san-pellegrino-terme", "valgoglio", "foresto-sparso", "oneta", "costa-volpino", "nembro", "treviolo", "tavernola-bergamasca", "alzano-lombardo", "parre", "costa-di-serina", "sarnico", "selvino", "dalmine", "pradalunga", "schilpario", "ranzanico", "pontida", "fonteno", "gorle", "verdello", "clusone", "calusco-d-adda", "castelli-calepio", "pianico", "val-brembilla", "villongo", "premolo", "villa-d-alme", "treviglio", "cenate-sotto", "rovetta", "curno", "branzi", "cerete"],
"brescia" => ["soiano-del-lago", "castegnato", "toscolano-maderno", "iseo", "valvestino", "desenzano-del-garda", "pisogne", "salo", "sirmione", "lonato-del-garda", "gardone-riviera", "darfo-boario-terme", "san-felice-del-benaco", "orzinuovi", "polpenazze-del-garda", "pian-camuno", "adro", "leno", "treviso-bresciano", "manerba-del-garda", "botticino", "tignale", "puegnago-del-garda", "moniga-del-garda", "padenghe-sul-garda", "gavardo", "ponte-di-legno", "sulzano", "pozzolengo", "vestone", "gargnano", "artogne", "monte-isola", "odolo", "carpenedolo", "capovalle", "bagnolo-mella", "vobarno", "marone", "paderno-franciacorta", "passirano", "sale-marasino", "calvagese-della-riviera", "nuvolento", "bione", "roe-volciano", "paratico", "breno", "pertica-bassa", "bagolino", "villachiara", "rodengo-saiano", "lavenone", "lozio", "tremosine", "bedizzole"],
"sassari" => ["santa-teresa-gallura", "la-maddalena", "budoni", "olbia", "arzachena", "san-teodoro", "aglientu", "alghero", "badesi", "trinita-d-agultu-e-vignola", "san-pantaleo", "palau", "stintino", "thiesi", "golfo-aranci", "tempio-pausania", "castelsardo", "bessude", "berchidda", "valledoria", "uri", "sassari", "porto-rotondo", "chiaramonti", "villanova-monteleone", "ozieri", "sorso", "sant-antonio-di-gallura", "luogosanto", "costa-paradiso", "loiri-porto-san-paolo", "olmedo", "porto-torres", "tula", "calangianus", "padria", "oschiri", "viddalba", "telti", "aggius"],
"imperia" => ["bordighera", "dolceacqua", "sanremo", "imperia", "ceriana", "ventimiglia", "ospedaletti", "taggia", "vasia", "camporosso", "cervo", "diano-marina", "castel-vittorio", "san-bartolomeo-al-mare", "apricale", "perinaldo", "vallecrosia", "soldano", "riva-ligure", "bajardo", "isolabona", "borgomaro", "seborga", "cipressa", "diano-arentino", "villa-faraldi", "chiusanico", "olivetta-san-michele", "montalto-carpasio", "vallebona", "san-biagio-della-cima", "badalucco", "diano-san-pietro", "pigna", "civezza", "pietrabruna", "pontedassio", "diano-castello", "pieve-di-teco", "armo", "dolcedo", "castellaro", "triora", "rezzo", "molini-di-triora", "costarainera", "pornassio", "cesio"],
"rieti" => ["fara-in-sabina", "fiamignano", "montebuono", "rieti", "montasola", "leonessa", "poggio-nativo", "tarano", "orvinio", "roccantica", "poggio-moiano", "torricella-in-sabina", "casaprota", "contigliano", "mompeo", "castelnuovo-di-farfa", "morro-reatino", "petrella-salto", "magliano-sabina", "poggio-mirteto", "monteleone-sabino", "montopoli-di-sabina", "poggio-catino", "rocca-sinibalda", "amatrice", "torri-in-sabina", "paganico-sabino", "toffia", "belmonte-in-sabina", "scandriglia", "configni", "collevecchio", "poggio-san-lorenzo", "forano", "cittaducale"],
"viterbo" => ["lubriano", "viterbo", "vetralla", "montalto-di-castro", "sutri", "grotte-di-castro", "ronciglione", "onano", "ischia-di-castro", "civitella-d-agliano", "tuscania", "bassano-in-teverina", "corchiano", "castiglione-in-teverina", "san-lorenzo-nuovo", "canepina", "soriano-nel-cimino", "tarquinia", "acquapendente", "caprarola", "gallese", "bomarzo", "barbarano-romano", "capranica", "bolsena", "fabrica-di-roma", "orte", "bassano-romano", "civita-castellana", "proceno", "canino", "valentano", "monterosi", "bagnoregio", "nepi", "montefiascone", "farnese", "marta"],
"terni" => ["montegabbione", "penna-in-teverina", "ficulle", "terni", "monteleone-d-orvieto", "orvieto", "acquasparta", "amelia", "arrone", "fabro", "avigliano-umbro", "montecchio", "giove", "san-venanzo", "parrano", "lugnano-in-teverina", "montecastrilli", "narni", "baschi", "castel-giorgio", "san-gemini", "castel-viscardo", "polino", "allerona", "stroncone", "calvi-dell-umbria", "montefranco", "guardea", "porano", "alviano", "otricoli", "ferentillo"],
"taranto" => ["martina-franca", "maruggio", "taranto", "manduria", "sava", "massafra", "san-pietro-in-bevagna", "torricella", "grottaglie", "ginosa", "lizzano", "avetrana", "leporano", "crispiano", "castellaneta", "campomarino", "laterza"],
"savona" => ["varazze", "sassello", "alassio", "loano", "calizzano", "arnasco", "pontinvrea", "urbe", "cengio", "finale-ligure", "plodio", "osiglia", "giusvalla", "cisano-sul-neva", "dego", "orco-feglino", "millesimo", "spotorno", "borghetto-santo-spirito", "toirano", "mioglia", "testico", "ceriale", "stella", "piana-crixia", "carcare", "noli", "roccavignale", "savona", "albenga", "andora", "albisola-superiore", "altare", "vado-ligure", "pietra-ligure", "tovo-san-giacomo", "bormida", "casanova-lerrone", "borgio-verezzi", "cairo-montenotte", "garlenda", "murialdo", "magliolo", "giustenice", "massimino", "laigueglia", "quiliano", "stellanello", "bardineto", "zuccarello", "rialto"],
"cuneo" => ["pezzolo-valle-uzzone", "cortemilia", "farigliano", "vicoforte", "peveragno", "dogliani", "carru", "montaldo-roero", "saliceto", "ceva", "mango", "roddino", "mombasiglio", "cuneo", "govone", "alba", "mondovi", "santo-stefano-roero", "alto", "viola", "monforte-d-alba", "cossano-belbo", "borgo-san-dalmazzo", "castellino-tanaro", "montaldo-di-mondovi", "bossolasco", "prunetto", "san-benedetto-belbo", "lesegno", "bene-vagienna", "frassino", "bra", "somano", "monesiglio", "roburent", "murazzano", "caramagna-piemonte", "limone-piemonte", "santo-stefano-belbo", "camerana", "sale-san-giovanni", "gorzegno", "boves", "lequio-tanaro", "clavesana", "monta", "priocca", "fossano", "cravanzana", "belvedere-langhe", "castiglione-tinella", "valloriate", "bagnasco", "niella-belbo", "beinette", "paroldo", "narzole", "sale-delle-langhe", "diano-d-alba", "sommariva-perno", "vignolo", "mombarcaro", "bosia", "monchiero", "igliano", "roascio", "salmour", "torre-mondovi", "sampeyre", "villanova-mondovi", "neive", "la-morra", "levice", "castelletto-stura", "perletto", "perlo", "rocca-ciglie", "priola", "corneliano-d-alba", "albaretto-della-torre", "rocchetta-belbo", "savigliano", "torre-bormida", "caraglio", "frabosa-sottana", "entracque", "verduno", "barbaresco", "bernezzo", "magliano-alpi", "busca", "frabosa-soprana", "montezemolo", "roccavione", "roddi", "cervasca", "chiusa-di-pesio", "neviglie", "feisoglio", "rocca-de-baldi", "castelnuovo-di-ceva", "villafalletto", "envie", "demonte", "cissone"],
"verbano-cusio-ossola" => ["verbania", "cannobio", "oggebbio", "baveno", "bee", "cannero-riviera", "belgirate", "arola", "craveggia", "ghiffa", "pieve-vergonte", "valle-cannobina", "pallanza", "stresa", "vanzone-con-san-carlo", "premeno", "quarna-sotto", "trarego-viggiona", "omegna", "vogogna", "santa-maria-maggiore", "domodossola", "varzo", "ornavasso", "gravellona-toce", "arizzano", "san-bernardino-verbano", "premosello-chiovenda", "vignone", "intragna", "masera", "mergozzo", "brovello-carpugnino", "cambiasca", "aurano", "gignese", "valstrona", "trontano", "nonio"],
"bologna" => ["grizzana-morandi", "bologna", "san-benedetto-val-di-sambro", "monzuno", "san-lazzaro-di-savena", "castiglione-dei-pepoli", "monte-san-pietro", "zola-predosa", "sasso-marconi", "castel-d-aiano", "imola", "minerbio", "monterenzio", "valsamoggia", "ozzano-dell-emilia", "alto-reno-terme", "san-pietro-in-casale", "loiano", "pianoro", "vergato", "marzabotto", "gaggio-montano", "camugnano", "castel-di-casio", "castel-san-pietro-terme"],
"siena" => ["buonconvento", "siena", "gaiole-in-chianti", "radicofani", "montalcino", "cetona", "trequanda", "sinalunga", "montepulciano", "castiglione-d-orcia", "san-gimignano", "chianciano-terme", "murlo", "pienza", "poggibonsi", "sovicille", "sarteano", "san-casciano-dei-bagni", "monteriggioni", "chiusi", "radda-in-chianti", "castelnuovo-berardenga", "san-quirico-d-orcia", "rapolano-terme", "asciano", "radicondoli", "torrita-di-siena", "casole-d-elsa", "castellina-in-chianti", "monticiano", "chiusdino", "colle-di-val-d-elsa", "monteroni-d-arbia"],
"udine" => ["san-giovanni-al-natisone", "san-giorgio-di-nogaro", "carlino", "lignano-sabbiadoro", "pradamano", "paluzza", "resia", "arta-terme", "premariacco", "udine", "campoformido", "majano", "moruzzo", "dignano", "castions-di-strada", "cassacco", "socchieve", "varmo", "artegna", "codroipo", "forgaria-nel-friuli", "san-daniele-del-friuli", "palazzolo-dello-stella", "tricesimo", "forni-di-sopra", "sutrio", "aiello-del-friuli", "rivignano-teor", "dogna", "latisana"],
"south-sardinia" => ["calasetta", "nuxis", "villasimius", "carloforte", "villasalto", "sant-anna-arresi", "iglesias", "arbus", "escolca", "senorbi", "tratalias", "castiadas", "villaspeciosa", "muravera", "san-nicolo-gerrei", "villaputzu", "sant-antioco", "san-vito", "mandas"],
"genoa" => ["vobbia", "genoa", "chiavari", "gorreto", "santa-margherita-ligure", "lavagna", "camogli", "cogoleto", "moneglia", "arenzano", "lumarzo", "sori", "santo-stefano-d-aveto", "recco", "zoagli", "san-colombano-certenoli", "rapallo", "leivi", "ne", "sestri-levante", "savignone", "pieve-ligure", "cogorno", "bargagli", "carasco", "cicagna", "rossiglione", "isola-del-cantone", "avegno", "casarza-ligure", "busalla", "mele", "davagna", "torriglia", "sant-olcese", "portofino", "bogliasco", "borzonasca", "tiglieto"],
"fermo" => ["montefalcone-appennino", "servigliano", "montefortino", "porto-san-giorgio", "amandola", "monterubbiano", "santa-vittoria-in-matenano", "montottone", "sant-elpidio-a-mare", "monsampietro-morico", "fermo", "pedaso", "montegranaro", "belmonte-piceno", "falerone", "altidona", "monte-rinaldo", "porto-sant-elpidio", "grottazzolina", "torre-san-patrizio", "francavilla-d-ete", "smerillo", "campofilone", "petritoli", "montelparo", "monte-san-pietrangeli", "montappone", "lapedona", "ponzano-di-fermo", "monteleone-di-fermo", "montegiorgio", "massa-fermana", "monte-giberto", "moresco", "ortezzano", "magliano-di-tenna", "monte-urano"],
"ascoli-piceno" => ["appignano-del-tronto", "san-benedetto-del-tronto", "montefiore-dell-aso", "ripatransone", "force", "offida", "carassai", "massignano", "montalto-delle-marche", "castignano", "monteprandone", "ascoli-piceno", "cupra-marittima", "comunanza", "roccafluvione", "montemonaco", "castorano", "grottammare", "rotella", "montedinove", "cossignano", "acquaviva-picena", "castel-di-lama", "monsampolo-del-tronto", "venarotta", "montegallo"],
"catania" => ["calatabiano", "biancavilla", "san-gregorio-di-catania", "valverde", "catania", "gravina-di-catania", "acireale", "trecastagni", "castiglione-di-sicilia", "caltagirone", "misterbianco", "santa-venerina", "giarre", "licodia-eubea", "aci-castello", "adrano", "aci-sant-antonio", "nicolosi", "mascalucia", "randazzo", "santa-maria-di-licodia", "vizzini", "aci-bonaccorsi", "camporotondo-etneo", "mirabella-imbaccari", "aci-catena", "pedara", "zafferana-etnea", "riposto", "grammichele", "belpasso", "viagrande", "san-giovanni-la-punta", "mascali", "san-michele-di-ganzaria", "ragalna", "militello-in-val-di-catania", "mineo", "san-pietro-clarenza", "motta-sant-anastasia", "tremestieri-etneo", "fiumefreddo-di-sicilia", "piedimonte-etneo", "scordia", "sant-agata-li-battiati", "san-cono", "milo", "linguaglossa", "bronte", "ramacca", "castel-di-judica", "sant-alfio", "maletto"],
"cagliari" => ["quartu-sant-elena", "cagliari", "pula", "sinnai", "sarroch", "selargius", "quartucciu", "maracalagonis", "elmas", "sestu"],
"verona" => ["caprino-veronese", "torri-del-benaco", "verona", "peschiera-del-garda", "lazise", "affi", "castelnuovo-del-garda", "oppeano", "san-martino-buon-albergo", "lavagno", "tregnago", "malcesine", "san-zeno-di-montagna", "garda", "valeggio-sul-mincio", "brenzone", "bardolino", "vigasio", "costermano-sul-garda", "cavaion-veronese", "sona", "san-pietro-in-cariano", "ferrara-di-monte-baldo", "pastrengo", "sorga", "sant-ambrogio-di-valpolicella", "zevio", "fumane", "rovere-veronese"],
"massa-carrara" => ["fivizzano", "aulla", "tresana", "montignoso", "licciana-nardi", "bagnone", "massa", "comano", "zeri", "casola-in-lunigiana", "villafranca-in-lunigiana", "pontremoli", "mulazzo", "fosdinovo", "filattiera", "podenzana", "carrara"],
"vicenza" => ["rosa", "fara-vicentino", "piovene-rocchette", "longare", "vicenza", "castelgomberto", "gallio", "lonigo", "gambugliano", "malo", "villaverla", "arzignano", "grisignano-di-zocco", "altavilla-vicentina", "arcugnano", "schio", "valbrenta", "roana", "montegalda", "sossano", "quinto-vicentino", "bassano-del-grappa"],
"naples" => ["naples", "capri", "ischia", "anacapri", "piano-di-sorrento", "castellammare-di-stabia", "portici", "pozzuoli", "procida", "qualiano", "giugliano-in-campania", "villaricca", "boscotrecase", "forio", "vico-equense", "massa-lubrense", "sorrento", "trecase"],
"florence" => ["florence", "fucecchio", "pelago", "greve-in-chianti", "reggello", "montaione", "san-casciano-in-val-di-pesa", "barberino-tavarnelle", "scandicci", "lastra-a-signa", "impruneta", "montespertoli", "scarperia-e-san-piero", "certaldo", "fiesole", "bagno-a-ripoli", "cerreto-guidi", "rignano-sull-arno", "montelupo-fiorentino", "borgo-san-lorenzo", "barberino-di-mugello", "empoli", "castelfiorentino", "vaglia", "vicchio", "gambassi-terme", "pontassieve", "dicomano", "sesto-fiorentino", "rufina", "vinci", "figline-e-incisa-valdarno", "firenzuola", "calenzano", "londa", "palazzuolo-sul-senio"],
"la-spezia" => ["carro", "vezzano-ligure", "lerici", "porto-venere", "sarzana", "ameglia", "levanto", "rocchetta-di-vara", "zignago", "riomaggiore", "carrodano", "la-spezia", "vernazza", "castelnuovo-magra", "beverino", "arcola", "follo", "ricco-del-golfo-di-spezia", "varese-ligure", "borghetto-di-vara", "monterosso-al-mare", "luni", "corniglia", "santo-stefano-di-magra"],
"nuoro" => ["lotzorai", "siniscola", "cardedu", "posada", "jerzu", "arzana", "torpe", "galtelli", "dorgali", "tertenia", "sindia", "nuoro", "orosei", "oliena", "desulo", "perdasdefogu"],
"novara" => ["castelletto-sopra-ticino", "orta-san-giulio", "briga-novarese", "vaprio-d-agogna", "comignago", "lesa", "meina", "massino-visconti", "bolzano-novarese", "varallo-pombia", "pella", "arona", "gozzano", "bellinzago-novarese", "cavallirio", "armeno", "invorio", "colazza", "divignano", "pisano", "grignasco", "pombia", "agrate-conturbia", "ghemme", "borgo-ticino", "ameno", "sizzano", "oleggio-castello", "nebbiuno", "pettenasco", "san-maurizio-d-opaglio"],
"alessandria" => ["sale", "felizzano", "sezzadio", "spigno-monferrato", "castelletto-d-orba", "mombello-monferrato", "casale-monferrato", "altavilla-monferrato", "pietra-marazzi", "alessandria", "borghetto-di-borbera", "bosco-marengo", "ponzone", "pareto", "ozzano-monferrato", "villadeati", "cantalupo-ligure", "gabiano", "cassano-spinola", "murisengo", "acqui-terme", "alfiano-natta", "carpeneto", "prasco", "orsara-bormida", "ponti", "denice", "rocca-grimalda", "strevi", "cartosio", "pasturana", "valenza", "odalengo-grande", "cavatore", "castelletto-d-erro", "novi-ligure", "bergamasco", "villamiroglio", "stazzano", "ovada", "bistagno", "solero", "francavilla-bisio", "gavi", "cremolino", "quattordio", "sarezzano", "borgo-san-martino", "san-salvatore-monferrato", "cerrina-monferrato", "melazzo", "sala-monferrato", "rosignano-monferrato", "fraconalto", "vignale-monferrato", "tortona", "masio", "cella-monte", "malvicino", "predosa", "ottiglio", "cassine", "camino", "serravalle-scrivia", "casalnoceto", "morano-sul-po", "pontestura", "molare", "terzo", "frassineto-po", "visone", "monleale", "fubine-monferrato", "arquata-scrivia", "cassinelle", "merana", "ponzano-monferrato", "morbello", "capriata-d-orba", "basaluzzo", "voltaggio", "volpedo", "montechiaro-d-acqui", "pozzolo-formigaro", "alice-bel-colle"],
"ravenna" => ["cervia", "ravenna", "brisighella", "faenza", "lugo", "bagnacavallo"],
"messina" => ["sinagra", "lipari", "taormina", "mistretta", "reitano", "castelmola", "gioiosa-marea", "sant-angelo-di-brolo", "capo-d-orlando", "mojo-alcantara", "venetico", "letojanni", "messina", "francavilla-di-sicilia", "terme-vigliatore", "acquedolci", "giardini-naxos", "caronia", "santo-stefano-di-camastra", "motta-d-affermo", "furci-siculo", "naso", "sant-agata-di-militello", "malfa", "graniti", "gaggi", "montagnareale", "santa-teresa-di-riva", "patti", "isola-filicudi", "san-teodoro"],
"brindisi" => ["francavilla-fontana", "ceglie-messapica", "ostuni", "san-pancrazio-salentino", "san-vito-dei-normanni", "fasano", "cisternino", "carovigno", "brindisi", "san-michele-salentino", "latiano", "san-pietro-vernotico", "torre-santa-susanna", "oria", "mesagne", "cellino-san-marco"],
"lecce" => ["corigliano-d-otranto", "ugento", "salve", "martignano", "gagliano-del-capo", "porto-cesareo", "specchia", "galatina", "san-cassiano", "taviano", "gallipoli", "giurdignano", "casarano", "carpignano-salentino", "patu", "morciano-di-leuca", "nardo", "nociglia", "cutrofiano", "lecce", "matino", "uggiano-la-chiesa", "tuglie", "presicce-acquarica", "san-cesario-di-lecce", "carmiano", "aradeo", "castrignano-del-capo", "santa-cesarea-terme", "cannole", "sannicola", "alezio", "melissano", "castrignano-de-greci", "calimera", "galatone", "diso", "lizzanello", "montesano-salentino", "cursi", "melendugno", "maglie", "minervino-di-lecce", "campi-salentina", "ruffano", "parabita", "alessano", "copertino", "spongano", "taurisano", "soleto", "collepasso", "monteroni-di-lecce", "otranto", "arnesano", "cavallino", "caprarica-di-lecce", "castri-di-lecce", "neviano", "martano", "supersano", "san-pietro-in-lama", "alliste", "veglie", "zollino", "miggiano", "poggiardo", "vernole", "sanarica", "leverano", "squinzano", "palmariggi", "novoli", "lequile", "scorrano", "castro", "tricase", "surbo", "ortelle", "melpignano", "giuggianello", "sogliano-cavour"],
"pesaro-and-urbino" => ["terre-roveresche", "pesaro", "sant-angelo-in-vado", "peglio", "mondavio", "montefelcino", "fratte-rosa", "san-costanzo", "sassocorvaro-auditore", "urbino", "cagli", "frontone", "mondolfo", "urbania", "fossombrone", "montelabbate", "san-lorenzo-in-campo", "colli-al-metauro", "fano", "borgo-pace", "macerata-feltria", "cartoceto", "pergola", "apecchio", "fermignano", "sant-ippolito", "monte-cerignone", "piobbico", "petriano", "acqualagna", "cantiano", "monte-porzio", "mercatello-sul-metauro", "mombaroccio", "mercatino-conca", "serra-sant-abbondio", "gabicce-mare"],
"sondrio" => ["bormio", "valdisotto", "berbenno-di-valtellina", "mantello", "livigno", "valdidentro", "teglio", "chiesa-in-valmalenco", "villa-di-tirano", "novate-mezzola", "morbegno", "tresivio", "dubino", "sondrio", "albosaggia"],
"livorno" => ["portoferraio", "capoliveri", "san-vincenzo", "campiglia-marittima", "castagneto-carducci", "livorno", "rio", "rosignano-marittimo", "cecina", "marciana", "marciana-marina", "campo-nell-elba", "suvereto", "collesalvetti", "bibbona", "piombino", "porto-azzurro", "sassetta"],
"arezzo" => ["bucine", "talla", "arezzo", "cortona", "terranuova-bracciolini", "monterchi", "cavriglia", "sansepolcro", "foiano-della-chiana", "castelfranco-piandisco", "montevarchi", "monte-san-savino", "bibbiena", "pieve-santo-stefano", "loro-ciuffenna", "castiglion-fibocchi", "lucignano", "castiglion-fiorentino", "anghiari", "castel-focognano", "laterina-pergine-valdarno", "caprese-michelangelo", "poppi", "sestino", "pratovecchio-stia", "civitella-in-val-di-chiana", "ortignano-raggiolo", "castel-san-niccolo", "subbiano", "badia-tedalda", "chiusi-della-verna", "marciano-della-chiana", "san-giovanni-valdarno"],
"ancona" => ["fabriano", "sirolo", "serra-san-quirico", "cupramontana", "ancona", "osimo", "corinaldo", "numana", "arcevia", "castelfidardo", "chiaravalle", "filottrano", "rosora", "sassoferrato", "santa-maria-nuova", "iesi", "senigallia", "genga", "montecarotto", "san-marcello", "mergo", "cerreto-d-esi", "serra-de-conti", "loreto", "monte-roberto", "polverigi", "camerata-picena", "belvedere-ostrense", "offagna", "maiolati-spontini", "castelleone-di-suasa", "ostra", "castelbellino", "ostra-vetere", "castelplanio", "morro-d-alba"],
"frosinone" => ["patrica", "san-donato-val-di-comino", "posta-fibreno", "arce", "ceprano", "veroli", "amaseno", "piglio", "cassino", "arpino", "pescosolido", "pico", "alvito", "isola-del-liri", "roccasecca", "ceccano", "atina", "esperia", "san-giovanni-incarico", "sora", "anagni", "casalvieri", "alatri", "monte-san-giovanni-campano", "fontana-liri", "frosinone", "colfelice", "vicalvi", "picinisco", "santopadre", "morolo", "castelliri", "vallerotonda", "pontecorvo", "casalattico", "campoli-appennino", "boville-ernica", "colle-san-magno", "aquino", "castrocielo", "torrice", "guarcino", "broccostella", "gallinaro", "sant-elia-fiumerapido", "cervaro", "ripi", "sant-ambrogio-sul-garigliano", "pignataro-interamna", "san-vittore-del-lazio", "villa-latina", "fontechiari", "rocca-d-arce", "trivigliano", "falvaterra", "vallecorsa", "sant-andrea-del-garigliano", "ferentino", "settefrati", "vico-nel-lazio", "villa-santo-stefano", "paliano"],
"grosseto" => ["capalbio", "saturnia", "civitella-paganico", "semproniano", "roccastrada", "arcidosso", "castiglione-della-pescaia", "scansano", "grosseto", "magliano-in-toscana", "santa-fiora", "scarlino", "follonica", "monte-argentario", "manciano", "cinigiano", "seggiano", "massa-marittima", "orbetello", "castel-del-piano", "campagnatico", "pitigliano", "roccalbegna", "gavorrano", "monterotondo-marittimo", "sorano", "montieri"],
"teramo" => ["castiglione-messer-raimondo", "atri", "pineto", "notaresco", "tortoreto", "sant-omero", "silvi", "isola-del-gran-sasso-d-italia", "cellino-attanasio", "roseto-degli-abruzzi", "mosciano-sant-angelo", "civitella-del-tronto", "cermignano", "alba-adriatica", "montefino", "giulianova", "arsita", "castilenti", "controguerra", "martinsicuro", "corropoli", "tossicia", "bellante", "canzano", "castel-castagna", "morro-d-oro", "valle-castellana", "teramo", "campli", "castelli", "colonnella", "colledara"],
"rome" => ["rome", "guidonia-montecelio", "marino", "campagnano-di-roma", "morlupo", "castelnuovo-di-porto", "trevignano-romano", "gallicano-nel-lazio", "zagarolo", "mazzano-romano", "nerola", "nettuno", "ardea", "santa-marinella", "tivoli", "palestrina", "sacrofano", "rocca-di-papa", "pomezia", "lariano", "anzio", "nemi", "civitavecchia", "formello", "moricone", "filacciano", "bracciano", "subiaco", "riano", "nazzano", "ariccia", "anguillara-sabazia", "frascati", "fiano-romano", "genazzano", "ciampino", "velletri", "genzano-di-roma", "valmontone", "ponzano-romano", "cerreto-laziale", "fiumicino", "grottaferrata", "monterotondo", "segni", "manziana", "fonte-nuova", "artena"],
"pescara" => ["cepagatti", "rosciano", "san-valentino-in-abruzzo-citeriore", "montebello-di-bertona", "caramanico-terme", "corvara", "citta-sant-angelo", "bolognano", "spoltore", "tocco-da-casauria", "vicoli", "scafa", "penne", "alanno", "castiglione-a-casauria", "montesilvano", "salle", "torre-de-passeri", "loreto-aprutino", "brittoli", "cugnoli", "pescara", "civitella-casanova", "collecorvino", "roccamorice", "farindola", "pietranico", "pianella", "abbateggio", "lettomanoppello", "turrivalignani", "manoppello", "moscufo", "picciano", "villa-celiera", "popoli", "elice", "sant-eufemia-a-maiella", "nocciano"],
"varese" => ["sesto-calende", "carnago", "varese", "mesenzana", "maccagno-con-pino-e-veddasca", "lavena-ponte-tresa", "vergiate", "induno-olona", "porto-valtravaglia", "buguggiate", "busto-arsizio", "galliate-lombardo", "angera", "besozzo", "laveno-mombello", "luino", "castello-cabiaglio", "viggiu", "germignaga", "somma-lombardo", "ternate", "brezzo-di-bedero", "daverio", "ranco", "albizzate"],
"oristano" => ["magomadas", "scano-di-montiferro", "bosa", "flussio", "tresnuraghes", "ghilarza", "uras", "santu-lussurgiu", "villa-verde", "cuglieri", "usellus", "suni", "mogoro", "cabras", "seneghe", "palmas-arborea"],
"pisa" => ["casciana-terme-lari", "volterra", "calci", "chianni", "guardistallo", "crespina-lorenzana", "vecchiano", "castellina-marittima", "montecatini-val-di-cecina", "pomarance", "montescudaio", "pisa", "peccioli", "san-giuliano-terme", "palaia", "san-miniato", "calcinaia", "lajatico", "terricciola", "ponsacco", "fauglia", "castelnuovo-di-val-di-cecina", "monteverdi-marittimo", "riparbella", "montopoli-in-val-d-arno", "pontedera", "cascina", "buti", "capannoli", "bientina", "santa-luce", "casale-marittimo", "santa-maria-a-monte", "orciano-pisano", "santa-croce-sull-arno", "castelfranco-di-sotto"],
"cosenza" => ["amantea", "mormanno", "belvedere-marittimo", "praia-a-mare", "scalea", "cetraro", "san-nicola-arcella", "longobardi", "diamante", "falconara-albanese", "sangineto", "castrovillari", "rocca-imperiale", "maiera", "guardia-piemontese", "acquappesa", "belmonte-calabro", "santa-maria-del-cedro", "fiumefreddo-bruzio", "domanico", "san-lucido", "tortora", "frascineto", "san-sosti", "papasidero", "grisolia", "bonifati", "mandatoriccio", "santa-domenica-talao", "carolei", "buonvicino", "cassano-allo-ionio", "oriolo", "aiello-calabro", "spezzano-albanese", "orsomarso", "cosenza", "mangone", "francavilla-marittima", "montegiordano"],
"l-aquila" => ["raiano", "pizzoli", "fagnano-alto", "capestrano", "castel-di-ieri", "navelli", "tornimparte", "castelvecchio-subequo", "pratola-peligna", "sulmona", "gagliano-aterno", "montereale", "san-demetrio-ne-vestini", "tione-degli-abruzzi", "san-pio-delle-camere", "campo-di-giove", "pescocostanzo", "cappadocia", "pacentro", "calascio", "barete", "capitignano", "castel-del-monte", "cocullo", "canistro", "roccacasale", "caporciano", "l-aquila", "barisciano", "ofena", "sant-eusanio-forconese", "acciano", "fontecchio", "ortona-dei-marsi", "prata-d-ansidonia", "ovindoli", "rocca-di-cambio", "secinaro", "pettorano-sul-gizio", "molina-aterno", "scontrone", "aielli", "carapelle-calvisio", "collepietro", "magliano-de-marsi"],
"palermo" => ["palermo", "polizzi-generosa", "giuliana", "bagheria", "ciminna", "chiusa-sclafani", "monreale", "cefalu", "bisacquino", "altavilla-milicia", "trabia", "cinisi", "santa-flavia", "partinico", "petralia-soprana", "balestrate", "trappeto", "carini", "belmonte-mezzagno", "termini-imerese", "torretta", "palazzo-adriano", "isola-delle-femmine", "campofelice-di-roccella", "vicari", "altofonte", "montelepre", "ustica", "collesano", "caccamo", "terrasini", "corleone", "baucina", "pollina", "geraci-siculo", "ficarazzi", "gangi", "san-giuseppe-jato", "misilmeri", "alimena", "gratteri", "casteldaccia", "borgetto", "san-cipirello", "aliminusa", "contessa-entellina"],
"venice" => ["jesolo", "marcon", "stra", "venice", "chioggia", "annone-veneto", "quarto-d-altino", "caorle", "gruaro", "portogruaro", "san-michele-al-tagliamento", "noale", "noventa-di-piave", "bibione", "cinto-caomaggiore", "mira", "cavallino-treporti", "musile-di-piave", "san-dona-di-piave", "pramaggiore", "fosso", "eraclea", "salzano"],
"turin" => ["sauze-d-oulx", "moncalieri", "pecetto-torinese", "pont-canavese", "sauze-di-cesana", "rueglio", "castiglione-torinese", "san-gillio", "turin", "venaria-reale", "ivrea", "ronco-canavese", "bussoleno", "pino-torinese", "sciolze", "grugliasco", "val-di-chy", "cuorgne", "prascorsano", "canischio", "givoletto", "san-colombano-belmonte", "candia-canavese", "sparone", "beinasco", "feletto", "villar-focchiardo", "issiglio", "san-giorio-di-susa", "almese", "san-secondo-di-pinerolo", "cavour", "torre-pellice", "perosa-argentina", "baldissero-canavese", "san-mauro-torinese", "villarbasse", "chiusa-di-san-michele", "san-benigno-canavese", "valchiusa", "salassa", "fiano", "chieri", "ozegna", "nichelino", "cavagnolo", "ceresole-reale", "rivara", "pianezza", "druento", "rocca-canavese", "pinerolo", "castellamonte", "rivarolo-canavese", "forno-canavese", "settimo-torinese", "san-martino-canavese", "pragelato", "chiesanuova", "arignano", "carignano", "baldissero-torinese", "marentino", "avigliana", "cesana-torinese", "caselette", "mercenasco", "burolo", "colleretto-castelnuovo", "perosa-canavese", "lanzo-torinese", "chiaverano", "pessinetto", "andrate", "rubiana", "cantoira", "alpette", "orbassano", "brozolo", "cumiana", "buriasco", "brandizzo", "aglie", "bardonecchia", "mezzenile", "valperga", "leini", "brosso", "verolengo", "locana", "traversella", "san-raffaele-cimena", "chianocco", "cirie", "bruzolo", "vistrorio", "rivoli", "villar-perosa", "castelnuovo-nigra", "verrua-savoia", "villafranca-piemonte"],
"macerata" => ["sant-angelo-in-pontano", "recanati", "san-severino-marche", "civitanova-marche", "gualdo", "monte-san-martino", "porto-recanati", "montelupone", "penna-san-giovanni", "monte-san-giusto", "san-ginesio", "gagliole", "tolentino", "cingoli", "camporotondo-di-fiastrone", "treia", "potenza-picena", "serrapetrona", "montecosaro", "montefano", "montecassiano", "macerata", "castelraimondo", "sarnano", "mogliano", "fiuminata", "muccia", "apiro", "appignano", "camerino", "urbisaglia", "sefro", "loro-piceno", "ripe-san-ginesio", "corridonia", "monte-cavallo", "pollenza", "esanatoglia", "fiastra", "serravalle-di-chienti", "morrovalle", "pieve-torina", "colmurano", "matelica"],
"pistoia" => ["marliana", "san-marcello-piteglio", "serravalle-pistoiese", "monsummano-terme", "lamporecchio", "massa-e-cozzile", "abetone-cutigliano", "ponte-buggianese", "pescia", "pistoia", "montecatini-terme", "larciano", "sambuca-pistoiese", "quarrata", "buggiano", "chiesina-uzzanese", "uzzano", "pieve-a-nievole", "montale"],
"chieti" => ["lanciano", "roccascalegna", "scerni", "torrebruna", "monteodorisio", "furci", "san-salvo", "archi", "atessa", "casoli", "torino-di-sangro", "ortona", "fraine", "villalfonsina", "miglianico", "gissi", "chieti", "ripa-teatina", "rapino", "guilmi", "roccamontepiano", "san-vito-chietino", "celenza-sul-trigno", "fara-san-martino", "casalbordino", "casalanguida", "francavilla-al-mare", "san-giovanni-teatino", "bucchianico", "pennapiedimonte", "giuliano-teatino", "tufillo", "pollutri", "tollo", "vasto", "carpineto-sinello", "san-buono", "palmoli", "carunchio", "crecchio", "palena", "rocca-san-giovanni", "castiglione-messer-marino", "roccaspinalveti", "guardiagrele", "palombaro", "tornareccio", "fresagrandinaria", "fossacesia", "borrello", "cupello", "paglieta", "treglio", "vacri", "perano", "arielli", "casalincontrada", "schiavi-di-abruzzo", "pretoro", "colledimezzo", "montazzoli", "dogliola", "rosello", "roio-del-sangro", "montenerodomo", "villamagna", "ari"],
"bari" => ["bari", "noicattaro", "conversano", "monopoli", "mola-di-bari", "bitonto", "gioia-del-colle", "castellana-grotte", "locorotondo", "noci", "casamassima", "grumo-appula", "putignano", "polignano-a-mare", "acquaviva-delle-fonti", "alberobello", "gravina-in-puglia", "corato", "bitritto", "cassano-delle-murge", "bitetto", "adelfia", "triggiano", "valenzano", "rutigliano"],
"piacenza" => ["rivergaro", "piacenza", "borgonovo-val-tidone", "podenzano", "bettola", "gropparello", "castel-san-giovanni", "vernasca", "pianello-val-tidone", "gazzola", "castell-arquato", "vigolzone", "agazzano", "cortemaggiore"],
"latina" => ["formia", "san-felice-circeo", "priverno", "ponza", "latina", "sermoneta", "sabaudia", "gaeta", "terracina", "ventotene", "prossedi", "sperlonga", "fondi"],
"potenza" => ["paterno", "maratea", "rivello", "pignola", "san-chirico-raparo", "sasso-di-castalda", "gallicchio", "spinoso", "marsicovetere"],
"ferrara" => ["tresignana", "ferrara", "codigoro", "portomaggiore", "comacchio", "cento", "argenta", "jolanda-di-savoia", "fiscaglia", "copparo", "goro", "voghiera", "riva-del-po", "bondeno"],
"treviso" => ["montebelluna", "vedelago", "villorba", "conegliano", "gorgo-al-monticano", "asolo", "preganziol", "treviso", "vazzola", "castelfranco-veneto", "ponte-di-piave", "roncade", "oderzo", "susegana", "segusino", "vittorio-veneto", "san-biagio-di-callalta", "istrana", "cimadolmo", "possagno", "mogliano-veneto", "riese-pio-x", "cappella-maggiore", "cessalto", "paese", "codogne", "casale-sul-sile", "salgareda", "pederobba", "povegliano", "san-vendemiano", "gaiarine", "portobuffole", "spresiano", "morgano", "tarzo", "meduna-di-livenza", "carbonera", "silea", "santa-lucia-di-piave", "ponzano-veneto", "breda-di-piave", "cison-di-valmarino", "borso-del-grappa", "revine-lago", "caerano-di-san-marco", "monastier-di-treviso", "motta-di-livenza", "volpago-del-montello", "ormelle", "castelcucco", "cornuda", "orsago", "chiarano", "godega-di-sant-urbano", "valdobbiadene", "farra-di-soligo", "zenson-di-piave", "monfumo", "maserada-sul-piave", "san-fior"],
"forli-cesena" => ["forli", "cesenatico", "castrocaro-terme-e-terra-del-sole", "montiano", "borghi", "meldola", "tredozio", "roncofreddo", "bertinoro", "galeata", "cesena"],
"campobasso" => ["tavenna", "mafalda", "montenero-di-bisaccia", "castelbottaccio", "larino", "acquaviva-collecroce", "roccavivara", "petacciato", "guglionesi", "san-massimo", "trivento", "palata", "lucito", "castropignano", "castelmauro", "bojano", "civitacampomarano", "san-felice-del-molise", "baranello", "fossalto", "vinchiaturo", "guardialfiera", "portocannone", "termoli", "montemitro", "san-polo-matese", "campobasso", "limosano", "duronia", "sepino", "torella-del-sannio", "guardiaregia", "campochiaro"],
"asti" => ["bubbio", "fontanile", "moncalvo", "asti", "nizza-monferrato", "cisterna-d-asti", "castelnuovo-don-bosco", "tigliole", "castagnole-monferrato", "monastero-bormida", "montabone", "portacomaro", "calamandrana", "costigliole-d-asti", "vesime", "montaldo-scarampi", "refrancore", "montemagno", "robella", "viarigi", "castelnuovo-calcea", "calliano", "incisa-scapaccino", "roccaverano", "isola-d-asti", "vaglio-serra", "cortanze", "castagnole-delle-lanze", "montegrosso-d-asti", "san-giorgio-scarampi", "tonco", "castel-rocchero", "cocconato", "moncucco-torinese", "serole", "sessame", "mombercelli", "frinco", "montiglio-monferrato", "castelnuovo-belbo", "san-damiano-d-asti", "antignano", "canelli", "scurzolengo", "casorzo", "rocchetta-palafea", "mombaruzzo", "san-marzano-oliveto", "castell-alfero", "agliano-terme", "rocchetta-tanaro", "cassinasco", "monale", "cessole", "penango", "castel-boglione", "camerano-casasco", "corsione", "calosso", "buttigliera-d-asti", "montechiaro-d-asti", "roatto", "cunico", "grazzano-badoglio", "vigliano-d-asti", "rocca-d-arazzo", "villanova-d-asti", "bruno", "villafranca-d-asti", "pino-d-asti", "mombaldone", "cortiglione", "loazzolo", "celle-enomondo", "montafia", "castello-di-annone", "castelletto-molina", "san-martino-alfieri", "valfenera", "cortandone", "settime", "mongardino", "cinaglio", "villa-san-secondo", "belveglio", "cantarana", "grana"],
"pordenone" => ["vito-d-asio", "pordenone", "barcis", "maniago", "caneva", "prata-di-pordenone", "travesio", "aviano", "claut", "spilimbergo", "castelnovo-del-friuli", "azzano-decimo", "cordovado", "cordenons", "pravisdomini", "frisanco", "valvasone-arzene", "montereale-valcellina", "vajont", "vivaro", "fiume-veneto", "fontanafredda", "porcia", "cimolais", "san-vito-al-tagliamento", "zoppola", "pasiano-di-pordenone", "sequals", "tramonti-di-sotto", "san-quirino", "sesto-al-reghena", "andreis", "morsano-al-tagliamento", "pinzano-al-tagliamento", "arba"],
"mantua" => ["castiglione-delle-stiviere", "marcaria", "ostiglia", "goito", "ponti-sul-mincio", "medole", "castel-goffredo", "monzambano", "rodigo", "castel-d-ario", "curtatone", "marmirolo", "roncoferraro", "casaloldo", "volta-mantovana", "cavriana", "bozzolo", "piubega", "viadana", "mantua", "guidizzolo", "solferino", "gonzaga"],
"ragusa" => ["giarratana", "modica", "scicli", "vittoria", "santa-croce-camerina", "ragusa", "chiaramonte-gulfi", "comiso", "ispica", "pozzallo", "monterosso-almo", "acate"],
"belluno" => ["cortina-d-ampezzo", "taibon-agordino", "belluno", "borgo-valbelluna", "auronzo-di-cadore", "san-gregorio-nelle-alpi", "arsie", "santa-giustina", "vallada-agordina", "perarolo-di-cadore", "val-di-zoldo", "feltre", "selva-di-cadore"],
"parma" => ["borgo-val-di-taro", "bardi", "monchio-delle-corti", "salsomaggiore-terme", "torrile", "polesine-zibello", "montechiarugolo", "fidenza", "compiano"],
"foggia" => ["rodi-garganico", "san-marco-la-catola", "lesina", "alberona", "vico-del-gargano", "monte-sant-angelo", "foggia", "chieuti", "carpino", "ischitella", "lucera"],
"vibo-valentia" => ["tropea", "ricadi", "spilinga", "briatico", "mileto", "zambrone", "pizzo", "drapia", "vibo-valentia", "nicotera", "parghelia", "joppolo", "jonadi"],
"aoste" => ["avise", "torgnon", "gressoney-saint-jean", "aosta", "quart", "la-salle", "aymavilles", "pila", "verrayes", "antey-saint-andre", "pre-saint-didier", "gignod", "saint-pierre", "valtournenche", "doues", "courmayeur", "cogne", "morgex"],
"agrigento" => ["cianciana", "agrigento", "bivona", "cattolica-eraclea", "sciacca", "alessandria-della-rocca", "sambuca-di-sicilia", "burgio", "santa-elisabetta", "naro", "realmonte", "palma-di-montechiaro", "san-biagio-platani", "aragona", "campobello-di-licata", "menfi", "ribera", "montallegro", "racalmuto", "raffadali", "licata"],
"matera" => ["matera", "pisticci", "grassano", "tricarico", "pomarico", "san-mauro-forte", "colobraro", "ferrandina", "bernalda"],
"padua" => ["due-carrare", "teolo", "vigonza", "rubano", "padua", "ponte-san-nicolo", "limena", "campodarsego", "saonara", "albignasego", "rovolon", "vescovana", "abano-terme", "brugine", "montegrotto-terme", "pontelongo", "sant-angelo-di-piove-di-sacco", "saccolongo", "arzergrande", "massanzago", "piombino-dese"],
"modena" => ["pavullo-nel-frignano", "castelvetro-di-modena", "modena", "san-prospero", "pievepelago", "fiumalbo", "bomporto", "novi-di-modena", "lama-mocogno", "fanano", "nonantola", "zocca", "montecreto"],
"prato" => ["carmignano", "prato", "montemurlo", "vaiano", "vernio"],
"enna" => ["enna", "piazza-armerina", "centuripe", "nicosia", "leonforte", "calascibetta", "cerami", "agira"],
"trieste" => ["trieste", "duino-aurisina", "muggia"],
"monza-and-brianza" => ["vimercate", "seregno", "cornate-d-adda", "monza", "arcore", "carate-brianza", "lazzate", "desio", "bernareggio", "lentate-sul-seveso", "brugherio", "cesano-maderno", "agrate-brianza", "verano-brianza", "carnate", "burago-di-molgora", "seveso", "briosco", "barlassina", "triuggio"],
"rovigo" => ["rosolina", "lendinara", "porto-viro", "bosaro", "ceregnano", "crespino", "adria", "rovigo", "ficarolo", "castelguglielmo"],
"avellino" => ["bisaccia", "chiusano-di-san-domenico", "andretta", "casalbore", "lacedonia", "altavilla-irpina", "montoro"],
"caltanissetta" => ["caltanissetta", "niscemi", "gela", "santa-caterina-villarmosa", "butera", "mazzarino", "riesi"],
"bolzano" => ["ritten", "montan", "bolzano", "molten", "urtijei", "selva", "vahrn", "bressanone-brixen", "naturns", "eppan-an-der-weinstrasse"],
"pavia" => ["mede", "godiasco", "varzi", "castana", "codevilla", "voghera", "giussago", "stradella", "bagnaria", "pinarolo-po", "colli-verdi", "vigevano", "pieve-porto-morone", "ponte-nizza", "brallo-di-pregola", "miradolo-terme", "bressana-bottarone", "san-zenone-al-po", "lomello"],
"reggio-emilia" => ["gattatico", "scandiano", "toano", "quattro-castella", "montecchio-emilia", "reggio-emilia"],
"barletta-andria-trani" => ["andria", "barletta", "trani", "minervino-murge", "bisceglie", "canosa-di-puglia"],
"caserta" => ["caserta", "sparanise", "santa-maria-capua-vetere", "rocca-d-evandro", "capua", "ciorlano", "san-pietro-infine", "tora-e-piccilli"],
"catanzaro" => ["martirano-lombardo", "gizzeria", "falerna", "amato", "maida", "badolato", "nocera-terinese", "lamezia-terme", "torre-di-ruggiero", "san-mango-d-aquino"],
"biella" => ["gaglianico", "masserano", "pray", "biella", "sandigliano", "curino", "vigliano-biellese"],
"lodi" => ["lodi", "boffalora-d-adda", "orio-litta", "sant-angelo-lodigiano", "turano-lodigiano"],
"benevento" => ["sant-angelo-a-cupolo", "paduli", "fragneto-monforte", "sant-agata-de-goti", "pesco-sannita", "melizzano", "baselice"],
"reggio-calabria" => ["gioia-tauro", "palizzi", "scilla", "polistena", "galatro"],
"gorizia" => ["grado", "farra-d-isonzo", "gorizia"],
"cremona" => ["spino-d-adda", "crema", "cremona", "pieve-d-olmi", "solarolo-rainerio", "acquanegra-cremonese", "casalmaggiore"],
"crotone" => ["isola-di-capo-rizzuto", "strongoli", "cutro"],
"republic-of-san-marino" => ["fiorentino-di-repubblica-di-san-marino"]
];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for API
    $postData = [
        "Province" => $_POST["Province"] ?? "",
        "City" => $_POST["City"] ?? "",
        "property_quality" => intval($_POST["property_quality"] ?? 0),
        "rooms" => intval($_POST["rooms"] ?? 0),
        "living_area" => floatval($_POST["living_area"] ?? 0),
        "bathrooms" => intval($_POST["bathrooms"] ?? 0),
        "garden_sqm" => isset($_POST["garden"]) ? floatval($_POST["garden_sqm"] ?? 0) : 0,
        "terrace_sqm" => isset($_POST["terrace"]) ? floatval($_POST["terrace_sqm"] ?? 0) : 0,
        "land_area" => isset($_POST["land"]) ? floatval($_POST["land_area"] ?? 0) : 0,
        "distance_from_airport" => floatval($_POST["distance_from_airport"] ?? 0),
        "Skiresort_distance" => floatval($_POST["Skiresort_distance"] ?? 0),
        "terrace" => isset($_POST["terrace"]) ? 1 : 0,
        "garden" => isset($_POST["garden"]) ? 1 : 0,
        "pool" => isset($_POST["pool"]) ? 1 : 0,
        "car_box" => isset($_POST["car_box"]) ? 1 : 0,
        "land" => isset($_POST["land"]) ? 1 : 0,
        "property_type" => intval($_POST["property_type"] ?? 0)
    ];

    // API endpoint URL
    $apiUrl = "http://api:8000/predict"; // Change to your API URL

    // Initialize cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    // Execute and get response
    $apiResponse = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $result = json_decode($apiResponse, true);
        if ($result !== null && isset($result['predicted_price'])) {
            $predictedPrice = number_format($result['predicted_price'], 2, '.', ',');
        }
    } else {
        $error = "Error: Unable to get a valid response from the API.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Real Estate Price Estimator</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            /* Add background image */
            background-image: url("la-so-vk4vjTNVrTg-unsplash.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 500px;
            margin: 50px auto;
            /* Add a little transparency if you want */
            box-shadow: 0 4px 24px rgba(0,0,0,0.18);
        }
        .hidden { display: none; }
        label { display: block; margin-top: 10px; }
    </style>
    <script>
        function toggleField(checkboxId, fieldId) {
            const checkbox = document.getElementById(checkboxId);
            const field = document.getElementById(fieldId);
            field.style.display = checkbox.checked ? "block" : "none";
        }

        // dynamically filter cities by province
        function updateCities() {
            const province = document.getElementById("provinceSelect").value;
            const allCities = JSON.parse(document.getElementById("citiesData").textContent);

            const citySelect = document.getElementById("citySelect");
            citySelect.innerHTML = "";

            if (province && allCities[province]) {
                allCities[province].forEach(city => {
                    let opt = document.createElement("option");
                    opt.value = city;
                    opt.textContent = city;
                    citySelect.appendChild(opt);
                });
            }
        }
    </script>
</head>
<body>

    <!-- JSON data for JS -->
    <script id="citiesData" type="application/json">
        <?= json_encode($provinces); ?>
    </script>

    <form method="POST">
        <h2>Enter Property Details</h2>

        <!-- Property Type -->
        <label>Property Type:
            <select name="property_type" required default="">
                <option value="" disabled selected>-- Select Property Type --</option>
                <option value="1">Villa</option>
                <option value="0">House</option>
                <option value="2">Apartment</option>
                <option value="3">Commercial</option>
                <option value="4">Land</option>
                <option value="5">Penthouse</option>
                <option value="6">Farm</option>
                <option value="7">Others</option>
            </select>
        </label>

        <!-- Property Quality -->
        <label>Property Quality:
            <select name="property_quality" required default="">
                <option value="" disabled selected>-- Select Property Quality --</option>
                <option value="0">Restored</option>
                <option value="1">New</option>
                <option value="2">Partially Restored</option>
                <option value="3">To Be Restored</option>
                <option value="4">N/A</option>
            </select>
        </label>

        <label>Rooms:
            <input type="number" name="rooms" required max="15">
        </label>

        <label>Living Area (sqm):
            <input type="number" name="living_area" required max="1000">
        </label>

        <label>Bathrooms:
            <input type="number" name="bathrooms" required max="10" min="1">
        </label>

        <label>Garden:
            <input type="checkbox" id="gardenChk" name="garden" value="yes" onclick="toggleField('gardenChk','gardenField')">
        </label>
        <div id="gardenField" class="hidden">
            Garden sqm: <input type="number" name="garden_sqm" max="5000">
        </div>

        <label>Terrace:
            <input type="checkbox" id="terraceChk" name="terrace" value="yes" onclick="toggleField('terraceChk','terraceField')">
        </label>
        <div id="terraceField" class="hidden">
            Terrace sqm: <input type="number" name="terrace_sqm" max="500">
        </div>

        <label>Land:
            <input type="checkbox" id="landChk" name="land" value="yes" onclick="toggleField('landChk','landField')">
        </label>
        <div id="landField" class="hidden">
            Land sqm: <input type="number" name="land_area" max="500000">
        </div>

        <label>Distance from Airport (km):
            <input type="number" name="distance_from_airport">
        </label>

        <label>Ski Resort Distance (km):
            <input type="number" name="Skiresort_distance">
        </label>

        <label>Pool:
            <input type="checkbox" name="pool" value="yes">
        </label>

        <label>Car Box:
            <input type="checkbox" name="car_box" value="yes">
        </label>

        <!-- Province Select -->
        <label>Province:
            <select name="Province" id="provinceSelect" onchange="updateCities()" required>
                <option value="" disabled selected>-- Select Province --</option>
                <?php foreach (array_keys($provinces) as $prov): ?>
                    <option value="<?= $prov ?>"><?= $prov ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <!-- City Select -->
        <label>City:
            <select name="City" id="citySelect" required>
                <option value="" disabled selected>-- Select City --</option>
            </select>
        </label>

        <br><br>
        <button type="submit">Submit</button>
    </form>
    <?php if (isset($predictedPrice) || isset($error)): ?>
        <div class="result-box" style="background: white; padding: 20px; border-radius: 8px; width: 500px; margin: 20px auto; box-shadow: 0 4px 24px rgba(0,0,0,0.18); text-align: center;">
            <?php if ($predictedPrice): ?>
                <span style="font-size: 1.3em; color: #2e7d32;">Predicted Price: €<?= $predictedPrice ?></span>
            <?php elseif ($error): ?>
                <span style="color: #c62828;"><?= $error ?></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>
