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
    'Hotel' => 80, 'Villa' => 250, 'Hostel' => 45, 'Camping-Van' => 50, 'Ferienwohnung' => 120
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
    'freie Getränke' => 20, 'Early Check-In' => 23, 'Late Check-Out' => 23
];

include 'includes/header.php';
?>

<style>
    .config-card { border: none; border-radius: 15px; transition: all 0.3s ease; background: #fff; }
    .extra-card { cursor: pointer; border: 2px solid #f0f0f0; border-radius: 10px; transition: 0.2s; }
    .extra-card:hover { border-color: #0d6efd; background: #f8fbff; }
    .extra-checkbox:checked + .extra-label-box { border-color: #0d6efd; background: #e7f1ff; }
    .preview-window { position: relative; width: 100%; height: 300px;  border-radius: 20px; overflow: hidden; background: #222; box-shadow: inset 0 0 50px rgba(0,0,0,0.5); }
    .layer { position: absolute; width: 100%; height: 100%; top: 0; left: 0; transition: opacity 0.5s ease; background-size: cover; background-position: center center; }
    #layer-bg { z-index: 1; }
    #layer-acc { z-index: 2; }
    #layer-trans { z-index: 3; }
    #preview-placeholder { position: absolute; inset: 0; display:flex; align-items:center; justify-content:center; z-index:4; }
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

<!-- ab hier die Checkboxen für sommer/winter/flexibel -->
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
                    <div id="extras-container" class="row g-2 mb-4">
                    <div class="col-12 text-muted">Bitte wähle zuerst Ziel, Region und Unterkunft.</div>
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Personen</label>
                            <input type="number" name="people_count" id="people_count" class="form-control" min="1" value="1">
                        </div>
                    </div>

                    <input type="hidden" name="total_price" id="total_price_input">
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">Abenteuer speichern</button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
<!-- //der bereich wo das flugzeug mal war -->
    <div class="sticky-top" style="top: 20px;"> 
        <div class="card config-card shadow-lg p-4">
            <h5 class="text-center mb-3 fw-bold text-muted text-uppercase">Deine Reise-Vorschau</h5>
            
            <div class="preview-window mb-4"
             style="height: 300px; background: #f5f5f5; position: relative;">
                <!-- Layered preview: background / accommodation / transport -->
                <div id="layer-bg" class="layer" aria-hidden="true"></div>
                <div id="layer-mid" class="layer" aria-hidden="true"></div>
                <div id="layer-fg" class="layer" aria-hidden="true"></div>
            <div class="preview-window mb-4">

             <!-- <img id="layer-bg"
                 src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e"
                class="layer"> -->

            <img id="layer-acc" class="layer" style="display:none;">
                 <img id="layer-trans" class="layer" style="display:none;">

            </div>
            
            </div>

            <!-- rechts was da steht -->
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
                <!-- das ist der rechte bereich wo unsere extras sind -->
                <p class="small fw-bold text-muted mb-2">Ausgewählte Extras:</p>
                <div id="extra-badges" class="d-flex flex-wrap gap-1 mb-3">
                    <small class="text-muted italic">Noch keine Extras gewählt</small>
                </div>

                <div class="text-center mt-4 p-3 rounded-4" style="background: #f8fbff;">
                    <span class="text-muted small d-block mb-1">Geschätzter Gesamtpreis</span>
                    <div class="small mb-2">
                        <span id="res-price-per-person" class="fw-bold">0 € / Person</span>
                    </div>
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
    const cityData = <?php echo json_encode($cityData); ?>;
    const allDestinations = <?php echo json_encode($destinations); ?>;
</script>

<!-- NIMMT DATEN AUS Configurator.js -->
 <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script src="assets/js/configurator.js"></script>

<script type="module">
  import * as THREE from 'https://unpkg.com/three@0.160.0/build/three.module.js';
  import { OrbitControls } from 'https://unpkg.com/three@0.160.0/examples/jsm/controls/OrbitControls.js';
  import { GLTFLoader } from 'https://unpkg.com/three@0.160.0/examples/jsm/loaders/GLTFLoader.js';

  const container = document.getElementById('plane3d');

  if (container) {
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xf5f5f5);

    const camera = new THREE.PerspectiveCamera(
      45,
      container.clientWidth / container.clientHeight,
      0.1,
      1000
    );
    camera.position.set(0, 2, 6);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);

    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;

    const ambientLight = new THREE.AmbientLight(0xffffff, 1.2);
    scene.add(ambientLight);

    const directionalLight = new THREE.DirectionalLight(0xffffff, 1.5);
    directionalLight.position.set(5, 10, 7);
    scene.add(directionalLight);

    const loader = new GLTFLoader();
    loader.load(
      './assets/models/ace_combat_7_b-52h_stratofortress.glb',
      function (gltf) {
        const model = gltf.scene;
        model.scale.set(1, 1, 1);
        model.position.set(0, 0, 0);
        scene.add(model);
      },
      undefined,
      function (error) {
        console.error('Fehler beim Laden des 3D-Modells:', error);
      }
    );

    function animate() {
      requestAnimationFrame(animate);
      controls.update();
      renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', () => {
      camera.aspect = container.clientWidth / container.clientHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(container.clientWidth, container.clientHeight);
    });
  }
</script>
