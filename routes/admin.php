
<?php 
Route::get('/', function() {
    return redirect()->route('admin.login.form');
    //return view('admin.dashboard');
});



Route::group(['middleware' => 'admin.guest'], function() {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login.post');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.request');

    Route::get('new-password/{id}', 'Auth\ResetPasswordController@newPasswordForm')->name('admin.password.newPassword');

    Route::post('password/set-password/{id}', 'Auth\ResetPasswordController@setPassword')->name('admin.password.setPassword');

});




Route::group(['as' => 'admin.'], function() { 


    Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout.post');
    Route::get('profile', 'ProfileController@index')->name('profile.show');
   
    Route::put('change-password', 'ProfileController@update')->name('password.update');



    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index')->middleware('can:browse_dashboard');

    Route::post('file', 'DashboardController@file')->name('file');


    Route::get('bread', 'BreadController@index')->name('bread.index')->middleware('can:browse_bread');
    Route::get('bread/create', 'BreadController@create')->name('bread.create')->middleware('can:add_bread');
    Route::get('bread/{slug}/edit', 'BreadController@edit')->name('bread.edit')->middleware('can:edit_bread');
    Route::put('bread/{bread}/update', 'BreadController@update')->name('bread.update')->middleware('can:edit_bread');
    Route::delete('bread/{slug}/delete', 'BreadController@destroy')->name('bread.destroy')->middleware('can:delete_bread');
    Route::post('bread', 'BreadController@store')->name('bread.store')->middleware('can:add_bread');


    Route::get('role', 'RoleController@index')->name('role.index')->middleware('can:browse_role');
    Route::get('role/create', 'RoleController@create')->name('role.create')->middleware('can:add_role');
    Route::get('role/{role}/edit', 'RoleController@edit')->name('role.edit')->middleware('can:edit_role');
    Route::post('role', 'RoleController@store')->name('role.store')->middleware('can:add_role');
    Route::put('role/{role}', 'RoleController@update')->name('role.update')->middleware('can:edit_role');


    Route::get('menu', 'MenuController@index')->name('menu.index')->middleware('can:browse_menu');
    Route::get('menu/create', 'MenuController@create')->name('menu.create')->middleware('can:add_menu');
    Route::get('menu/{menu}/edit', 'MenuController@edit')->name('menu.edit')->middleware('can:edit_menu');
    Route::post('menu', 'MenuController@store')->name('menu.store')->middleware('can:add_menu');
    Route::put('menu/{menu}', 'MenuController@update')->name('menu.update')->middleware('can:edit_menu');
    Route::delete('menu/{menu}', 'MenuController@destroy')->name('menu.destroy')->middleware('can:delete_menu');


     //Admin

    Route::match(['get','patch'],'admin', 'AdminController@index')->name('admin.index')->middleware('can:browse_admin');
    Route::get('admin/create', 'AdminController@create')->name('admin.create')->middleware('can:add_admin');
    Route::get('admin/{admin}', 'AdminController@show')->name('admin.show')->middleware('can:read_admin');
    Route::get('admin/{admin}/edit', 'AdminController@edit')->name('admin.edit')->middleware('can:edit_admin');
    Route::post('admin', 'AdminController@store')->name('admin.store')->middleware('can:add_admin');
    Route::put('admin/{admin}', 'AdminController@update')->name('admin.update')->middleware('can:edit_admin');
    Route::delete('admin/{admin}', 'AdminController@destroy')->name('admin.destroy')->middleware('can:delete_admin');


    Route::get('setting', 'MenuController@index')->name('setting.index')->middleware('can:browse_setting');
    Route::get('site-setting', 'SiteSettingController@index')->name('site-setting.index')->middleware('can:browse_site_setting');

    Route::post('logo', 'SiteSettingController@logo')->name('site-setting.logo')->middleware('can:logo_site_setting');


     //Project
    Route::match(['get','patch'],'project', 'ProjectController@index')->name('project.index')->middleware('can:browse_project');
    Route::get('project/create', 'ProjectController@create')->name('project.create')->middleware('can:add_project');
    Route::get('project/{project}', 'ProjectController@show')->name('project.show')->middleware('can:read_project');
    Route::get('project/{project}/edit', 'ProjectController@edit')->name('project.edit')->middleware('can:edit_project');
    Route::post('project', 'ProjectController@store')->name('project.store')->middleware('can:add_project');
    Route::put('project/{project}', 'ProjectController@update')->name('project.update')->middleware('can:edit_project');
    Route::delete('project/{project}', 'ProjectController@destroy')->name('project.destroy')->middleware('can:delete_project');
    Route::put('projects/change-status', 'ProjectController@changeStatus')->name('project.changeStatus')->middleware('can:change_status_project');
    Route::get('projects/track/{project}', 'ProjectController@track')->name('project.track')->middleware('can:change_status_project');
    Route::post('projects/zoom-image/{project}', 'ProjectController@zoomImage')->name('project.zoom-image');


     //billing
    Route::match(['get','patch'],'billing', 'BillingController@index')->name('billing.index')->middleware('can:browse_billing');
    Route::get('billing/create', 'BillingController@create')->name('billing.create')->middleware('can:add_billing');
    Route::get('billing/{billing}', 'BillingController@show')->name('billing.show')->middleware('can:read_billing');
    Route::get('billing/{billing}/edit', 'BillingController@edit')->name('billing.edit')->middleware('can:edit_billing');
    Route::post('billing', 'BillingController@store')->name('billing.store')->middleware('can:add_billing');
    Route::put('billing/{billing}', 'BillingController@update')->name('billing.update')->middleware('can:edit_billing');
    Route::delete('billing/{billing}', 'BillingController@destroy')->name('billing.destroy')->middleware('can:delete_billing');
    Route::put('billings/change-status', 'BillingController@changeStatus')->name('billing.changeStatus')->middleware('can:change_status_billing');

     //cutting
    Route::match(['get','patch'],'cutting', 'CuttingController@index')->name('cutting.index')->middleware('can:browse_cutting');
    Route::get('cutting/create', 'CuttingController@create')->name('cutting.create')->middleware('can:add_cutting');
    Route::get('cutting/{cutting}', 'CuttingController@show')->name('cutting.show')->middleware('can:read_cutting');
    Route::get('cutting/{cutting}/edit', 'CuttingController@edit')->name('cutting.edit')->middleware('can:edit_cutting');
    Route::post('cutting', 'CuttingController@store')->name('cutting.store')->middleware('can:add_cutting');
    Route::put('cutting/{cutting}', 'CuttingController@update')->name('cutting.update')->middleware('can:edit_cutting');
    Route::delete('cutting/{cutting}', 'CuttingController@destroy')->name('cutting.destroy')->middleware('can:delete_cutting');
    Route::put('cuttings/change-status', 'CuttingController@changeStatus')->name('cutting.changeStatus')->middleware('can:change_status_cutting');


     //die-cutting
    Route::match(['get','patch'],'die-cutting', 'DieCuttingController@index')->name('die-cutting.index')->middleware('can:browse_die_cutting');
    Route::get('die-cutting/create', 'DieCuttingController@create')->name('die-cutting.create')->middleware('can:add_die_cutting');
    Route::get('die-cutting/{die-cutting}', 'DieCuttingController@show')->name('die-cutting.show')->middleware('can:read_die_cutting');
    Route::get('die-cutting/{die-cutting}/edit', 'DieCuttingController@edit')->name('die-cutting.edit')->middleware('can:edit_die_cutting');
    Route::post('die-cutting', 'DieCuttingController@store')->name('die-cutting.store')->middleware('can:add_die_cutting');
    Route::put('die-cutting/{die-cutting}', 'DieCuttingController@update')->name('die-cutting.update')->middleware('can:edit_die_cutting');
    Route::delete('die-cutting/{die-cutting}', 'DieCuttingController@destroy')->name('die-cutting.destroy')->middleware('can:delete_die_cutting');
    Route::put('die-cuttings/change-status', 'DieCuttingController@changeStatus')->name('die-cutting.changeStatus')->middleware('can:change_status_die_cutting');


     //dominant
    Route::match(['get','patch'],'dominant', 'DominantController@index')->name('dominant.index')->middleware('can:browse_dominant');
    Route::get('dominant/create', 'DominantController@create')->name('dominant.create')->middleware('can:add_dominant');
    Route::get('dominant/{dominant}', 'DominantController@show')->name('dominant.show')->middleware('can:read_dominant');
    Route::get('dominant/{dominant}/edit', 'DominantController@edit')->name('dominant.edit')->middleware('can:edit_dominant');
    Route::post('dominant', 'DominantController@store')->name('dominant.store')->middleware('can:add_dominant');
    Route::put('dominant/{dominant}', 'DominantController@update')->name('dominant.update')->middleware('can:edit_dominant');
    Route::delete('dominant/{dominant}', 'DominantController@destroy')->name('dominant.destroy')->middleware('can:delete_dominant');
    Route::put('dominants/change-status', 'DominantController@changeStatus')->name('dominant.changeStatus')->middleware('can:change_status_dominant');



     //embossing
    Route::match(['get','patch'],'embossing', 'EmbossingController@index')->name('embossing.index')->middleware('can:browse_embossing');
    Route::get('embossing/create', 'EmbossingController@create')->name('embossing.create')->middleware('can:add_embossing');
    Route::get('embossing/{embossing}', 'EmbossingController@show')->name('embossing.show')->middleware('can:read_embossing');
    Route::get('embossing/{embossing}/edit', 'EmbossingController@edit')->name('embossing.edit')->middleware('can:edit_embossing');
    Route::post('embossing', 'EmbossingController@store')->name('embossing.store')->middleware('can:add_embossing');
    Route::put('embossing/{embossing}', 'EmbossingController@update')->name('embossing.update')->middleware('can:edit_embossing');
    Route::delete('embossing/{embossing}', 'EmbossingController@destroy')->name('embossing.destroy')->middleware('can:delete_embossing');
    Route::put('embossings/change-status', 'EmbossingController@changeStatus')->name('embossing.changeStatus')->middleware('can:change_status_embossing');



     //lamination
    Route::match(['get','patch'],'lamination', 'LaminationController@index')->name('lamination.index')->middleware('can:browse_lamination');
    Route::get('lamination/create', 'LaminationController@create')->name('lamination.create')->middleware('can:add_lamination');
    Route::get('lamination/{lamination}', 'LaminationController@show')->name('lamination.show')->middleware('can:read_lamination');
    Route::get('lamination/{lamination}/edit', 'LaminationController@edit')->name('lamination.edit')->middleware('can:edit_lamination');
    Route::post('lamination', 'LaminationController@store')->name('lamination.store')->middleware('can:add_lamination');
    Route::put('lamination/{lamination}', 'LaminationController@update')->name('lamination.update')->middleware('can:edit_lamination');
    Route::delete('lamination/{lamination}', 'LaminationController@destroy')->name('lamination.destroy')->middleware('can:delete_lamination');
    Route::put('laminations/change-status', 'LaminationController@changeStatus')->name('lamination.changeStatus')->middleware('can:change_status_lamination');



     //leafing
    Route::match(['get','patch'],'leafing', 'LeafingController@index')->name('leafing.index')->middleware('can:browse_leafing');
    Route::get('leafing/create', 'LeafingController@create')->name('leafing.create')->middleware('can:add_leafing');
    Route::get('leafing/{leafing}', 'LeafingController@show')->name('leafing.show')->middleware('can:read_leafing');
    Route::get('leafing/{leafing}/edit', 'LeafingController@edit')->name('leafing.edit')->middleware('can:edit_leafing');
    Route::post('leafing', 'LeafingController@store')->name('leafing.store')->middleware('can:add_leafing');
    Route::put('leafing/{leafing}', 'LeafingController@update')->name('leafing.update')->middleware('can:edit_leafing');
    Route::delete('leafing/{leafing}', 'LeafingController@destroy')->name('leafing.destroy')->middleware('can:delete_leafing');
    Route::put('leafings/change-status', 'LeafingController@changeStatus')->name('leafing.changeStatus')->middleware('can:change_status_leafing');


     //pasting
    Route::match(['get','patch'],'pasting', 'PastingController@index')->name('pasting.index')->middleware('can:browse_pasting');
    Route::get('pasting/create', 'PastingController@create')->name('pasting.create')->middleware('can:add_pasting');
    Route::get('pasting/{pasting}', 'PastingController@show')->name('pasting.show')->middleware('can:read_pasting');
    Route::get('pasting/{pasting}/edit', 'PastingController@edit')->name('pasting.edit')->middleware('can:edit_pasting');
    Route::post('pasting', 'PastingController@store')->name('pasting.store')->middleware('can:add_pasting');
    Route::put('pasting/{pasting}', 'PastingController@update')->name('pasting.update')->middleware('can:edit_pasting');
    Route::delete('pasting/{pasting}', 'PastingController@destroy')->name('pasting.destroy')->middleware('can:delete_pasting');
    Route::put('pastings/change-status', 'PastingController@changeStatus')->name('pasting.changeStatus')->middleware('can:change_status_pasting');


     //heidelberg-1
    Route::match(['get','patch'],'heidelberg-1', 'Heidelberg1Controller@index')->name('heidelberg-1.index')->middleware('can:browse_heidelberg_1');
    Route::get('heidelberg-1/create', 'Heidelberg1Controller@create')->name('heidelberg-1.create')->middleware('can:add_heidelberg_1');
    Route::get('heidelberg-1/{heidelberg_1}', 'Heidelberg1Controller@show')->name('heidelberg-1.show')->middleware('can:read_heidelberg_1');
    Route::get('heidelberg-1/{heidelberg_1}/edit', 'Heidelberg1Controller@edit')->name('heidelberg-1.edit')->middleware('can:edit_heidelberg_1');
    Route::post('heidelberg-1', 'Heidelberg1Controller@store')->name('heidelberg-1.store')->middleware('can:add_heidelberg_1');
    Route::put('heidelberg-1/{heidelberg_1}', 'Heidelberg1Controller@update')->name('heidelberg-1.update')->middleware('can:edit_heidelberg_1');
    Route::delete('heidelberg-1/{heidelberg_1}', 'Heidelberg1Controller@destroy')->name('heidelberg-1.destroy')->middleware('can:delete_heidelberg_1');
    Route::put('heidelbergs-1/change-status', 'Heidelberg1Controller@changeStatus')->name('heidelberg-1.changeStatus')->middleware('can:change_status_heidelberg_1');

     //heidelberg-2
    Route::match(['get','patch'],'heidelberg-2', 'Heidelberg2Controller@index')->name('heidelberg-2.index')->middleware('can:browse_heidelberg_2');
    Route::get('heidelberg-2/create', 'Heidelberg2Controller@create')->name('heidelberg-2.create')->middleware('can:add_heidelberg_2');
    Route::get('heidelberg-2/{heidelberg_2}', 'Heidelberg2Controller@show')->name('heidelberg-2.show')->middleware('can:read_heidelberg_2');
    Route::get('heidelberg-2/{heidelberg_2}/edit', 'Heidelberg2Controller@edit')->name('heidelberg-2.edit')->middleware('can:edit_heidelberg_2');
    Route::post('heidelberg-2', 'Heidelberg2Controller@store')->name('heidelberg-2.store')->middleware('can:add_heidelberg_2');
    Route::put('heidelberg-2/{heidelberg_2}', 'Heidelberg2Controller@update')->name('heidelberg-2.update')->middleware('can:edit_heidelberg_2');
    Route::delete('heidelberg-2/{heidelberg_2}', 'Heidelberg2Controller@destroy')->name('heidelberg-2.destroy')->middleware('can:delete_heidelberg_2');
    Route::put('heidelbergs-2/change-status', 'Heidelberg2Controller@changeStatus')->name('heidelberg-2.changeStatus')->middleware('can:change_status_heidelberg_2');
});

    
