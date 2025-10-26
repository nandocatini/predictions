<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pronostici Calcio</title>
    <meta name="description" content="Applicazione per previsioni di risultati calcistici dei principali campionati europei. Built with Flatlogic Generator.">
    <meta name="keywords" content="pronostici, calcio, scommesse, serie a, premier league, liga, bundesliga, ligue 1, quote, risultati, Built with Flatlogic Generator">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Pronostici Calcio">
    <meta property="og:description" content="Applicazione per previsioni di risultati calcistici dei principali campionati europei. Built with Flatlogic Generator.">
    <meta property="og:image" content="<?php echo $_SERVER['PROJECT_IMAGE_URL']; ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Pronostici Calcio">
    <meta property="twitter:description" content="Applicazione per previsioni di risultati calcistici dei principali campionati europei. Built with Flatlogic Generator.">
    <meta property="twitter:image" content="<?php echo $_SERVER['PROJECT_IMAGE_URL']; ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="assets/css/custom.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>
<body>

    <header class="header-gradient p-4 mb-4 text-center">
        <h1 class="display-4"><i class="bi bi-trophy-fill"></i> Pronostici Calcio</h1>
        <p class="lead">Le tue previsioni sportive a portata di click</p>
    </header>

    <main class="container">
        <div class="card p-3 mb-4">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <label for="date-picker" class="form-label fw-bold">Seleziona una data:</label>
                </div>
                <div class="col-md-9">
                    <input type="date" id="date-picker" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs" id="leagueTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="serie-a-tab" data-bs-toggle="tab" data-bs-target="#serie-a" type="button" role="tab" aria-controls="serie-a" aria-selected="true">Serie A</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="premier-league-tab" data-bs-toggle="tab" data-bs-target="#premier-league" type="button" role="tab" aria-controls="premier-league" aria-selected="false">Premier League</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="la-liga-tab" data-bs-toggle="tab" data-bs-target="#la-liga" type="button" role="tab" aria-controls="la-liga" aria-selected="false">La Liga</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bundesliga-tab" data-bs-toggle="tab" data-bs-target="#bundesliga" type="button" role="tab" aria-controls="bundesliga" aria-selected="false">Bundesliga</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ligue-1-tab" data-bs-toggle="tab" data-bs-target="#ligue-1" type="button" role="tab" aria-controls="ligue-1" aria-selected="false">Ligue 1</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="serie-b-tab" data-bs-toggle="tab" data-bs-target="#serie-b" type="button" role="tab" aria-controls="serie-b" aria-selected="false">Serie B</button>
            </li>
        </ul>

        <div class="tab-content p-3 card" id="leagueTabsContent">
            <div class="tab-pane fade show active" id="serie-a" role="tabpanel" aria-labelledby="serie-a-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
            <div class="tab-pane fade" id="premier-league" role="tabpanel" aria-labelledby="premier-league-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
            <div class="tab-pane fade" id="la-liga" role="tabpanel" aria-labelledby="la-liga-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
            <div class="tab-pane fade" id="bundesliga" role="tabpanel" aria-labelledby="bundesliga-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
            <div class="tab-pane fade" id="ligue-1" role="tabpanel" aria-labelledby="ligue-1-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
            <div class="tab-pane fade" id="serie-b" role="tabpanel" aria-labelledby="serie-b-tab">
                <p class="text-center text-muted mt-3">Nessun evento in programma per la data selezionata.</p>
            </div>
        </div>
    </main>

    <footer class="text-center text-muted py-4 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Pronostici Calcio. Tutti i diritti riservati.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>