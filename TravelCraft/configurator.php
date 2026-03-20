<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/header.php';

$destinations = [
    "Spanien" => 500,
    "Italien" => 550,
    "Portugal" => 520,
    "Frankreich" => 600,
    "Griechenland" => 650,
    "Türkei" => 580,
    "Marokko" => 620,
    "Ägypten" => 700,
    "Dubai" => 1200,
    "USA" => 1400,
    "Kanada" => 1350,
    "Mexiko" => 1100,
    "Thailand" => 1250,
    "Japan" => 1500,
    "Südkorea" => 1450,
    "Indonesien" => 1300,
    "Malediven" => 1700,
    "Kroatien" => 560,
    "Niederlande" => 480,
    "Österreich" => 450,
    "Schweiz" => 650,
    "Schweden" => 800,
    "Norwegen" => 900,
    "England" => 700
];

$accommodations = [
    "Hotel" => 120,
    "Hostel" => 50,
    "Ferienwohnung" => 90,
    "Resort" => 180,
    "Villa" => 250
];

$extras = [
    "Frühstück" => 20,
    "Transfer" => 35,
    "Mietwagen" => 60,
    "Reiseversicherung" => 25,
    "Spa" => 40,
    "Meerblick" => 30,
    "Ausflugspaket" => 50
];
?>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="section-title">Reise-Konfigurator</h1>
        <p class="section-subtitle">Stelle deine persönliche Reise in drei Schritten zusammen.</p>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="feature-card">
                <form action="save_trip.php" method="POST">
                <div class="mb-4">
    <label class="form-label fw-bold">1. Reiseziel suchen</label>
    <input
        type="text"
        id="destination_search"
        class="form-control mb-3"
        placeholder="Ziel eingeben, z. B. Spanien oder Dubai"
    >

    <label class="form-label fw-bold">Reiseziel wählen</label>
    <select name="destination" id="destination" class="form-select" required>
        <option value="">Bitte auswählen</option>
        <?php foreach ($destinations as $destination => $price): ?>
            <option value="<?= htmlspecialchars($destination) ?>" data-price="<?= $price ?>">
                <?= htmlspecialchars($destination) ?> (ab <?= $price ?> €)
            </option>
        <?php endforeach; ?>
    </select>
</div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">2. Unterkunft wählen</label>
                        <select name="accommodation" id="accommodation" class="form-select" required>
                            <option value="">Bitte auswählen</option>
                            <?php foreach ($accommodations as $accommodation => $price): ?>
                                <option value="<?= htmlspecialchars($accommodation) ?>" data-price="<?= $price ?>">
                                    <?= htmlspecialchars($accommodation) ?> (<?= $price ?> € / Nacht)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">3. Extras hinzufügen</label>
                        <?php foreach ($extras as $extra => $price): ?>
                            <div class="form-check">
                                <input
                                    class="form-check-input extra-checkbox"
                                    type="checkbox"
                                    name="extras[]"
                                    value="<?= htmlspecialchars($extra) ?>"
                                    data-price="<?= $price ?>"
                                    id="<?= md5($extra) ?>"
                                >
                                <label class="form-check-label" for="<?= md5($extra) ?>">
                                    <?= htmlspecialchars($extra) ?> (+ <?= $price ?> €)
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Reisedauer (Tage)</label>
                        <input type="number" name="travel_days" id="travel_days" class="form-control" min="1" value="5" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Gutscheincode</label>
                        <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="z. B. SUMMER10">
                        <div class="form-text">Mit SUMMER10 erhältst du 10 % Rabatt.</div>
                    </div>

                    <input type="hidden" name="total_price" id="total_price_input" value="0">

                    <button type="submit" class="btn btn-primary btn-lg w-100">Reise speichern</button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
        <div class="feature-card">
    <h3 class="mb-4">Zusammenfassung</h3>

    <img
        id="destination_image"
        src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80"
        alt="Reiseziel"
        class="img-fluid rounded mb-4"
        style="height: 220px; width: 100%; object-fit: cover;"
    >

    <p><strong>Reiseziel:</strong> <span id="summary_destination">-</span></p>
    <p><strong>Unterkunft:</strong> <span id="summary_accommodation">-</span></p>
    <p><strong>Extras:</strong> <span id="summary_extras">Keine</span></p>
    <p><strong>Reisedauer:</strong> <span id="summary_days">5</span> Tage</p>
    <hr>
    <p class="fs-4 fw-bold">Gesamtpreis: <span id="summary_price">0 €</span></p>
</div>
        </div>
    </div>
</div>

<script>
    const destinationSearch = document.getElementById('destination_search');
const destinationSelect = document.getElementById('destination');
const accommodationSelect = document.getElementById('accommodation');
const extraCheckboxes = document.querySelectorAll('.extra-checkbox');
const travelDaysInput = document.getElementById('travel_days');
const couponInput = document.getElementById('coupon_code');

const summaryDestination = document.getElementById('summary_destination');
const summaryAccommodation = document.getElementById('summary_accommodation');
const summaryExtras = document.getElementById('summary_extras');
const summaryDays = document.getElementById('summary_days');
const summaryPrice = document.getElementById('summary_price');
const totalPriceInput = document.getElementById('total_price_input');
const destinationImage = document.getElementById('destination_image');

const destinationImages = {
    "Spanien": "https://images.unsplash.com/photo-1464790719320-516ecd75af6c?auto=format&fit=crop&w=1200&q=80",
    "Italien": "https://images.unsplash.com/photo-1499856871958-5b9627545d1a?auto=format&fit=crop&w=1200&q=80",
    "Portugal": "https://images.unsplash.com/photo-1513735492246-483525079686?auto=format&fit=crop&w=1200&q=80",
    "Frankreich": "https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80",
    "Griechenland": "https://images.unsplash.com/photo-1503152394-c571994fd383?auto=format&fit=crop&w=1200&q=80",
    "Türkei": "https://images.unsplash.com/photo-1527838832700-5059252407fa?auto=format&fit=crop&w=1200&q=80",
    "Marokko": "https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=1200&q=80",
    "Ägypten": "https://images.unsplash.com/photo-1539650116574-75c0c6d73f3f?auto=format&fit=crop&w=1200&q=80",
    "Dubai": "https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80",
    "USA": "https://images.unsplash.com/photo-1496588152823-86ff7695f25f?auto=format&fit=crop&w=1200&q=80",
    "Kanada": "https://images.unsplash.com/photo-1503614472-8c93d56e92ce?auto=format&fit=crop&w=1200&q=80",
    "Mexiko": "https://images.unsplash.com/photo-1512813195386-6cf811ad3542?auto=format&fit=crop&w=1200&q=80",
    "Thailand": "https://images.unsplash.com/photo-1519451241324-20b4ea2c4220?auto=format&fit=crop&w=1200&q=80",
    "Japan": "https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?auto=format&fit=crop&w=1200&q=80",
    "Südkorea": "https://images.unsplash.com/photo-1538485399081-7c8977f1b75f?auto=format&fit=crop&w=1200&q=80",
    "Indonesien": "https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=1200&q=80",
    "Malediven": "https://images.unsplash.com/photo-1573843981267-be1999ff37cd?auto=format&fit=crop&w=1200&q=80",
    "Kroatien": "https://images.unsplash.com/photo-1555990538-17392d0f6f4c?auto=format&fit=crop&w=1200&q=80",
    "Niederlande": "https://images.unsplash.com/photo-1534351590666-13e3e96b5017?auto=format&fit=crop&w=1200&q=80",
    "Österreich": "https://images.unsplash.com/photo-1516550893923-42d28e5677af?auto=format&fit=crop&w=1200&q=80",
    "Schweiz": "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80",
    "Schweden": "https://images.unsplash.com/photo-1509356843151-3e7d96241e11?auto=format&fit=crop&w=1200&q=80",
    "Norwegen": "https://images.unsplash.com/photo-1513519245088-0e12902e5a38?auto=format&fit=crop&w=1200&q=80",
    "England": "https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?auto=format&fit=crop&w=1200&q=80"
};

function calculatePrice() {
    let destinationPrice = 0;
    let accommodationPrice = 0;
    let extrasPrice = 0;
    let days = parseInt(travelDaysInput.value) || 1;

    if (destinationSelect.selectedIndex > 0) {
    destinationPrice = parseFloat(destinationSelect.options[destinationSelect.selectedIndex].dataset.price);
    summaryDestination.textContent = destinationSelect.value;

    if (destinationImages[destinationSelect.value]) {
        destinationImage.src = destinationImages[destinationSelect.value];
    }
} else {
    summaryDestination.textContent = '-';
}

    if (accommodationSelect.selectedIndex > 0) {
        accommodationPrice = parseFloat(accommodationSelect.options[accommodationSelect.selectedIndex].dataset.price);
        summaryAccommodation.textContent = accommodationSelect.value;
    } else {
        summaryAccommodation.textContent = '-';
    }

    let selectedExtras = [];
    extraCheckboxes.forEach(checkbox => {
        if (checkbox.checked) {
            extrasPrice += parseFloat(checkbox.dataset.price);
            selectedExtras.push(checkbox.value);
        }
    });

    summaryExtras.textContent = selectedExtras.length ? selectedExtras.join(', ') : 'Keine';
    summaryDays.textContent = days;

    let total = destinationPrice + (accommodationPrice * days) + extrasPrice;

    if (couponInput.value.trim().toUpperCase() === 'SUMMER10') {
        total = total * 0.9;
    }

    total = total.toFixed(2);

    summaryPrice.textContent = total + ' €';
    totalPriceInput.value = total;
}

destinationSelect.addEventListener('change', calculatePrice);
accommodationSelect.addEventListener('change', calculatePrice);
extraCheckboxes.forEach(checkbox => checkbox.addEventListener('change', calculatePrice));
travelDaysInput.addEventListener('input', calculatePrice);
couponInput.addEventListener('input', calculatePrice);

calculatePrice();
destinationSearch.addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();

    for (let i = 0; i < destinationSelect.options.length; i++) {
        const option = destinationSelect.options[i];

        if (i === 0) {
            option.hidden = false;
            continue;
        }

        const text = option.value.toLowerCase();
        option.hidden = !text.includes(searchTerm);
    }
});
const originalDestinationOptions = Array.from(destinationSelect.options).slice(1).map(option => ({
    value: option.value,
    price: option.dataset.price,
    text: option.textContent
}));

destinationSearch.addEventListener('input', function () {
    const searchTerm = this.value.toLowerCase();

    destinationSelect.innerHTML = '<option value="">Bitte auswählen</option>';

    const filteredOptions = originalDestinationOptions.filter(option =>
        option.value.toLowerCase().includes(searchTerm)
    );

    filteredOptions.forEach(option => {
        const newOption = document.createElement('option');
        newOption.value = option.value;
        newOption.textContent = option.text;
        newOption.dataset.price = option.price;
        destinationSelect.appendChild(newOption);
    });

    calculatePrice();
});
</script>

<?php include 'includes/footer.php'; ?>