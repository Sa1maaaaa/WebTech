<?php include 'includes/header.php'; ?>

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <span class="hero-badge">Dein persönlicher Reise-Konfigurator</span>
                <h1 class="hero-title mt-3">Plane deine Traumreise mit TravelCraft</h1>
                <p class="hero-text mt-3">
                    Stelle deine Reise in wenigen Schritten zusammen. Wähle dein Reiseziel,
                    die passende Unterkunft und zusätzliche Extras – und speichere deine
                    Konfiguration bequem in deinem Benutzerkonto.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="configurator.php" class="btn btn-warning btn-lg">Jetzt konfigurieren</a>
                    <a href="register.php" class="btn btn-outline-light btn-lg">Registrieren</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-media" style="position: relative;">
                    <img
                        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80"
                        alt="Strandurlaub"
                        class="img-fluid hero-image"
                    >

                    <!-- 3D model flies in and out above the image -->
                    <model-viewer
                        id="hero-model"
                        class="hero-3d"
                        src="assets/models/ace_combat_7_b-52h_stratofortress.glb"
                        alt="3D Modell"
                        camera-controls
                        exposure="1"
                        interaction-prompt="none"
                        ></model-viewer>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">So funktioniert's</h2>
            <p class="section-subtitle">
                In nur drei einfachen Schritten zu deiner individuellen Reise.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-number">1</div>
                    <h4>Reiseziel auswählen</h4>
                    <p>Entscheide dich aus vielen attraktiven Reisezielen weltweit.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-number">2</div>
                    <h4>Unterkunft bestimmen</h4>
                    <p>Wähle die Unterkunft, die am besten zu deinem Budget und Stil passt.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feature-number">3</div>
                    <h4>Extras hinzufügen</h4>
                    <p>Ergänze deine Reise mit Frühstück, Transfer, Mietwagen und mehr.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="destinations-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Beliebte Reiseziele</h2>
            <p class="section-subtitle">
                Lass dich inspirieren und starte direkt deine Konfiguration.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="destination-card">
                    <img
                        src="https://images.unsplash.com/photo-1464790719320-516ecd75af6c?auto=format&fit=crop&w=900&q=80"
                        alt="Spanien"
                        class="destination-img"
                    >
                    <div class="destination-body">
                        <h5>Spanien</h5>
                        <p>Sonne, Strand und mediterranes Flair.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="destination-card">
                    <img
                        src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=900&q=80"
                        alt="Italien"
                        class="destination-img"
                    >
                    <div class="destination-body">
                        <h5>Italien</h5>
                        <p>Kultur, Kulinarik und traumhafte Städte.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="destination-card">
                    <img
                        src="https://images.unsplash.com/photo-1518684079-3c830dcef090?auto=format&fit=crop&w=900&q=80"
                        alt="Thailand"
                        class="destination-img"
                    >
                    <div class="destination-body">
                        <h5>Thailand</h5>
                        <p>Exotik, Abenteuer und paradiesische Strände.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="configurator.php" class="btn btn-primary btn-lg">Reise jetzt starten</a>
        </div>
    </div>
</section>

<!-- load model-viewer only on the homepage where we use it -->
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const model = document.getElementById('hero-model');
    if (!model) return;

    // Use a single animate class that triggers the CSS keyframe path.
    // Small delay so the page paints first.
    setTimeout(() => model.classList.add('animate'), 180);

    
</script>

<?php include 'includes/footer.php'; ?>