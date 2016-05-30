<?php

Route::group(array('module' => 'Sites', 'namespace' => 'App\Modules\Sites\Controllers'), function() {

    Route::resource('sites', 'SitesController');
    
});	