<?php

use Illuminate\Http\Request;
use App\VideoStream;
// use Illuminate\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$countryList = array(
    array('label' => 'Finland', 'value' => 1),
    array('label' => 'Norway', 'value' => 2),
    array('label' => 'Sweden', 'value' => 3),
    array('label' => 'Denmark', 'value' => 4),
    array('label' => 'Iceland', 'value' => 5),
    array('label' => 'Germany', 'value' => 6),
);

$stateList = array(
    array('label' => 'Finland', 'value' => 1, 'country' => 'Finland'),
    array('label' => 'Norway', 'value' => 2, 'country' => 'Norway'),
    array('label' => 'Sweden', 'value' => 3, 'country' => 'Sweden'),
    array('label' => 'Denmark', 'value' => 4, 'country' => 'Denmark'),
    array('label' => 'Iceland', 'value' => 5, 'country' => 'Iceland'),
    array('label' => 'Germany', 'value' => 6, 'country' => 'Germany'),
);

$cityList = array(
    array('label' => 'Finland', 'value' => 1, 'state' => 'Finland'),
    array('label' => 'Norway', 'value' => 2, 'state' => 'Norway'),
    array('label' => 'Sweden', 'value' => 3, 'state' => 'Sweden'),
    array('label' => 'Denmark', 'value' => 4, 'state' => 'Denmark'),
    array('label' => 'Iceland', 'value' => 5, 'state' => 'Iceland'),
    array('label' => 'Germany', 'value' => 6, 'state' => 'Germany'),
);

$categoryList = array(
    'music' => array(
        array('_id' => 1, 'name' => 'Rock'),
        array('_id' => 2, 'name' => 'Soul'),
        array('_id' => 3, 'name' => 'Pop'),
        array('_id' => 4, 'name' => 'Grunge'),
        array('_id' => 5, 'name' => 'Indian'),
        array('_id' => 6, 'name' => 'Classic'),
        array('_id' => 7, 'name' => 'Alternative'),
        array('_id' => 8, 'name' => 'Heavy'),
    ),
);

Route::get('/countries', function (Request $request) use ($countryList) {
    error_log(json_encode(array('name' => 'error', 'values' => $countryList)));
    $searchTerm = $request->input('q');
    $results = array();
    foreach ($countryList as $country) {
        if (strpos($country['label'], $searchTerm) !== false) {
            array_push($results, $country);
        }
    }
    return json_encode($results);
});

Route::get('/states', function (Request $request) use ($stateList) {
    error_log(json_encode(array('name' => 'error', 'values' => $stateList)));
    $searchTerm = $request->input('q');
    $country = $request->input('country');
    $results = array();
    foreach ($stateList as $state) {
        if (strpos($state['label'], $searchTerm) !== false && ( $country === $state['country'] || $country === '')) {
            array_push($results, $state);
        }
    }
    return json_encode($results);
});

Route::get('/cities', function (Request $request) use ($cityList) {
    error_log(json_encode(array('name' => 'error', 'values' => $cityList)));
    $searchTerm = $request->input('q');
    $state = $request->input('state');
    $results = array();
    foreach ($cityList as $city) {
        if (strpos($city['label'], $searchTerm) !== false && ( $state === $city['state'] || $state === '')) {
            array_push($results, $city);
        }
    }
    return json_encode($results);
});

Route::get('/getcategsxsubcategs', function (Request $request) use ($categoryList) {
    $category = $request->input('category');
    if ($category && array_key_exists($category, $categoryList) === TRUE) {
        return json_encode($categoryList[$category]);
    }
    return json_encode([]);
});

Route::get('/assets/{assetDir}/{assetName}', function (Request $request, $assetsDir, $assetName) {
    $outDir = '../storage/app/';
    $assetPath = $assetsDir . '/' . $assetName;
    $uri = $outDir . $assetPath;
    $fp = fopen($uri, 'rb');
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($uri));
    echo fpassthru($fp);
    fclose($fp);
});

Route::get('/stream/{assetDir}/{assetName}', function (Request $request, $assetsDir, $assetName) {
    $outDir = '../storage/app/';
    $assetPath = $assetsDir . '/' . $assetName;
    $uri = $outDir . $assetPath;
    $stream = new VideoStream($uri);
    $stream->start();
});

/* Mocks */

Route::get('/mock_retrieve_suggestions_prospects', function (Request $request) {
    // Not used in mock but it test that the user it is not empty
    $userId = $request->input('userId');
    if (!$userId) {
        return json_encode(array('status' => 'fail', 'errors' => ['Invalid user id'], 'videos' => []));
    }
    $array = array(
        array(
            'id' => '1',
            'userName' => 'Brittany Laqurell',
            'uri' => 'videos/mock_video_one.mp4',
        ),
        array(
            'id' => '2',
            'userName' => 'Jimena Mitchel',
            'uri' => 'videos/mock_video_one.mp4',
        ),
        array(
            'id' => '3',
            'userName' => 'Sara Rivers',
            'uri' => 'videos/mock_video_two.mp4',
        ),
    );
    return json_encode(array('status' => 'success', 'errors' => [], 'videos' => $array));
});

Route::get('/mock_retrieve_meta_results', function (Request $request) {
    // Not used in mock but it test that the user it is not empty
    $userId = $request->input('userId');
    if (!$userId) {
        return json_encode(array('status' => 'fail', 'errors' => ['Invalid user id'], 'videos' => []));
    }
    $array = array(
        'followers' => 
            array(
                array(
                    'email' => 'a@gmail.com', 
                    'name' => 'Antonine Francu', 
                    'category' => 'Music',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            ),
        'following' => array(
                array(
                    'email' => 'b@gmail.com', 
                    'name' => 'Le Blue-dijon', 
                    'category' => 'Music',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            ),
        'views' => array(
                array(
                    'email' => 'c@gmail.com', 
                    'name' => 'Mara Pajovic', 
                    'category' => 'Music',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            ),
        'favs' => 
            array(
                array(
                    'email' => 'd@gmail.com', 
                    'name' => 'Kato Yubric', 
                    'category' => 'Music',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            ),
    );
    return json_encode(array('status' => 'success', 'errors' => [], 'users_list' => $array));
});

Route::get('mock_retrieve_talent_complete_information', function(Request $request) {
    $talentId = $request->input('talentId');
    if (!$talentId) {
        return json_encode(array('status' => 'fail', 'errors' => ['Invalid talent identifier can not proceed.'], 'results' => []));
    }
    $results = array(
        'name' => 'Brittany Laqurell',
        'gender' => 'female',
        'yob' => '1998',
        'country' => 'Finland',
        'state' => 'Lapland',
        'city' => 'Printemps',
        'categories' => array('Music', 'Dance', 'Sports'),
        'subCategories' => array('Guitar', 'Salsa dance', 'Baseball'),
        'level' => 'Amateur',
        'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg',
        'videos' => array(),
        'meta_info' => array(
            'views' => 1,
            'followers' => 3,
            'following' => 9,
            'connections' => 5,
        )
    );
    // Load the videos
    $findVideos = array(
        'videos/mock_video_one.mp4',
        'videos/mock_video_one.mp4',
        'videos/mock_video_two.mp4',
    );
    foreach ($findVideos as $video) {
        array_push($results['videos'], $video);
    }
    return json_encode(
        array(
            'status' => 'success', 
            'errors' => [], 
            'results' => $results
        )
    );
});