<?php
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('', 'App\Http\Controllers\MainController@welcome');
Route::get('home', 'App\Http\Controllers\MainController@home');
Route::get('about', 'App\Http\Controllers\MainController@about');
Route::get('projects', 'App\Http\Controllers\MainController@projects');
Route::get('testimonial', 'App\Http\Controllers\MainController@testimonial');
Route::get('gallery', 'App\Http\Controllers\MainController@gallery');
Route::get('the_team', 'App\Http\Controllers\MainController@the_team');
Route::get('contact', 'App\Http\Controllers\MainController@contact');
Route::get('faq', 'App\Http\Controllers\MainController@faq');
Route::get('blog', 'App\Http\Controllers\MainController@blog');




Route::get('admin', [App\Http\Controllers\FrondendController::class, 'admin'])->name('admin');

Route::get('slider', [App\Http\Controllers\FrondendController::class, 'slider'])->name('slider');
Route::get('admin/category/{id}', [App\Http\Controllers\FrondendController::class, 'categoryproducts'])->name('categoryproduct');
Route::post('saveorder', [App\Http\Controllers\FrondendController::class, 'saveorder'])->name('saveorder');





//admin
Route::get('admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('admin/addproject', [App\Http\Controllers\Admin\ProductsController::class, 'addproject'])->name('addproject');

Route::get('admin/projects/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'projects'])->name('projects');
Route::get('admin/project/viewproducts', [App\Http\Controllers\Admin\ProductsController::class, 'project'])->name('project');
Route::post('saveproject', [App\Http\Controllers\Admin\ProductsController::class, 'saveproject'])->name('saveproject');
Route::post('saveprojectimage', [App\Http\Controllers\Admin\ProductsController::class, 'saveprojectimage'])->name('saveprojectimage');


Route::get('admin/editproject/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'editproject'])->name('editproject');

ROUTE::post('updateproject', [App\Http\Controllers\Admin\ProductsController::class, 'updateproject'])->name('updateproject');



Route::get('/dropproject/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'dropproject'])->name('dropproject');

Route::get('admin/pendingorder', [App\Http\Controllers\Admin\ProductsController::class, 'pendingorder'])->name('pendingorder');
Route::get('admin/completedorder', [App\Http\Controllers\Admin\ProductsController::class, 'completedorder'])->name('completedorder');
ROUTE::get('deleteimage/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'deleteimage'])->name('deleteimage');


ROUTE::post('addcategory', [App\Http\Controllers\Admin\CategoryController::class, 'AddCategory'])->name('addcategory');
ROUTE::post('editcategory', [App\Http\Controllers\Admin\CategoryController::class, 'EditCategory'])->name('editcategory');
ROUTE::post('updatecategory', [App\Http\Controllers\Admin\CategoryController::class, 'updatecategory'])->name('updatecategory');
ROUTE::get('/admin/subcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'manageSubcategory'])->name('subcategory');
ROUTE::post('addsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'AddSubCategory'])->name('addsubcategory');


Route::Post('getattributes', [App\Http\Controllers\Admin\CategoryController::class, 'getattributes'])->name('getattributes');
ROUTE::post('getsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'getsubcategory'])->name('getsubcategory');
Route::get('admin/categorys', [App\Http\Controllers\Admin\CategoryController::class, 'categorys'])->name('categorys');
Route::get('admin/attribute', [App\Http\Controllers\Admin\CategoryController::class, 'attribute'])->name('attribute');
ROUTE::post('admin/addattribute', [App\Http\Controllers\Admin\CategoryController::class, 'addattribute'])->name('addattribute');
ROUTE::get('admin/deleteattribute/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteattribute'])->name('deleteattribute');
ROUTE::post('/linkattribute', [App\Http\Controllers\Admin\CategoryController::class, 'linkattribute'])->name('linkattribute');
Route::get('admin/catattribute', [App\Http\Controllers\Admin\CategoryController::class, 'catattribute'])->name('catattribute');
Route::get('admin/catattribute', [App\Http\Controllers\Admin\CategoryController::class, 'catattribute'])->name('catattribute');
Route::get('/deleteattributelink/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'deleteattributelink'])->name('deleteattributelink');
ROUTE::post('/editsubcategory', [App\Http\Controllers\Admin\CategoryController::class, 'EditSubCategory'])->name('editsubcategory');
Route::get('/deletesubcategory/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'DeleteSubcat'])->name('deletesubcategory');



ROUTE::get('/admin/backup', [App\Http\Controllers\Admin\BackupController::class, 'index'])->name('backup');
ROUTE::get('/admin/backup/create', [App\Http\Controllers\Admin\BackupController::class, 'create'])->name('create');
ROUTE::get('/admin/backup/download/{file_name}', [App\Http\Controllers\Admin\BackupController::class, 'download'])->name('download');
ROUTE::get('/admin/backup/delete/{file_name}', [App\Http\Controllers\Admin\BackupController::class, 'delete'])->name('delete');


Route::get('logout', [App\Http\Controllers\Admin\UsersController::class, 'logout'])->name('logout');


Route::get('/admin/banners',[App\Http\Controllers\Admin\BannersController::class, 'banners'])->name('banners');
Route::post('addbanner',[App\Http\Controllers\Admin\BannersController::class, 'addbanner'])->name('addbanner');
Route::post('/updatebanners',[App\Http\Controllers\Admin\BannersController::class, 'updatebanners'])->name('updatebanners');
Route::get('deletebanner/{id}',[App\Http\Controllers\Admin\BannersController::class, 'deletebanner'])->name('deletebanner');
Route::get('/deletebanners/{id}',[App\Http\Controllers\Admin\BannersController::class, 'deletebanners'])->name('deletebanners');
Route::get('changepassword',[App\Http\Controllers\Admin\UsersController::class, 'changepassword'])->name('changepassword');
