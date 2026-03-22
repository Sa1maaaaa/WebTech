<?php
include 'includes/auth.php';
include 'config/db.php';


$destinations = [
'Spanien' => 1.2, 'Italien' => 1.4, 'Thailand' => 0.6, 'Türkei' => 0.7, 
'Ägypten' => 0.5, 'Schweiz' => 2.4, 'Arabische-Emirate' => 1.8, 
'Kroatien' => 1.1, 'Griechenland' => 1.2, 'Frankreich' => 1.6,
'Mauritius' => 1.5, 'USA' => 2.2, 'Südafrika' => 0.9, 'Portugal' => 1.0,
'Österreich' => 1.3, 'Marokko' => 0.7, 'Vietnam' => 0.5, 'Mexiko' => 1.1,
'Albanien' => 0.6, 'Japan' => 1.5, 'Island' => 2.3, 'Norwegen' => 2.1, 
'Australien' => 1.9, 'Brasilien' => 0.9, 'Kanada' => 1.8 ];

ksort($destinations);


$cityData = $cityData = [
    'Spanien' => [
        'Barcelona (Strand)' => 1.2,
        'Palma (Strand)' => 1.1,
        'Madrid (Land)' => 1.0,
        'Sevilla (Land)' => 0.9,
    ],
    'Italien' => [
        'Rom (Land)' => 1.3,
        'Mailand (Land)' => 1.2,
        'Rimini (Strand)' => 1.0,
        'Bari (Strand)' => 0.8,
    ],
    'Südafrika' => [
        'Kapstadt (Strand)' => 1.1,
        'Durban (Strand)' => 0.8,
        'Johannesburg (Land)' => 0.9,
        'Pretoria (Land)' => 0.8,
    ],
    'Mauritius' => [
        'Flic en Flac (Strand)' => 1.4,
        'Belle Mare (Strand)' => 1.6,
        'Port Louis (Land)' => 1.2,
        'Curepipe (Land)' => 1.0,
    ],
    'Thailand' => [
        'Koh Samui (Strand)' => 0.7,
        'Krabi (Strand)' => 0.6,
        'Chiang Mai (Land)' => 0.5,
        'Pai (Land)' => 0.4,
    ],
    'Türkei' => [
        'Istanbul (Land)' => 0.9,
        'Kappadokien (Land)' => 0.8,
        'Bodrum (Strand)' => 1.1,
        'Antalya (Strand)' => 0.7,
    ],
    'Ägypten' => [
        'Kairo (Land)' => 0.6,
        'Luxor (Land)' => 0.5,
        'Hurghada (Strand)' => 0.6,
        'Marsa Alam (Strand)' => 0.7,
    ],
    'Schweiz' => [
        'Zürich (Land)' => 2.5,
        'Zermatt (Land)' => 2.4,
        'Montreux (Strand)' => 2.2,
        'Ascona (Strand)' => 2.2,
    ],
    'Arabische-Emirate' => [
        'Dubai (Strand)' => 1.9,
        'Abu Dhabi (Strand)' => 1.7,
        'Al Ain (Land)' => 1.2,
        'Hatta (Land)' => 1.4,
    ],
    'Kroatien' => [
        'Dubrovnik (Strand)' => 1.5,
        'Split (Strand)' => 1.2,
        'Zagreb (Land)' => 1.0,
        'Plitvicer Seen (Land)' => 1.1,
    ],
    'Griechenland' => [
        'Santorini (Strand)' => 1.8,
        'Kreta (Strand)' => 1.1,
        'Athen (Land)' => 1.2,
        'Meteora (Land)' => 0.9,
    ],
    'Frankreich' => [
        'Paris (Land)' => 1.8,
        'Lyon (Land)' => 1.3,
        'Nizza (Strand)' => 1.6,
        'Biarritz (Strand)' => 1.5,
    ],
    'USA' => [
        'New York (Land)' => 2.4,
        'Las Vegas (Land)' => 1.6,
        'Miami (Strand)' => 2.2,
        'Santa Monica (Strand)' => 2.3,
    ],
    'Portugal' => [
        'Lissabon (Land)' => 1.2,
        'Porto (Land)' => 1.1,
        'Algarve (Strand)' => 1.2,
        'Cascais (Strand)' => 1.4,
    ],
    'Österreich' => [
        'Wien (Land)' => 1.4,
        'Salzburg (Land)' => 1.3,
        'Podersdorf (Strand)' => 1.1,
        'Wolfgangsee (Strand)' => 1.4,
    ],
    'Marokko' => [
        'Marrakesch (Land)' => 0.9,
        'Fès (Land)' => 0.7,
        'Agadir (Strand)' => 0.8,
        'Essaouira (Strand)' => 0.8,
    ],
    'Vietnam' => [
        'Hanoi (Land)' => 0.5,
        'Sapa (Land)' => 0.4,
        'Da Nang (Strand)' => 0.6,
        'Phu Quoc (Strand)' => 0.7,
    ],
    'Mexiko' => [
        'Mexiko-Stadt (Land)' => 1.1,
        'Oaxaca (Land)' => 0.9,
        'Cancún (Strand)' => 1.5,
        'Tulum (Strand)' => 1.6,
    ],
    'Albanien' => [
        'Tirana (Land)' => 0.6,
        'Gjirokastra (Land)' => 0.5,
        'Ksamil (Strand)' => 0.7,
        'Vlora (Strand)' => 0.6,
    ],
    'Japan' => [
        'Tokio (Land)' => 1.7,
        'Kyoto (Land)' => 1.5,
        'Okinawa (Strand)' => 1.4,
        'Kamakura (Strand)' => 1.3,
    ],
    'Island' => [
        'Reykjavík (Land)' => 2.3,
        'Akureyri (Land)' => 2.0,
        'Vik (Strand)' => 2.4,
        'Grindavik (Strand)' => 2.1,
    ],
    'Norwegen' => [
        'Oslo (Land)' => 2.1,
        'Bergen (Land)' => 1.9,
        'Lofoten (Strand)' => 2.3,
        'Stavanger (Strand)' => 1.8,
    ],
    'Australien' => [
        'Sydney (Land)' => 1.9,
        'Alice Springs (Land)' => 1.6,
        'Bondi Beach (Strand)' => 2.1,
        'Whitehaven Beach (Strand)' => 2.3,
    ],
    'Brasilien' => [
        'São Paulo (Land)' => 1.0,
        'Manaus (Land)' => 0.8,
        'Rio de Janeiro (Strand)' => 1.2,
        'Florianópolis (Strand)' => 1.1,
    ],
    'Kanada' => [
        'Toronto (Land)' => 1.8,
        'Banff (Land)' => 2.2,
        'Tofino (Strand)' => 2.1,
        'Prince Edward Island (Strand)' => 1.6,
    ],
];

$accommodations = [
    'Hotel' => 80, 'Villa' => 250, 'Hostel' => 45, 'Camping-Van' => 50, 'Ferien-Wohnung' => 120
];

$transports = [
    'Flugzeug' => 300, 'Bus' => 60, 'Zug' => 85, 'Schiff' => 225
];
$seasonFactors = [
    'warm' => 1.25,   // +25% im Sommer
    'cold' => 1.0,    // Basispreis im Winter
    'flexible' => 1.1 // Kleiner Aufschlag für Flexibilität
];

$extras = [
    'am Meer' => 50, 'in der Stadt' => 30, 'Stornierbarkeit' => 100, 
    'Pool' => 40, 'Sauna' => 25, 'Außendusche' => 15, 
    'Privatsphäre (keine Nachbarn)' => 60, 'Sichtschutz' => 35, 'Babybett' => 20, 
    'barrierefrei' => 30, 'All-Inclusive' => 80, 'Vegan' => 15, 'Vegetarisch' => 10,
    'freie Getränke' => 20, 'Early Chek-In' => 23, 'Late Check-Out' => 23
];

include 'includes/header.php';
?>

<style>
    .config-card { border: none; border-radius: 15px; transition: all 0.3s ease; background: #fff; }
    .extra-card { cursor: pointer; border: 2px solid #f0f0f0; border-radius: 10px; transition: 0.2s; }
    .extra-card:hover { border-color: #0d6efd; background: #f8fbff; }
    .extra-checkbox:checked + .extra-label-box { border-color: #0d6efd; background: #e7f1ff; }
    .preview-window { position: relative; width: 100%; height: 300px; border-radius: 20px; overflow: hidden; background: #222; box-shadow: inset 0 0 50px rgba(0,0,0,0.5); }
    .layer { position: absolute; width: 100%; height: 100%; top: 0; left: 0; transition: opacity 0.5s ease; }
    #layer-bg { object-fit: cover; z-index: 1; }
    #layer-acc { object-fit: contain; z-index: 2; }
    #layer-trans { object-fit: contain; z-index: 3; }
    .price-tag { font-size: 2.5rem; font-weight: 800; color: #0d6efd; }
</style>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card config-card shadow-lg p-4">
                <form action="save_trip.php" method="POST" id="travelForm">
   <h4 class="text-primary mb-4 fw-bold"><i class="bi bi-geo-alt"></i> 1. Zielort & Zeitraum</h4>
                                     
                    <div class="mb-4">
                        <input type="text" id="destination_search" class="form-control form-control-lg mb-3" placeholder="🔍 Wo soll es hingehen?">
                        <select name="destination" id="destination" class="form-select form-select-lg" required>
                            <option value="">-- Ziel wählen --</option>
                            <?php foreach ($destinations as $name => $factor): ?>
                        <option value="<?= $name ?>" data-factor="<?= $factor ?>">
                        <?= $name ?>
                         </option>
                        <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="fw-bold small">Stadt / Region</label>
                        <select name="city" id="city" class="form-select" disabled required>
                            <option value="">Bitte zuerst Land wählen...</option>
                        </select>
                    </div>

                    <div class="p-3 rounded-4 mb-4" style="background: #f1f5f9;">
                        <div class="d-flex gap-4 mb-3 justify-content-center">
                            <div class="form-check">
                                <input class="form-check-input climate-radio" type="radio" name="climate" value="warm" id="climate_warm" checked>
                                <label class="form-check-label fw-bold" for="climate_warm">☀️ Sommer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input climate-radio" type="radio" name="climate" value="cold" id="climate_cold">
                                <label class="form-check-label fw-bold" for="climate_cold">❄️ Winter</label>
                            </div>
                            <div class="form-check">
                                 <input class="form-check-input climate-radio" type="radio" name="climate" value="flexible" id="climate_flexible">
                                 <label class="form-check-label fw-bold" for="climate_flexible">📅 Flexibel</label>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <select name="quarter" id="quarter" class="form-select"></select>
                            </div>
                            <div class="col-6">
                                <input type="date" name="travel_start" id="travel_start" class="form-control">
                            </div>
                        </div>
                    </div>

                    <h4 class="text-primary mb-4 fw-bold"><i class="bi bi-house"></i> 2. Unterkunft & Transport</h4>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <select name="accommodation" id="accommodation" class="form-select" required>
                                <option value="">-- Unterkunft --</option>
                                <?php foreach ($accommodations as $name => $price): ?>
                                    <option value="<?= $name ?>" data-price="<?= $price ?>"><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select name="transport" id="transport" class="form-select">
                                <option value="">-- Transport --</option>
                                <?php foreach ($transports as $name => $price): ?>
                                    <option value="<?= $name ?>" data-price="<?= $price ?>"><?= $name ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <h4 class="text-primary mb-4 fw-bold"><i class="bi bi-plus-circle"></i> 3. Extras</h4>
                    <div class="row g-2 mb-4">
                        <?php foreach ($extras as $name => $price): ?>
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-check extra-checkbox" name="extras[]" value="<?= $name ?>" data-price="<?= $price ?>" id="ex_<?= md5($name) ?>" autocomplete="off">
                                <label class="btn btn-outline-secondary w-100 text-start p-2 d-flex justify-content-between align-items-center rounded-3" for="ex_<?= md5($name) ?>">
                                    <span><?= $name ?></span>
                                    <small class="fw-bold">+<?= $price ?> €</small>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row mb-4 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Reisedauer (Tage)</label>
                            <input type="number" name="travel_days" id="travel_days" class="form-control" min="1" value="5">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Gutscheincode</label>
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="z. B. SUMMER10">
                        </div>
                    </div>

                    <input type="hidden" name="total_price" id="total_price_input">
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">Abenteuer speichern</button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
    <div class="sticky-top" style="top: 20px;">
        <div class="card config-card shadow-lg p-4">
            <h5 class="text-center mb-3 fw-bold text-muted text-uppercase">Deine Reise-Vorschau</h5>
            
            <div class="preview-window mb-4">
                <img id="layer-bg" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800" class="layer">
                <img id="layer-acc" src="" class="layer" style="display:none;">
                <img id="layer-trans" src="" class="layer" style="display:none;">
            </div>

            <div class="mt-4 border-top pt-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Ziel:</span>
                    <span id="res-dest" class="fw-bold">-</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Stadt/Region:</span>
                    <span id="res-city" class="fw-bold">-</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Reisetyp:</span>
                    <span id="res-vibe" class="badge bg-info text-dark">Sommer</span>
                </div>
                <div class="mt-3 pt-2 border-top">
    <div class="d-flex justify-content-between small mb-1">
        <span class="text-muted">✈️ Transport (inkl. Faktoren):</span>
        <span id="res-price-trans" class="fw-bold">0,00 €</span>
    </div>
    <div class="d-flex justify-content-between small mb-1">
        <span class="text-muted">🏨 Unterkunft (inkl. Faktoren):</span>
        <span id="res-price-acc" class="fw-bold">0,00 €</span>
    </div>
</div>
                <hr>
                
                <p class="small fw-bold text-muted mb-2">Ausgewählte Extras:</p>
                <div id="extra-badges" class="d-flex flex-wrap gap-1 mb-3">
                    <small class="text-muted italic">Noch keine Extras gewählt</small>
                </div>

                <div class="text-center mt-4 p-3 rounded-4" style="background: #f8fbff;">
                    <span class="text-muted small d-block mb-1">Geschätzter Gesamtpreis</span>
                    <div class="price-tag" id="res-price">0,00 €</div>
                    <small class="text-primary fw-bold">*Inkl. Länder- & Saisonfaktor</small>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<script>
// 1. VARIABLEN DEFINIEREN
const destSelect = document.getElementById('destination');
const citySelect = document.getElementById('city');
const quarterSelect = document.getElementById('quarter');
const searchInput = document.getElementById('destination_search');
const accSelect = document.getElementById('accommodation');
const transSelect = document.getElementById('transport');
const daysInput = document.getElementById('travel_days');
const couponInput = document.getElementById('coupon_code');
const travelInput = document.getElementById('travel_start');

// Daten von PHP übernehmen
const cityData = <?php echo json_encode($cityData); ?>;
const allDestinations = <?php echo json_encode($destinations); ?>;

// 2. FUNKTION: BERECHNUNG & VORSCHAU
function updateAll() {
    const selectedCountryOpt = destSelect.options[destSelect.selectedIndex];
    if (!selectedCountryOpt || selectedCountryOpt.value === "") {
        document.getElementById('res-price').innerText = "0,00 €";
        return;
    }

    // 1. FAKTOREN HOLEN
    const countryFactor = parseFloat(selectedCountryOpt.dataset.factor || 1);
    const selectedCityOpt = citySelect.selectedOptions[0];
    const cityFactor = parseFloat(selectedCityOpt?.dataset.factor || 1); // Stadt-Faktor
    
    const climateVal = document.querySelector('.climate-radio:checked').value;
    let seasonFactor = 1.0;
    if (climateVal === 'warm') seasonFactor = 1.25;
    if (climateVal === 'flexible') seasonFactor = 1.1;

    // 2. BASISPREISE HOLEN
    const basePriceAcc = parseFloat(accSelect.selectedOptions[0]?.dataset.price || 0);
    const basePriceTrans = parseFloat(transSelect.selectedOptions[0]?.dataset.price || 0);
    const days = parseInt(daysInput.value) || 1;

    // 3. EINZELBERECHNUNG (inkl. aller Faktoren)
    // Formel: Basis * Land * Stadt * Saison
    const finalPriceTrans = basePriceTrans * countryFactor * cityFactor * seasonFactor;
    const finalPriceAcc = (basePriceAcc * days) * countryFactor * cityFactor * seasonFactor;

    let total = finalPriceTrans + finalPriceAcc;

    // 4. EXTRAS ADDIEREN
    const iconArea = document.getElementById('extra-badges');
    iconArea.innerHTML = '';
    let hasExtras = false;
    document.querySelectorAll('.extra-checkbox:checked').forEach(cb => {
        hasExtras = true;
        total += parseFloat(cb.dataset.price);
        iconArea.innerHTML += `<span class="badge bg-primary-subtle text-primary border border-primary-subtle small me-1">${cb.value}</span>`;
    });
    if(!hasExtras) iconArea.innerHTML = '<small class="text-muted italic">Noch keine Extras gewählt</small>';

    // 5. GUTSCHEIN
    if (couponInput.value.toUpperCase() === 'SUMMER10') total *= 0.9;

    // 6. UI UPDATES RECHTS
    document.getElementById('res-dest').innerText = destSelect.value || "-";
    document.getElementById('res-city').innerText = citySelect.value || "-";
    
    // Einzelpreise in der Aufschlüsselung
    if(document.getElementById('res-price-trans')) document.getElementById('res-price-trans').innerText = finalPriceTrans.toFixed(2).replace('.', ',') + " €";
    if(document.getElementById('res-price-acc')) document.getElementById('res-price-acc').innerText = finalPriceAcc.toFixed(2).replace('.', ',') + " €";

    document.getElementById('res-vibe').innerText = climateVal === 'warm' ? '☀️ Sommer' : (climateVal === 'cold' ? '❄️ Winter' : '📅 Flexibel');
    document.getElementById('res-price').innerText = total.toFixed(2).replace('.', ',') + " €";
    document.getElementById('total_price_input').value = total.toFixed(2);
}

// 3. FUNKTION: STÄDTE LADEN
function updateCities() {
    const country = destSelect.value;
    citySelect.innerHTML = '<option value="" data-factor="1">-- Stadt wählen --</option>';
    
    if (cityData[country]) {
        citySelect.disabled = false;
        Object.entries(cityData[country]).forEach(([cityName, cityFactor]) => {
            const opt = document.createElement('option');
            opt.value = cityName;
            opt.text = cityName;
            opt.dataset.factor = cityFactor;
            citySelect.appendChild(opt);
        });
        // Automatisch die erste Stadt wählen für sofortigen Preis
        if(citySelect.options.length > 1) citySelect.selectedIndex = 1;
    } else {
        citySelect.disabled = true;
    }
    updateAll();
}

// 4. FUNKTION: SAISON & QUARTAL
function updateSeason() {
    const climateVal = document.querySelector('.climate-radio:checked').value;
    const country = destSelect.value;
    
    if (climateVal === 'flexible') {
        quarterSelect.disabled = false;
        quarterSelect.innerHTML = '<option value="Q1">Q1 (Jan-Mär)</option><option value="Q2">Q2 (Apr-Jun)</option><option value="Q3">Q3 (Jul-Sep)</option><option value="Q4">Q4 (Okt-Dez)</option>';
    } else {
        const isWarm = document.getElementById('climate_warm').checked;
        const isSouthern = country === 'Mauritius' || country === 'Südafrika' || country === 'Australien';
        
        quarterSelect.innerHTML = '';
        const qs = [
            {val: 'Q1', txt: 'Q1 (Jan-Mär)', summer: false},
            {val: 'Q2', txt: 'Q2 (Apr-Jun)', summer: true},
            {val: 'Q3', txt: 'Q3 (Jul-Sep)', summer: true},
            {val: 'Q4', txt: 'Q4 (Okt-Dez)', summer: false}
        ];

        qs.forEach(item => {
            let isSummer = isSouthern ? !item.summer : item.summer;
            if ((isWarm && isSummer) || (!isWarm && !isSummer)) {
                const opt = document.createElement('option');
                opt.value = item.val; opt.textContent = item.txt;
                quarterSelect.appendChild(opt);
            }
        });

        const year = new Date().getFullYear();
        const qStarts = {'Q1':'-01-01','Q2':'-04-01','Q3':'-07-01','Q4':'-10-01'};
        if (qStarts[quarterSelect.value]) travelInput.value = year + qStarts[quarterSelect.value];
    }
    updateAll();
}

// 5. FUNKTION: SUCHE
searchInput.addEventListener('input', function() {
    const term = this.value.toLowerCase().trim();
    destSelect.innerHTML = '<option value="">-- Ziel wählen --</option>';
    
    let matches = 0;
    let lastMatch = "";

    Object.keys(allDestinations).forEach(country => {
        if (country.toLowerCase().includes(term)) {
            const opt = document.createElement('option');
            opt.value = country;
            opt.text = country;
            opt.dataset.factor = allDestinations[country];
            destSelect.appendChild(opt);
            matches++;
            lastMatch = country;
        }
    });

    if (matches === 1 && term.length >= 2) {
        destSelect.value = lastMatch;
        this.classList.add('is-valid');
        updateCities(); 
        updateSeason();
    } else {
        this.classList.remove('is-valid');
    }
});

// 6. EVENT-LISTENER
destSelect.addEventListener('change', () => { updateCities(); updateSeason(); });
citySelect.addEventListener('change', updateAll);
travelInput.addEventListener('input', updateAll);

[accSelect, transSelect, daysInput, couponInput, quarterSelect].forEach(el => {
    el.addEventListener('change', updateAll);
});

document.querySelectorAll('.climate-radio').forEach(r => {
    r.addEventListener('change', updateSeason);
});

document.querySelectorAll('.extra-checkbox').forEach(cb => {
    cb.addEventListener('change', updateAll);
});

window.onload = () => { updateSeason(); };
</script>