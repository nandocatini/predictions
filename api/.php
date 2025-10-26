<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../db/config.php';

function call_api($endpoint, $params = []) {
    $url = API_FOOTBALL_ENDPOINT . $endpoint;
    if (!empty($params)) {
        $url .= '?'.http_build_query($params);
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-rapidapi-host: v3.football.api-sports.io',
        'x-rapidapi-key: ' . API_FOOTBALL_KEY
    ]);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode != 200) {
        error_log("API call failed for endpoint $endpoint with code $httpcode and response: $response");
        return null;
    }

    return json_decode($response, true);
}

function import_leagues() {
    $league_ids = [135, 136, 39, 40, 140, 141, 78, 79, 61, 62, 2, 3, 137];
    $pdo = db();
    $stmt = $pdo->prepare("INSERT INTO leagues (id, name, country, logo, current_season) VALUES (:id, :name, :country, :logo, :current_season) ON DUPLICATE KEY UPDATE name=:name, country=:country, logo=:logo, current_season=:current_season");

    foreach ($league_ids as $league_id) {
        $leagues_data = call_api('leagues', ['id' => $league_id]);

        if (!$leagues_data || empty($leagues_data['response'])) {
            echo "Failed to fetch data for league ID: $league_id\n";
            sleep(6);
            continue;
        }

        foreach ($leagues_data['response'] as $league_item) {
            $league = $league_item['league'];
            $country = $league_item['country'];
            $current_season = 2023; // Hardcoded to 2023 due to free plan limitations

            $stmt->execute([
                ':id' => $league['id'],
                ':name' => $league['name'],
                ':country' => $country['name'],
                ':logo' => $league['logo'],
                ':current_season' => $current_season
            ]);
            echo "Imported league: " . $league['name'] . "\n";
            if ($current_season > 0) {
                import_teams_by_league($league['id'], $current_season);
            }
        }
        sleep(6); // Wait 6 seconds between each league to respect rate limit
    }
}

function import_teams_by_league($league_id, $season) {
    $teams_data = call_api('teams', ['league' => $league_id, 'season' => $season]);

    if (!$teams_data || empty($teams_data['response'])) {
        echo "Failed to fetch teams for league $league_id.\n";
        return;
    }

    $pdo = db();
    $stmt = $pdo->prepare("INSERT INTO teams (id, name, logo) VALUES (:id, :name, :logo) ON DUPLICATE KEY UPDATE name=:name, logo=:logo");

    foreach ($teams_data['response'] as $team_item) {
        $team = $team_item['team'];
        $stmt->execute([
            ':id' => $team['id'],
            ':name' => $team['name'],
            ':logo' => $team['logo']
        ]);
    }
    echo "Imported teams for league $league_id.\n";
}

function import_fixtures() {
    $pdo = db();
    $leagues_stmt = $pdo->query("SELECT id, current_season FROM leagues WHERE current_season > 0");
    $leagues = $leagues_stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($leagues as $league) {
        $fixtures_data = call_api('fixtures', ['league' => $league['id'], 'season' => $league['current_season'], 'from' => date('Y-m-d'), 'to' => date('Y-m-d', strtotime('+1 week'))]);

        if (!$fixtures_data || empty($fixtures_data['response'])) {
            echo "No fixtures found for league {$league['id']} for the next week.\n";
            sleep(6);
            continue;
        }

        $stmt = $pdo->prepare("INSERT INTO events (id, league_id, home_team_id, away_team_id, event_date, status, home_score, away_score) VALUES (:id, :league_id, :home_team_id, :away_team_id, :event_date, :status, :home_score, :away_score) ON DUPLICATE KEY UPDATE event_date=:event_date, status=:status, home_score=:home_score, away_score=:away_score");

        foreach ($fixtures_data['response'] as $fixture) {
            $stmt->execute([
                ':id' => $fixture['fixture']['id'],
                ':league_id' => $fixture['league']['id'],
                ':home_team_id' => $fixture['teams']['home']['id'],
                ':away_team_id' => $fixture['teams']['away']['id'],
                ':event_date' => $fixture['fixture']['date'],
                ':status' => $fixture['fixture']['status']['short'],
                ':home_score' => $fixture['goals']['home'],
                ':away_score' => $fixture['goals']['away']
            ]);
        }
        echo "Imported fixtures for league {$league['id']}.\n";
        sleep(6); // Wait 6 seconds between each league to respect rate limit
    }
}
