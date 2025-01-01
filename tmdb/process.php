<?php
$apiKey = 'c86652f97c489795b397fa135daa51ea';  // Your TMDB API key

// Function to fetch data from the TMDB API
function fetchAPI($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['showName'])) {
    $showName = urlencode($_POST['showName']);
    $searchUrl = "https://api.themoviedb.org/3/search/tv?api_key=$apiKey&query=$showName";
    $searchData = fetchAPI($searchUrl);

    if (empty($searchData['results'])) {
        $error = "TV Show not found!";
    } else {
        $showId = $searchData['results'][0]['id'];
        $showName = $searchData['results'][0]['name'];
        $original_language = $searchData['results'][0]['original_language'];
        $posterPath = $searchData['results'][0]['poster_path']; // Get poster path
        $overview = $searchData['results'][0]['overview']; // Get poster path
        $seasonsUrl = "https://api.themoviedb.org/3/tv/$showId?api_key=$apiKey";
        $seasonsData = fetchAPI($seasonsUrl);
        $seasons = $seasonsData['seasons'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $showName;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container pt-5">
        <h1 class="mt-5 text-center name"><?php echo $showName; ?></h1>



        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if (isset($seasons)): ?>
        <div class="row">
            <!-- Season Details (Column 3) -->


            <!-- Seasons and Episodes (Column 9) -->
            <div class="col-md-12 season-container">
            <h3 class="text-center"><strong>Language:</strong> <?= ucfirst($original_language); ?> | <strong>Total Seasons:</strong> <?= count($seasons) ?></h3>
            <h3><strong>Overview:</strong> <?= $overview; ?></h4>
                <h3 class="season-title mt-4">Seasons and Episodes</h3>
                <?php foreach ($seasons as $season): ?>
                <?php
                        // Skip Season 0: Specials
                        if ($season['season_number'] == 0) {
                            continue;
                        }
                        ?>
                <div class="season-block mb-4">
                    <!-- <h5>Season <?= $season['season_number'] ?>: <?= $season['name'] ?></h5> -->
                    <h4> <?= $season['name'] ?></h4>

                    <?php
                            // Fetch episodes for this season
                            $seasonUrl = "https://api.themoviedb.org/3/tv/$showId/season/{$season['season_number']}?api_key=$apiKey";
                            $seasonEpisodes = fetchAPI($seasonUrl);
                            ?>

                    <div class="row">
                        <?php foreach ($seasonEpisodes['episodes'] as $episode) {
                                    $rating = $episode['vote_average'];
                                ?>
                        <div class="col-md-1 col-sm-6 mb-2 ">
                            <div class="episode-box ">
                                <div class="episode-rating py-2" style="background-color: 
                                        <?php
                                        if ($rating >  9) {
                                            echo "#44ce1b";
                                        } else if ($rating > 8 && $rating <= 9) {
                                            echo "#bbdb44";
                                        } else if ($rating > 7 && $rating <= 8) {
                                            echo "#f7e379";
                                        } else if ($rating > 6 && $rating <= 7) {
                                            echo "#f2a134";
                                        } else if ($rating <= 6) {
                                            echo "#e51f1f";
                                        }
                                        ?>;">
                                    <?php echo substr($rating, 0, 3); ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>

            <div class="col-md-12">

                <?php if (count($seasons) <= 11) { ?>
                <div class="d-flex justify-content-center">
                    <img src="https://image.tmdb.org/t/p/original/<?= $posterPath ?>" alt="Poster"
                        class="w-75 d-block mx-auto">
                </div>
                <?php } ?>

                <hr>
                <h2 class="text-center text-light">Download or Watch Online <?php echo $showName; ?> on
                    <u>FoldiousMovies</u>
                </h2>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>