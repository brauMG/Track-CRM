<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

        Route::get('/', function () {
            return view('pages.home.index');
        });

    Route::resource('/companies', 'CompaniesController')->middleware('superadmin');

    Route::resource('/admins', 'AdminsController')->middleware('superadmin');

    Route::resource('/inventory', 'InventoryController');

    Route::resource('/sponsors', 'SponsorsController');

    Route::resource('/catalogue', 'CatalogueController');

    Route::resource('/quotation', 'QuotationController');
    Route::post('/quotation/fill', 'QuotationController@fill');
    Route::post('/quotation/storeFill', 'QuotationController@storeFill')->name('Filled');

    Route::resource('/campaigns', 'CampaignsController');

    Route::get('/campaigns','CampaignsController@index');
    Route::get('/campaigns/create', 'CampaignsController@create');
    Route::get('/campaigns/{id}/edit', 'CampaignsController@edit');
    Route::get('/campaigns/{id}', 'CampaignsController@show')->name('showCampaign');
    Route::post('/campaigns/store', 'CampaignsController@store')->name('createCampaign');
    Route::put('/campaigns/update/{id}', 'CampaignsController@update')->name('updateCampaign');
    Route::delete('/campaigns/delete/{id}', 'CampaignsController@destroy')->name('createCampaign');

    Route::get('/marketing', 'MarketingController@index');
    Route::post('/marketing/send', 'MarketingController@send');
    Route::get('/marketing/preview', 'MarketingController@preview');

    Route::get('/promos', 'PromosController@index');
    Route::post('/promos/send', 'PromosController@send');
    Route::get('/promos/preview', 'PromosController@preview');

    Route::get('/imports/', 'ContactsController@export');

    Route::resource('/users', 'UsersController');

    Route::get('/my-profile', 'UsersController@getProfile');

    Route::get('/my-profile/edit', 'UsersController@getEditProfile');

    Route::patch('/my-profile/edit', 'UsersController@postEditProfile');

    Route::resource('/permissions', 'PermissionsController');

    Route::resource('/roles', 'RolesController');

    Route::get('/users/role/{id}', 'UsersController@getRole');

    Route::put('/users/role/{id}', 'UsersController@updateRole');

    Route::resource('/documents', 'DocumentsController');

    Route::get('/documents/{id}/assign', 'DocumentsController@getAssignDocument');

    Route::put('/documents/{id}/assign', 'DocumentsController@postAssignDocument');

    Route::resource('/contacts', 'ContactsController');

    Route::get('/contacts/{id}/assign', 'ContactsController@getAssignContact');

    Route::put('/contacts/{id}/assign', 'ContactsController@postAssignContact');

    Route::get('/contacts/ChangeStatus/{id}','ContactsController@editStatus')->name('ChangeStatusContact');
    Route::put('/contacts/UpdateStatus/{id}','ContactsController@updateStatus')->name('UpdateStatusContact');

    Route::get('/api/contacts/get-contacts-by-status', 'ContactsController@getContactsByStatus');

    Route::post('/contacts/import', 'ContactsController@import');

    Route::resource('/tasks', 'TasksController');

    Route::get('/tasks/{id}/assign', 'TasksController@getAssignTask');

    Route::put('/tasks/{id}/assign', 'TasksController@postAssignTask');

    Route::get('/tasks/{id}/update-status', 'TasksController@getUpdateStatus');

    Route::put('/tasks/{id}/update-status', 'TasksController@postUpdateStatus');

    Route::get('/mailbox/{folder?}', 'MailboxController@index');

    Route::get('/mailbox-create', 'MailboxController@create');

    Route::post('/mailbox-create', 'MailboxController@store');

    Route::get('/mailbox-show/{id}', 'MailboxController@show');

    Route::put('/mailbox-toggle-important', 'MailboxController@toggleImportant');

    Route::delete('/mailbox-trash', 'MailboxController@trash');

    Route::get('/mailbox-reply/{id}', 'MailboxController@getReply');

    Route::post('/mailbox-reply/{id}', 'MailboxController@postReply');

    Route::get('/mailbox-forward/{id}', 'MailboxController@getForward');

    Route::post('/mailbox-forward/{id}', 'MailboxController@postForward');

    Route::get('/mailbox-send/{id}', 'MailboxController@send');

    Route::get('/calendar', 'CalendarController@index');

    Route::get('/campaigns/quiz/{id}', 'CampaignsController@quiz')->name('showQuiz');
    Route::get('/campaigns/seeLink/{id}', 'CampaignsController@seeLink')->name('seeLinkQuiz');
    Route::post('/campaigns/storeQuiz', 'CampaignsController@storeQuiz')->name('createQuiz');

    //FOR REPORTS
    Route::get('/prepareContacts', 'ContactsController@preparePdf')->name('FilterContactsPDF');
    Route::post('/prepareContacts/PDF', 'ContactsController@exportPdf')->name('ContactsPDF');

    Route::get('/prepareCampaigns', 'CampaignsController@preparePdf')->name('FilterCampaignsPDF');
    Route::post('/prepareCampaigns/PDF', 'CampaignsController@exportPdf')->name('CampaignsPDF');

    Route::get('/prepareTasks', 'TasksController@preparePdf')->name('FilterTasksPDF');
    Route::post('/prepareTasks/PDF', 'TasksController@exportPdf')->name('TasksPDF');

    Route::get('/prepareInventory', 'InventoryController@preparePdf')->name('FilterInventoryPDF');
    Route::post('/prepareInventory/PDF', 'InventoryController@exportPdf')->name('InventoryPDF');


    Route::get('/forbidden', function () {
        return view('pages.forbidden.forbidden_area');
    });

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
});

Route::group(['prefix' => 'guest', 'middleware' => 'guest'], function () {

    Route::get('/campaigns/thanks', 'CampaignsController@thanks')->name('thanksQuiz');
    Route::get('/campaigns/quiz/{id}', 'CampaignsController@quiz')->name('showQuiz');
    Route::post('/campaigns/storeQuiz', 'CampaignsController@storeQuiz')->name('createQuiz');

    Route::get('/promos/thanks', 'PromosController@thanks')->name('thanksContactQuiz');
    Route::get('/promos/quiz/{id}', 'PromosController@quiz')->name('showContactQuiz');
    Route::post('/promos/storeQuiz', 'PromosController@storeQuiz')->name('storeContactQuiz');

    Route::get('/forbidden', function () {
        return view('pages.forbidden.forbidden_area');
    });
});

Route::get('/', function () {
    return redirect()->to('/admin');
});

Auth::routes();
