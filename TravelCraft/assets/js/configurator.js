/*
  Reine JS-Datei: keine <script>-Tags, kein PHP. 
  Erwartet, dass configurator.php vorher diese Variablen setzt:
  const cityData = ...; const allDestinations = ...;
*/
document.addEventListener('DOMContentLoaded', () => {

    // --- 1. Konfigurations-Mapping ---
    const konfiguration = {
        extras: {
            "hotel": ["All-Inclusive","Pool", "Spa", "Frühstück", "Mittagessen", "Massage",
                 "Abendessen", "A la Carte", "Bar", "Wasserkocher", "Babybett",  
                  "Zimmerservice", "Meerblick", "Sichtschutz","Safe", "Jacuzzi", 
                  "Kinderbetreuung", "Bügelservice", "Familienzimmer", 
                  "Early-Check-In", "Late-Check-Out"],
            "ferienwohnung": ["Küche", "Waschmaschine", "Trockner", "Staubsauger", "Parkplatz",
                 "Alarmanlage", "Kamera", "Wasserkocher", "Kaffeemaschine",
                  "Fernseher", "Fön", "Smart-TV","Bettwäsche", "Rauchen erlaubt",
                  "eigenständiger Check-In","Haustiere erlaubt", "Arbeitsplatz",
                   "Fliegengitter","Bügeleisen",  "Balkon"],
            "camping-van": ["Outdoor Dusche", "Zweitbatterie","Steckdosen", "Feuerlöscher", 
                "Löschdecke", "Verbandskasten", "Multitool", "Panzertape", "Grill", "Solarpanel",
            "Toilette", "Kühlschrank", "Dachventilator", "Fahrradträger", "mobile 12V-Brause"],
            "hostel": ["Gemeinschaftsküche", "Frühstücksbuffet", "Handtuchverleih", "Fahrradverleih", "Trocknernutzung", "Waschmaschinennutzung",
                 "Spind", "Fahrradverleih", "Dachterrasse Zugang", "Spieleabend", 
                 "Steckdose am Bett", "Leselampe am Bett",  "Gepäckaufbewahrung", "24h Rezeption"],
            "strand": ["Jetski", "Strandliegen", "Meerblick"],
            "winter": ["Ski-Pass", "Kamin", "Winterreifen"],
            "warm": ["Sonnenliegen", "Klimaanlage"],
            "cold": ["Heizung Plus", "Winter-Check"]
        },
        bilder: {
            "strand": "assets/img/bg-beach.jpg",
            "stadt": "assets/img/bg-city.jpg",
            "laendlich": "assets/img/bg-country.jpg",
            "hotel": "assets/img/hotel-layer.png",
            "villa": "assets/img/villa-layer.png",
            "camping-van": "assets/img/van-layer.png",
            "flugzeug": "assets/img/plane-cloud.png",
            "auto": "assets/img/car-layer.png",
            "zug": "assets/img/train-layer.png"
        }
    };

    // --- 2. Element-Selektoren ---
    const destSelect = document.getElementById('destination');
    const citySelect = document.getElementById('city');
    const quarterSelect = document.getElementById('quarter');
    const searchInput = document.getElementById('destination_search');
    const accSelect = document.getElementById('accommodation');
    const transSelect = document.getElementById('transport');
    const daysInput = document.getElementById('travel_days');
    const couponInput = document.getElementById('coupon_code');
    const travelInput = document.getElementById('travel_start');

    if (!destSelect || !citySelect || !searchInput) {
        console.warn('Wichtige Elemente fehlen im DOM. Abbruch.', { destSelect, citySelect, searchInput });
        return;
    }

    // --- 3. Hilfsfunktionen ---
    const getClimate = () => document.querySelector('.climate-radio:checked')?.value || 'cold';

    const normalize = s => {
        try { return s.normalize('NFD').replace(/\p{Diacritic}/gu, '').toLowerCase(); }
        catch (e) { return (s || '').toLowerCase(); }
    };

    // --- 4. Kern-Logik Funktionen ---

    function updateAll() {
        const selDest = destSelect.options[destSelect.selectedIndex];
        if (!selDest || selDest.value === "") return;

        const countryFactor = parseFloat(selDest.dataset.factor || 1);
        const cityFactor = parseFloat(citySelect.options[citySelect.selectedIndex]?.dataset.factor || 1);
        const climateVal = getClimate();

        let seasonFactor = 1.0;
        if (climateVal === 'warm') seasonFactor = 1.25;
        if (climateVal === 'flexible') seasonFactor = 1.1;

        const baseAcc = parseFloat(accSelect?.selectedOptions?.[0]?.dataset?.price || 0);
        const baseTrans = parseFloat(transSelect?.selectedOptions?.[0]?.dataset?.price || 0);
        const days = parseInt(daysInput?.value) || 1;

        const finalTrans = baseTrans * countryFactor * cityFactor * seasonFactor;
        const finalAcc = (baseAcc * days) * countryFactor * cityFactor * seasonFactor;
        let total = finalTrans + finalAcc;

        document.querySelectorAll('.extra-checkbox:checked').forEach(cb => {
            total += parseFloat(cb.dataset.price || 0);
        });

        if ((couponInput?.value || "").toUpperCase() === 'SUMMER10') total *= 0.9;

        // UI Updates
        if(document.getElementById('res-dest')) document.getElementById('res-dest').innerText = destSelect.value;
        if(document.getElementById('res-city')) document.getElementById('res-city').innerText = citySelect.value || "-";
        if(document.getElementById('res-price-trans')) document.getElementById('res-price-trans').innerText = finalTrans.toFixed(2).replace('.', ',') + " €";
        if(document.getElementById('res-price-acc')) document.getElementById('res-price-acc').innerText = finalAcc.toFixed(2).replace('.', ',') + " €";
        if(document.getElementById('res-price')) document.getElementById('res-price').innerText = total.toFixed(2).replace('.', ',') + " €";
        
        const totalInput = document.getElementById('total_price_input');
        if (totalInput) totalInput.value = total.toFixed(2);
    }

    function updateExtras() {
        const container = document.getElementById('extras-container');
        if (!container) return;

        const accValue = accSelect.value.toLowerCase();
        const climateVal = getClimate();
        const cityText = citySelect.options[citySelect.selectedIndex]?.text || "";
        
        let list = [
            ...(konfiguration.extras[accValue] || []),
            ...(konfiguration.extras[climateVal] || [])
        ];

        if (cityText.includes("Strand")) list.push(...konfiguration.extras["strand"]);
        if (climateVal === "cold") list.push(...konfiguration.extras["winter"]);

        const uniqueExtras = [...new Set(list)];

        container.innerHTML = '<h4>Verfügbare Extras:</h4>';
        uniqueExtras.forEach(extra => {
            const div = document.createElement('div');
            div.innerHTML = `
                <label>
                    <input type="checkbox" class="extra-checkbox" data-price="20" value="${extra}"> 
                    ${extra} (+20,00 €)
                </label>`;
            container.appendChild(div);
        });

        container.querySelectorAll('.extra-checkbox').forEach(cb => {
            cb.addEventListener('change', updateAll);
        });
    }

    function updatePreviewScene() {
        const layerBg = document.getElementById('layer-bg');
        const layerMid = document.getElementById('layer-mid');
        const layerFg = document.getElementById('layer-fg');

        const cityText = citySelect.options[citySelect.selectedIndex]?.text || "";
        const accValue = accSelect.value.toLowerCase();
        const transValue = transSelect.value.toLowerCase();

        // Hintergrund
        if (layerBg) {
            let bgKey = "laendlich";
            if (cityText.includes("Strand")) bgKey = "strand";
            if (cityText.includes("Stadt")) bgKey = "stadt";
            layerBg.style.backgroundImage = `url('${konfiguration.bilder[bgKey]}')`;
        }

        // Unterkunft
        if (layerMid) {
            const img = konfiguration.bilder[accValue] || "";
            layerMid.style.backgroundImage = img ? `url('${img}')` : "none";
        }

        // Transport
        if (layerFg) {
            let fgKey = "";
            if (transValue.includes("flug")) fgKey = "flugzeug";
            else if (transValue.includes("auto")) fgKey = "auto";
            else if (transValue.includes("zug")) fgKey = "zug";
            
            layerFg.style.backgroundImage = fgKey ? `url('${konfiguration.bilder[fgKey]}')` : "none";
        }
    }

    function updateCities() {
        const country = destSelect.value;
        citySelect.innerHTML = '<option value="" data-factor="1">-- Stadt wählen --</option>';

        if (typeof cityData === 'object' && cityData[country]) {
            citySelect.disabled = false;
            Object.entries(cityData[country]).forEach(([name, factor]) => {
                const opt = document.createElement('option');
                opt.value = opt.text = name;
                opt.dataset.factor = factor;
                citySelect.appendChild(opt);
            });
            if (citySelect.options.length > 1) citySelect.selectedIndex = 1;
        } else {
            citySelect.disabled = true;
        }
        updateSeason();
        updateExtras();
        updatePreviewScene();
    }

    function updateSeason() {
        const climateVal = getClimate();
        const country = destSelect.value;
        const year = new Date().getFullYear();

        if (!quarterSelect) { updateAll(); return; }

        if (climateVal === 'flexible') {
            quarterSelect.disabled = false;
            quarterSelect.innerHTML = '<option value="">-- Quartal wählen --</option><option value="Q1">Q1</option><option value="Q2">Q2</option><option value="Q3">Q3</option><option value="Q4">Q4</option>';
        } else {
            const isWarm = document.getElementById('climate_warm')?.checked;
            const isSouth = ['Mauritius', 'Südafrika', 'Australien', 'Brasilien'].includes(country);
            quarterSelect.innerHTML = '';
            const qs = [{v:'Q1',s:false},{v:'Q2',s:true},{v:'Q3',s:true},{v:'Q4',s:false}];
            qs.forEach(q => {
                let summer = isSouth ? !q.s : q.s;
                if ((isWarm && summer) || (!isWarm && !summer)) {
                    const opt = document.createElement('option'); opt.value = q.v; opt.text = q.v; quarterSelect.appendChild(opt);
                }
            });
            const qStarts = {'Q1':'-01-01','Q2':'-04-01','Q3':'-07-01','Q4':'-10-01'};
            if (qStarts[quarterSelect.value] && travelInput) travelInput.value = year + qStarts[quarterSelect.value];
        }
        updateAll();
    }

    // --- 5. Event Listener ---

    searchInput.addEventListener('input', function() {
        const raw = this.value || "";
        const term = normalize(raw.trim());
        destSelect.innerHTML = '<option value="">-- Ziel wählen --</option>';
        let matches = 0, lastMatch = "";

        if (typeof allDestinations === 'object') {
            Object.keys(allDestinations).forEach(c => {
                if (normalize(c).includes(term)) {
                    const opt = document.createElement('option');
                    opt.value = opt.text = c;
                    opt.dataset.factor = allDestinations[c];
                    destSelect.appendChild(opt);
                    matches++; lastMatch = c;
                }
            });
        }

        if (term === "" && typeof allDestinations === 'object') {
            Object.keys(allDestinations).forEach(c => {
                const opt = document.createElement('option');
                opt.value = opt.text = c;
                opt.dataset.factor = allDestinations[c];
                destSelect.appendChild(opt);
            });
        }

        if (matches === 1 && term.length >= 2) {
            destSelect.value = lastMatch;
            updateCities();
        }
    });

    destSelect.addEventListener('change', updateCities);
    
    citySelect.addEventListener('change', () => {
        updateExtras();
        updatePreviewScene();
        updateAll();
    });

    travelInput && travelInput.addEventListener('change', function() {
        if (!this.value) return;
        const m = new Date(this.value).getMonth() + 1;
        let q = (m <= 3) ? "Q1" : (m <= 6) ? "Q2" : (m <= 9) ? "Q3" : "Q4";
        const exists = Array.from((quarterSelect?.options || [])).some(o => o.value === q);
        if (exists) quarterSelect.value = q;
        updateAll();
    });

    quarterSelect && quarterSelect.addEventListener('change', function() {
        const year = new Date().getFullYear();
        const qStarts = {'Q1':'-01-01','Q2':'-04-01','Q3':'-07-01','Q4':'-10-01'};
        if (qStarts[this.value] && travelInput) travelInput.value = year + qStarts[this.value];
        updateAll();
    });

    [accSelect, transSelect, daysInput, couponInput].forEach(el => {
        if (el) {
            el.addEventListener('change', () => {
                updateExtras();
                updatePreviewScene();
                updateAll();
            });
        }
    });

    document.querySelectorAll('.climate-radio').forEach(r => {
        r.addEventListener('change', () => {
            updateSeason();
            updateExtras();
            updatePreviewScene();
        });
    });

    // --- 6. Initialisierung ---
    updateSeason();
    updateExtras();
    updatePreviewScene();
});