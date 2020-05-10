<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\VideoStream;
use App\Data;
use App\Http\Controllers\HomeController;
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
    array('label' => 'Finland', 'value' => 1, 'country' => '1', 'country_name' => 'Finland'),
    array('label' => 'Norway', 'value' => 2, 'country' => '2', 'country_name' => 'Norway'),
    array('label' => 'Sweden', 'value' => 3, 'country' => '3', 'country_name' => 'Sweden'),
    array('label' => 'Denmark', 'value' => 4, 'country' => '4', 'country_name' => 'Denmark'),
    array('label' => 'Iceland', 'value' => 5, 'country' => '5', 'country_name' => 'Iceland'),
    array('label' => 'Germany', 'value' => 6, 'country' => '6', 'country_name' => 'Germany'),
);

$cityList = array(
    array('label' => 'Finland', 'value' => 1, 'state' => '1', 'state_name' => 'Finland'),
    array('label' => 'Norway', 'value' => 2, 'state' => '2', 'state_name' => 'Norway'),
    array('label' => 'Sweden', 'value' => 3, 'state' => '3', 'state_name' => 'Sweden'),
    array('label' => 'Denmark', 'value' => 4, 'state' => '4', 'state_name' => 'Denmark'),
    array('label' => 'Iceland', 'value' => 5, 'state' => '5', 'state_name' => 'Iceland'),
    array('label' => 'Germany', 'value' => 6, 'state' => '6', 'state_name' => 'Germany'),
);

$recruiterJobs = array(
    array(
        'title' => 'Dispatcher',
        'description' => 'Is a dispatcher that dispatch dispatches for all of the dispatched people out there',
        'requirements' => 'ABC',
        'category' => 'music',
        'subcategory' => 1,
        'country' => 'Finland',
        'state' => 'Finland',
        'city' => 'Finland',
        'job_type' => 'full-time',
        'level' => 'intermediate',
        'creation_time' => date("Y-m-d H:i:s.u"),
    )
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
    if (!$searchTerm) {
        return json_encode($countryList);
    }
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
    if(!$searchTerm) {
        return array_filter($stateList, function($state) use ($country) {
            error_log('country filter ' . json_encode($country));
            return $country === $state['country'];
        }, ARRAY_FILTER_USE_BOTH);
    }
    $results = array();
    foreach ($stateList as $state) {
        if (strpos($state['label'], $searchTerm) !== false && ( $country === $state['country_name'] || $country === '')) {
            array_push($results, $state);
        }
    }
    return json_encode($results);
});

Route::get('/cities', function (Request $request) use ($cityList) {
    error_log(json_encode(array('name' => 'error', 'values' => $cityList)));
    $searchTerm = $request->input('q');
    $state = $request->input('state');
    if(!$searchTerm) {
        return array_filter($cityList, function($city) use ($state) {
            return $state === $city['state'];
        }, ARRAY_FILTER_USE_BOTH);
    }
    $results = array();
    foreach ($cityList as $city) {
        if (strpos($city['label'], $searchTerm) !== false && ( $state === $city['state_name'] || $state === '')) {
            array_push($results, $city);
        }
    }
    return json_encode($results);
});

Route::get('/categories', function (Request $request) use ($categoryList) {
    $keys = array_keys($categoryList);
    $values = array_map('ucfirst', $keys);
    $results = array();
    for ($i = 0 ; $i < count($keys) ; $i++ ) {
        array_push($results, 
            array(
                $keys[$i] => $values[$i],
            )
        );
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

Route::get('mock_retrieve_own_jobs', function(Request $request) use (
    $recruiterJobs, 
    $countryList, 
    $stateList,
    $cityList) {
    $recruiterJobs = DB::table('data'
        )->where([
            ['is_job', 'true'],
        ])->get();
    $results = array();
    foreach($recruiterJobs as $job) {
        $object = new stdClass();
        $object->title = $job->job_title;
        $object->description = $job->job_description;
        $object->country = $job->job_country;
        $object->state = $job->job_state;
        $object->city = $job->job_city;
        $object->creation_time = $job->job_creation_time;
        array_push($results, $object);
    }
    foreach($results as $job) {
        $countryId = $job->country;
        $stateId = $job->state;
        $cityId = $job->city;
        $createdAt = $job->creation_time;
        $country = array_filter(
            $countryList,
            function ($e) use (&$countryId) {
                return $e['value'] == $countryId;
            }
        );
        $state = array_filter(
            $stateList,
            function ($e) use (&$stateId) {
                return $e['value'] == $stateId;
            }
        );
        $city = array_filter(
            $cityList,
            function ($e) use (&$cityId) {
                return $e['value'] == $cityId;
            }
        );
        $job->creation_timestamp = strtotime($job->creation_time);
        $createdAt = Carbon::parse($createdAt);
        $job->creation_time = $createdAt->diffForHumans();
        $country = array_values($country)[0];
        $state = array_values($state)[0];
        $city = array_values($city)[0];
        $job->country = $country['label'];
        $job->state = $state['label'];
        $job->city = $city['label'];
    }
    return json_encode(
        array(
            'status' => 'success', 
            'errors' => [], 
            'results' => $results
        )
    );
});

Route::post('mock_store_jobs', function(Request $request) use ($recruiterJobs) {
    $jobData = $request->all();
    $newJob = array(
        'is_job' => "true",
        'job_title' => $jobData['title'],
        'job_description' => $jobData['description'],
        'job_requirements' => $jobData['requirements'],
        'job_category' => $jobData['category'],
        'job_subcategory' => strval($jobData['subcategory']),
        'job_country' => $jobData['country'],
        'job_state' => $jobData['state'],
        'job_city' => $jobData['city'],
        'job_type' => $jobData['job_type'],
        'level' => $jobData['level']
    );
    $dbResult = Data::insert($newJob);
    return json_encode(array(
        'status' => 'success',
        'errors' => [], 
        'results' => $dbResult
    ));
});

Route::get('retrieve_connection_list_recruiter', function(Request $request) {
    return json_encode(array(
        'status' => 'success',
        'errors' => [], 
        'results' 
            => array(
                array(
                    'email' => 'b@gmail.com', 
                    'name' => 'Le Blue-dijon 1', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'a@gmail.com', 
                    'name' => 'Le Blue-dijon 2', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'c@gmail.com', 
                    'name' => 'Le Blue-dijon 3', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'd@gmail.com', 
                    'name' => 'Le Blue-dijon 4', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'e@gmail.com', 
                    'name' => 'Le Blue-dijon 5', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'f@gmail.com 6', 
                    'name' => 'Le Blue-dijon', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'g@gmail.com', 
                    'name' => 'Le Blue-dijon 7', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'h@gmail.com', 
                    'name' => 'Le Blue-dijon 8', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'i@gmail.com', 
                    'name' => 'Le Blue-dijon 9', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'j@gmail.com', 
                    'name' => 'Le Blue-dijon 10', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'k@gmail.com', 
                    'name' => 'Le Blue-dijon 11', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'l@gmail.com', 
                    'name' => 'Le Blue-dijon 12', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'm@gmail.com', 
                    'name' => 'Le Blue-dijon 13', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'n@gmail.com', 
                    'name' => 'Le Blue-dijon 14', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
                array(
                    'email' => 'o@gmail.com', 
                    'name' => 'Le Blue-dijon 15', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            )
    ));
});

Route::get('retrieve_connection_suggestions', function(Request $request) {
    return json_encode([]);
});

Route::get('retrieve_connection_suggestions', function(Request $request) {
    return json_encode(
        array(
            'status' => 'success',
            'errors' => [], 
            'results' => array(
                array(
                    'email' => 'o@gmail.com', 
                    'name' => 'Le Blue-dijon 15', 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                ),
            ),
        )
    );
});

Route::post('delete-user', function(Request $request) {
    error_log('user deleted');
    $controller = new HomeController;
    return json_encode($controller->deleteAccount());
});

Route::get('retrieve_conversation_threads', function(Request $request) {
    // return json_encode(array(
    //     'status' => 'success',
    //     'errors' => [], 
    //     'results' => array(
    //         array(
    //             'name' => 'Le Blue-dijon 1', 
    //             'category' => 'Music',
    //             'subcategory' => 'Rock',
    //             'recruiter_type' => NULL,
    //             'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg',
    //             'thread_id' => 1,
    //             'message_preview' => 'This was my last message send.'
    //         ),
    //         array(
    //             'name' => 'Le Blue-dijon 2', 
    //             'category' => 'Music',
    //             'subcategory' => 'Rock',
    //             'recruiter_type' => NULL,
    //             'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg',
    //             'thread_id' => 1,
    //             'message_preview' => 'This was my last message send.'
    //         ),
    //         array(
    //             'name' => 'Le Blue-dijon 3', 
    //             'category' => 'Music',
    //             'subcategory' => 'Rock',
    //             'recruiter_type' => NULL,
    //             'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg',
    //             'thread_id' => 1,
    //             'message_preview' => 'This was my last message send.'
    //         ),
    //     ),
    // ));
    $results = array();
    $ctr = 1;
    $threads = DB::table('conversation_thread')->select('*')->get();
    foreach ($threads as $thread) {
        array_push(
            $results,
            array(
                'thread_id' => 1,
                'message' => 'Test.',
                'user' => array(
                    'name' => "Le Blue-dijon {$ctr}", 
                    'category' => 'Music',
                    'subcategory' => 'Rock',
                    'recruiter_type' => NULL,
                    'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
                )
            ),
        );
        $ctr += 1;
    }
    return json_encode(
        array(
            'status' => 'success',
            'errors' => [], 
            'results' => $results,
        )
    );
});

Route::get('mock_retrieve_search_results', function(Request $request) {
    $results = array();
    $search_filters = $request->input('searchTerms');
    if ($search_filters == NULL) {
        array(
            'status' => 'success',
            'errors' => [], 
            'results' => [],
        );
    }

    $searchedContent = array(
        array(
            'email' => 'n@gmail.com', 
            'name' => 'Le Blue-dijon 14', 
            'category' => 'Music',
            'subcategory' => 'Rock',
            'recruiter_type' => NULL,
            'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
        ),
        array(
            'email' => 'o@gmail.com', 
            'name' => 'Job Vacant', 
            'category' => 'Music',
            'subcategory' => 'Rock',
            'recruiter_type' => NULL,
            'picture_uri' => 'images/B4pE5JWHNqqCk5RHX81p34blPGVTRQ.jpg'
        ),
    );

    foreach ($searchedContent as $s) {
        array_push($results,$s);
    }
    return json_encode(
        array(
            'status' => 'success',
            'errors' => [], 
            'results' => $results,
        )
    );
});

Route::post('retrieve_thread_messages', function(Request $request) {
    $input = $request->input('thread_id');
    $results = DB::table('conversation_message')->where([['thread_id', strval($input)]])->get();
    return json_encode(
        array(
            'status' => 'success',
            'errors' => [], 
            'results' => $results,
        )
    );
});