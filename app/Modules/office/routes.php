<?php

Route::group(array('module' => 'Office', 'namespace' => 'App\Modules\Office\Controllers'), function() {

    Route::resource('office', 'OfficeController');
    
});	