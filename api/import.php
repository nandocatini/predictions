<?php
set_time_limit(300); // Increase execution time limit

require_once __DIR__ . '/handler.php';

echo "<pre>";
echo "Starting import process...\n";

// 1. Import all leagues and their teams
import_leagues();

// 2. Import fixtures for the upcoming week
import_fixtures();

echo "Import process finished.\n";
echo "</pre>";