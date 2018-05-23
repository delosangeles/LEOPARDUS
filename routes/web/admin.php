<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::get('/', 'AdminController@index')->name('admin.index');
    
    Route::group(['prefix' => 'settings'], function() {

        Route::get('/', 
            'AdminController@settings')->name('admin.settings');

        Route::put('/update', 
            'AdminController@updateSettings')->name('admin.settings.update');

        Route::get('/auth', 
            'AdminController@auth')->name('admin.settings.auth');

        Route::put('/auth/update', 
            'AdminController@updateAuth')->name('admin.settings.auth.update');

        Route::get('/action-menu', 
            'AdminController@actionMenu')->name('admin.settings.action-menu');

        Route::match(['post', 'put'], '/action-menu/save/{id?}', 
            'AdminController@saveActionMenu')->name('admin.settings.action-menu.save')
            ->where('id', '[0-9]+');

        Route::get('/sidebar', 
            'AdminController@sidebar')->name('admin.settings.sidebar');

        Route::match(['post', 'put'], '/sidebar/save/{id?}', 
            'AdminController@saveSidebar')->name('admin.settings.sidebar.save')
            ->where('id', '[0-9]+');
        
    });

    Route::group(['prefix' => 'security'], function() {

        Route::get('/users', 
            'AdminController@users')->name('admin.security.users');

        Route::match(['post', 'put'], '/users/save/{id?}', 
            'AdminController@saveUsers')->name('admin.security.users.save')
            ->where('id', '[0-9]+');

        Route::delete('/users/delete', 
            'AdminController@deleteUsers')->name('admin.security.users.delete');

        Route::get('/roles', 
            'AdminController@roles')->name('admin.security.roles');

        Route::match(['post', 'put'], '/roles/save/{id?}', 
            'AdminController@saveRoles')->name('admin.security.roles.save')
            ->where('id', '[0-9]+');

        Route::match(['post', 'put'], '/roles/sync/permissions', 
            'AdminController@syncPermissionsToRoles')->name('admin.security.roles.sync.permissions');

        Route::delete('/roles/delete', 
            'AdminController@deleteRoles')->name('admin.security.roles');

        Route::get('/permissions', 
            'AdminController@permissions')->name('admin.security.permissions');

        Route::match(['post', 'put'], '/permissions/save/{id?}', 
            'AdminController@savePermissions')->name('admin.security.permissions.save')
            ->where('id', '[0-9]+');

        Route::delete('/permissions/delete', 
            'AdminController@deletePermissions')->name('admin.security.permissions.delete');
        
    });
  
});

