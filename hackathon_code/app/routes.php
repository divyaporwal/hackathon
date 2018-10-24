<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * 
 * for hackhathon coding
 */

/** image_Review **/
Route::get('images/review',
    array(
        'as' => 'image_review',
        'uses' => 'ImageController@listToReviewImage'
    )
);

Route::get('images/unresolved',
    array(
        'as' => 'image_review',
        'uses' => 'ImageController@listUnresolvedIssues'
    )
);

Route::get('images/processed',
    array(
        'as' => 'image_review',
        'uses' => 'ImageController@listProcessedImage'
    )
);


Route::get('/issue_detail/{id}',
    array(
        'as' => 'image_review',
        'uses' => 'ImageController@viewDetail'
    )
);

Route::get('/review_detail/{id}',
    array(
        'as' => 'image_review',
        'uses' => 'ImageController@viewReviewDetail'
    )
);

Route::get('images/resolved',
        array(
            'as' => 'image_review',
            'uses' => 'ImageController@listResolvedIssues'
        )
);

Route::get('/assign_worker',
    array(
        'as' => 'assign_worker',
        'uses' => 'ImageController@addWorker'
    )   
);

Route::get('/validate',
    array(
        'as' => 'validate',
        'uses' => 'ImageController@validateImage'
    )   
);

Route::get('/resolve',
    array(
        'as' => 'resolve',
        'uses' => 'ImageController@resolveTask'
    )   
);
Route::when('*', 'csrf', array('post'));
/***** Home *****/
Route::get('user_dashboard',
	array(
		'as' => 'dashboard',
		/*function() {
			if(Auth::user()) {
				return Redirect::route('user_dashboard');
			} else {
				return View::make('user_dashboard');
			}
		}*/
                'uses' => 'UserDashboardController@showDashBoard'
	)
);



























