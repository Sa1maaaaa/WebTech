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
                            "villa": ["Pool", "Garten", "Küche", "Grill", "Privater Koch", "Weinregal",
                                 "Whirlpool", "Sauna",
                                "Fitnessraum", "Heimkino", "Bibliothek", "Kinderspielzimmer",
                                 "Bettwäsche", "Rauchen erlaubt", "eigenständiger Check-In"
                            ],
                          "ferienwohnung": ["Küche", "Waschmaschine", "Trockner", "Staubsauger", "Parkplatz",
                          "Alarmanlage", "Kamera", "Wasserkocher", "Kaffeemaschine",
                            "Fernseher", "Fön", "Smart-TV","Bettwäsche", "Rauchen erlaubt",
                            "eigenständiger Check-In","Haustiere erlaubt", "Arbeitsplatz",
                             "Fliegengitter","Bügeleisen",  "Balkon"],

            "camping-van": ["Outdoor Dusche", "Zweitbatterie","Steckdosen", "Feuerlöscher", 
                "Löschdecke", "Verbandskasten", "Multitool", "Panzertape", "Grill", "Solarpanel",
            "Toilette", "Kühlschrank", "Dachventilator", "Fahrradträger", "mobile 12V-Brause"],

            "hostel": ["Gemeinschaftsküche", "Frühstücksbuffet", "Handtuchverleih", "Fahrradverleih",
                 "Trocknernutzung", "Waschmaschinennutzung",
                 "Spind", "Fahrradverleih", "Dachterrasse Zugang", "Spieleabend", 
                 "Steckdose am Bett", "Leselampe am Bett",  "Gepäckaufbewahrung", "24h Rezeption"],
            "winter": ["Ski-Pass", "Kamin", "Winterreifen"],
            "warm": ["Sonnenliegen", "Klimaanlage"],
            "cold": ["Heizung Plus", "Winter-Check"]
        },
        extraPrices: {
            "Jetski": 60,
            "Strandliegen": 10,
            "Meerblick": 0,
            "Ski-Pass": 120,
            "Kamin": 15,
            "Winterreifen": 40,
            "Sonnenliegen": 8,
            "Klimaanlage": 25,
            "Heizung Plus": 12,
            "Winter-Check": 30
        },
        countryImages: {
           "Spanien": "https://images.unsplash.com/photo-1505761671935-60b3a7427bad?auto=format&fit=crop&w=1200&q=80",
        "Italien": "https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?auto=format&fit=crop&w=1400&q=80",
        "Thailand": "https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=1200&q=80",
        "Türkei": "https://images.unsplash.com/photo-1596436889106-be35e843f974?auto=format&fit=crop&w=1200&q=80",
        "Ägypten": "https://images.unsplash.com/photo-1539650116574-75c0c6d73f8e?auto=format&fit=crop&w=1400&q=80",
        "Schweiz": "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80",
        "Arabische-Emirate": "https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=1200&q=80",
        "Kroatien": "https://images.unsplash.com/photo-1555992336-03a23c4a9b9b?auto=format&fit=crop&w=1400&q=80",
        "Griechenland": "https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?auto=format&fit=crop&w=1400&q=80",
        "Frankreich": "https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80",
        "Mauritius": "https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=1200&q=80",
        "USA": "https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=1400&q=80",
        "Südafrika": "https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?auto=format&fit=crop&w=1200&q=80",
        "Portugal": "https://images.unsplash.com/photo-1504470695779-75300268aa8f?auto=format&fit=crop&w=1600&q=80",
        "Österreich": "https://images.unsplash.com/photo-1665945203723-d823de195bf4?auto=format&fit=crop&fm=jpg&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&q=80&w=1600",
        "Marokko": "https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=1400&q=80",
        "Vietnam": "https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80",
        "Mexiko": "https://images.unsplash.com/photo-1510097467424-192d713fd8b2?auto=format&fit=crop&w=1400&q=80",
        "Albanien": "https://images.unsplash.com/photo-1516483638261-f4dbaf036963?auto=format&fit=crop&w=1200&q=80",
        "Japan": "https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80",
        "Island": "https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80",
        "Norwegen": "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80",
        "Australien": "https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=1200&q=80",
        "Brasilien": "https://images.unsplash.com/photo-1483729558449-99ef09a8c325?auto=format&fit=crop&w=1200&q=80",
        "Kanada": "https://images.unsplash.com/photo-1503614472-8c93d56e92ce?auto=format&fit=crop&w=1200&q=80"
        }
    };

    if (typeof cityData !== 'object' || cityData === null) console.warn('cityData ist nicht definiert oder kein Objekt.');
    if (typeof allDestinations !== 'object' || allDestinations === null) console.warn('allDestinations ist nicht definiert oder kein Objekt.');

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
    const peopleInput = document.getElementById('people_count') || document.getElementById('persons') || null;

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

    function getSelectedDatasetValue(selectEl, key) {
        if (!selectEl) return undefined;
        const idx = selectEl.selectedIndex;
        if (typeof idx === 'number' && selectEl.options && selectEl.options[idx]) {
            const opt = selectEl.options[idx];
            return opt.dataset ? opt.dataset[key] : undefined;
        }
        const opt = selectEl.selectedOptions && selectEl.selectedOptions[0];
        return opt && opt.dataset ? opt.dataset[key] : undefined;
    }

    function computeExtraPrice(extraName) {
        const base = (konfiguration.extraPrices && konfiguration.extraPrices[extraName]) ? konfiguration.extraPrices[extraName] : 20;
        const countryFactor = parseFloat(getSelectedDatasetValue(destSelect, 'factor') || 1);
        const cityFactor = parseFloat(getSelectedDatasetValue(citySelect, 'factor') || 1);
        const accFactor = parseFloat(getSelectedDatasetValue(accSelect, 'factor') || 1);
        const raw = base * countryFactor * cityFactor * accFactor;
        return Math.round(raw);
    }

    // --- 4. Kern-Logik Funktionen ---

    function updateAll() {
        const selIndex = destSelect.selectedIndex;
        const selDest = (typeof selIndex === 'number' && destSelect.options && destSelect.options[selIndex]) ? destSelect.options[selIndex] : null;
        if (!selDest || selDest.value === "") return;

        const countryFactor = parseFloat(selDest.dataset.factor || 1);
        const cityFactor = parseFloat(getSelectedDatasetValue(citySelect, 'factor') || 1);
        const climateVal = getClimate();

        let seasonFactor = 1.0;
        if (climateVal === 'warm') seasonFactor = 1.25;
        if (climateVal === 'flexible') seasonFactor = 1.1;

        const baseAcc = parseFloat(getSelectedDatasetValue(accSelect, 'price') || 0);
        const baseTrans = parseFloat(getSelectedDatasetValue(transSelect, 'price') || 0);
        const days = parseInt(daysInput?.value) || 1;

        const finalTrans = baseTrans * countryFactor * cityFactor * seasonFactor;
        const finalAcc = (baseAcc * days) * countryFactor * cityFactor * seasonFactor;

        const extrasPerPerson = Array.from(document.querySelectorAll('.extra-checkbox:checked')).reduce((s, cb) => s + parseFloat(cb.dataset.price || 0), 0);

        let pricePerPerson = finalTrans + finalAcc + extrasPerPerson;
        if ((couponInput?.value || "").toUpperCase() === 'SUMMER10') pricePerPerson *= 0.9;

        const people = Math.max(1, parseInt(peopleInput?.value) || 1);
        const total = pricePerPerson * people;

        // UI Updates
        if(document.getElementById('res-dest')) document.getElementById('res-dest').innerText = destSelect.value;
        if(document.getElementById('res-city')) document.getElementById('res-city').innerText = citySelect.value || "-";
        if(document.getElementById('res-price-trans')) document.getElementById('res-price-trans').innerText = finalTrans.toFixed(2).replace('.', ',') + " € / Person";
        if(document.getElementById('res-price-acc')) document.getElementById('res-price-acc').innerText = finalAcc.toFixed(2).replace('.', ',') + " € / Person";

        const perPersonEl = document.getElementById('res-price-per-person');
        const totalEl = document.getElementById('res-price-total');
        
        if (perPersonEl) {
            perPersonEl.innerText = Math.round(pricePerPerson) + " € / Person";
        }
        if (totalEl) {
            totalEl.innerText = total.toFixed(2).replace('.', ',') + " €";
        }
        
        const bigPriceEl = document.getElementById('res-price');
        if (bigPriceEl) {
            bigPriceEl.innerText = total.toFixed(2).replace('.', ',') + " €";
            bigPriceEl.classList.add('text-primary');
        }
        
        const totalInput = document.getElementById('total_price_input');
        if (totalInput) totalInput.value = total.toFixed(2);

        // Update extra badges
        try {
            const badges = document.getElementById('extra-badges');
            if (badges) {
                const checked = Array.from(document.querySelectorAll('.extra-checkbox:checked'));
                badges.innerHTML = '';
                if (checked.length === 0) {
                    const note = document.createElement('small');
                    note.className = 'text-muted italic';
                    note.innerText = 'Noch keine Extras gewählt';
                    badges.appendChild(note);
                } else {
                    checked.forEach(cb => {
                        const name = cb.value || cb.dataset.value || 'Extra';
                        const price = parseFloat(cb.dataset.price || 0);
                        const span = document.createElement('span');
                        span.className = 'badge bg-light text-dark border me-1 mb-1';
                        span.innerText = `${name} (+${price} €)`;
                        badges.appendChild(span);
                    });
                }
            }
        } catch (e) { console.warn('Error updating extra badges', e); }
    }

    function updateExtras() {
        const container = document.getElementById('extras-container') || document.getElementById('extra-badges');
        if (!container) {
            console.warn('Kein Extras-Container im DOM gefunden.');
            return;
        }

        const accValue = accSelect?.value?.toLowerCase() || '';
        const climateVal = getClimate();
        const cityText = citySelect.options[citySelect.selectedIndex]?.text || "";

        let list = [
            ...(konfiguration.extras[climateVal] || [])
        ];

        if (accValue) list.push(...(konfiguration.extras[accValue] || []));
        if (cityText.includes("Strand")) list.push(...(konfiguration.extras["strand"] || []));

        const uniqueExtras = [...new Set(list)];

        container.innerHTML = '<h4>Verfügbare Extras:</h4>';
        uniqueExtras.forEach(extra => {
            const price = computeExtraPrice(extra);
            const div = document.createElement('div');
            div.className = 'col-12';
            const label = document.createElement('label');
            label.innerHTML = ` <input type="checkbox" name="extras[]" class="extra-checkbox" /> `;
            label.className = 'd-flex align-items-center gap-2';
            const input = label.querySelector('input.extra-checkbox');
            input.value = extra;
            input.dataset.price = price;
            const span = document.createElement('span');
            span.className = 'extra-label';
            span.textContent = `${extra} (+${price} €)`;
            label.appendChild(span);
            div.appendChild(label);
            container.appendChild(div);
        });

        // 🔧 FIX: Attach event listeners to newly created checkboxes
        container.querySelectorAll('.extra-checkbox').forEach(cb => {
            cb.addEventListener('change', updateAll);
        });
    }

    function updatePreviewScene() {
        const layerBg = document.getElementById('layer-bg');
        const layerMid = document.getElementById('layer-mid');
        const layerFg = document.getElementById('layer-fg');
        const placeholder = document.getElementById('preview-placeholder');

        const cityText = citySelect.options[citySelect.selectedIndex]?.text || "";
        const accValue = accSelect?.value?.toLowerCase() || '';
        const transValue = transSelect?.value?.toLowerCase() || '';

        if (layerBg) {
            let img = '';
            const countryKey = destSelect?.value;
            if (countryKey && konfiguration.countryImages && konfiguration.countryImages[countryKey]) {
                img = konfiguration.countryImages[countryKey];
            } else {
                let bgKey = "laendlich";
                if (cityText.includes("Strand")) bgKey = "strand";
                if (cityText.includes("Stadt")) bgKey = "stadt";
                img = konfiguration.bilder?.[bgKey] || '';
            }
            if (img) layerBg.style.backgroundImage = `url('${img}')`;
            else layerBg.style.backgroundImage = 'none';
        }

        if (layerMid) {
            const img = konfiguration.bilder?.[accValue] || "";
            layerMid.style.backgroundImage = img ? `url('${img}')` : "none";
        }

        if (layerFg) {
            let fgKey = "";
            if (transValue.includes("flug")) fgKey = "flugzeug";
            else if (transValue.includes("auto")) fgKey = "auto";
            else if (transValue.includes("zug")) fgKey = "zug";
            layerFg.style.backgroundImage = fgKey ? `url('${konfiguration.bilder?.[fgKey]}')` : "none";
        }

        try {
            if (placeholder) {
                if (destSelect && destSelect.value) placeholder.style.display = 'none';
                else placeholder.style.display = 'flex';
            }
        } catch (e) { /* ignore */ }
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
        updateAll();
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

    // 🔧 FIX: Add event listener for travel date input
    if (travelInput) {
        travelInput.addEventListener('change', function() {
            if (!this.value) return;
            const m = new Date(this.value).getMonth() + 1;
            let q = (m <= 3) ? "Q1" : (m <= 6) ? "Q2" : (m <= 9) ? "Q3" : "Q4";
            const exists = Array.from((quarterSelect?.options || [])).some(o => o.value === q);
            if (exists) quarterSelect.value = q;
            updateAll();
        });
    }

    // 🔧 FIX: Add event listener for quarter select
    if (quarterSelect) {
        quarterSelect.addEventListener('change', function() {
            const year = new Date().getFullYear();
            const qStarts = {'Q1':'-01-01','Q2':'-04-01','Q3':'-07-01','Q4':'-10-01'};
            if (qStarts[this.value] && travelInput) travelInput.value = year + qStarts[this.value];
            updateAll();
        });
    }

    // 🔧 FIX: Ensure all select elements trigger updateAll on change
    [accSelect, transSelect].forEach(el => {
        if (el) {
            el.addEventListener('change', () => {
                updateExtras();
                updatePreviewScene();
                updateAll();
            });
        }
    });

    // 🔧 FIX: Add event listeners for days and coupon inputs with proper event types
    if (daysInput) {
        daysInput.addEventListener('input', updateAll);
        daysInput.addEventListener('change', updateAll);
    }

    if (couponInput) {
        couponInput.addEventListener('input', updateAll);
        couponInput.addEventListener('change', updateAll);
        couponInput.addEventListener('blur', updateAll);
    }

    if (peopleInput) {
        peopleInput.addEventListener('input', updateAll);
        peopleInput.addEventListener('change', updateAll);
    }

    // 🔧 FIX: Climate radio buttons - ensure updateAll is called
    document.querySelectorAll('.climate-radio').forEach(r => {
        r.addEventListener('change', () => {
            updateSeason();
            updateExtras();
            updatePreviewScene();
            updateAll();
        });
    });

    // --- 6. Initialisierung ---
    updateSeason();
    updateExtras();
    updatePreviewScene();
});