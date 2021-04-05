<?php

//use App\Http\Controllers\Auth\LoginController;
//use App\Http\Controllers\Lead\LeadsController;
//use App\Http\Controllers\Question\QuestionController;
//use Illuminate\Support\Facades\Route;
//
//use App\Http\Controllers\Document\DocumentController;
//use App\Http\Controllers\Attachments\AttachmentController;
//use App\Http\Controllers\{Attachments\AttachmentEmail,
//    EstimateLineItemController,
//    EstimateController,
//    InitialFormController,
//    LeadLinkController,
//    Request\RequestController,
//    RoomController};
//use App\Http\Controllers\Project\ProjectController;
//use App\Http\Controllers\Payment\PaymentController;
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



Auth::routes();

Route::group(['middleware' => 'auth'], function(){
//Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/',[App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('admin-setting/csi-code', [App\Http\Controllers\Admin\CsiController::class, 'index'])
        ->name('admin.csi.csicodel1');
    Route::put('admin-settings/csi-code-categories/{category}', [App\Http\Controllers\Admin\CsiController::class, 'update'])
        ->name('admin_settings.csi_code_categories.update');

// Route::get('account-setting', [Account\AccountController::class, 'index'])->name('account.index');

    Route::resource('account-setting', Account\AccountController::class)
        ->only(['index', 'store', 'update'])
        ->parameters(['account-setting' => 'user']); //todo policy


    Route::resource('admin-setting/users', Admin\UserController::class);
    Route::group(['prefix' => 'admin-settings/users/{user}', 'as' => 'users.'], function () {
        Route::put('password', [App\Http\Controllers\Admin\UserController::class, 'setPassword'])->name('password.set');
    });

    Route::resource('representatives', Admin\RepresentativesController::class); //todo policy
    Route::resource('managers', Admin\ManagersController::class);//todo policy
    Route::resource('workers', Admin\WorkersController::class);
    Route::resource('admins', Admin\AdminsController::class); //todo policy

    Route::resource('general-contractors', Admin\GeneralContractorsController::class)
        ->parameters(['general-contractors' => 'general_contractor']);

    Route::resource('subcontractors', Admin\SubContractorsController::class);

    Route::resource('public-subcontractors', Admin\PublicSubContractorsController::class); //todo policy

    Route::resource('contacts', Contact\ContactController::class);

    Route::resource('requests', Request\RequestController::class);

//    Route::resource('rooms', RoomController::class, ['only'=> ['update']]);


    Route::post('attachment-email', [App\Http\Controllers\Attachments\AttachmentController::class, 'attachmentEmail'])->name('attachment-email');


    Route::resource('leads', Lead\LeadsController::class,[
        'names'=>[
            'index' => 'leads.index',
            'create'=>'leads.create',
            'store'=>'leads.store',
            'update'=>'leads.update',
            'edit' => 'leads.edit',
            'show'=>'leads.show'
        ]
    ]);

    Route::name('leads.')->group(function () {
        Route::post('compose-email/{id}', [App\Http\Controllers\Lead\LeadsController::class, 'composeEmail'])->name('compose-email');
    });

    Route::resource('user-role', User\UserRoleController::class); //todo admin middleware

    Route::resource('note', Note\NoteController::class); //todo policy

    Route::resource('attachments', Attachments\AttachmentController::class);  //todo policy

    Route::group(['prefix' => 'api/attachments', 'as' => 'attachments.'], function() {
        Route::post('', [App\Http\Controllers\Attachments\AttachmentController::class, 'storeJson'])->name('store_json');
    });

    Route::resource('task', Task\TaskController::class);

//Route::group(['prefix'=>'csicodes','namespace'=>'\App\Http\Controllers'],function(){ //todo change policies
//    Route::resource('csi-code-category',CSICodeCategoriesController::class, [
//        'names'=>[
//            'index' => 'csi_code_category.index',
//            'create'=>'csi_code_category.create',
//            'store'=>'csi_code_category.store',
//            'update'=>'csi_code_category.update',
//            'edit' => 'csi_code_category.edit',
//            'show'=>'csi_code_category.show',
//            'destroy'=>'csi_code_category.destroy'
//        ]
//    ]);
//
//    Route::resource('csicodes',CSICodesController::class, [
//        'names'=>[
//            'index' => 'csicodes.index',
//            'create'=>'csicodes.create',
//            'store'=>'csicodes.store',
//            'update'=>'csicodes.update',
//            'edit' => 'csicodes.edit',
//            'show'=>'csicodes.show',
//            'destroy'=>'csicodes.destroy'
//        ]
//    ])->parameters(['csicodes' => 'code']);
//    Route::get('csicodes/{code}/categories', [\CSICodesController::class, 'getDefaultCategories'])->name('csicodes.categories');
//    Route::get('csi_categories',  [\CSICodesController::class, 'getCategories'])->name('csi_categories.get');
//});

    Route::resource('csi-code', CSI\CsiCodeController::class);
    Route::resource('csi-level', CSI\CsiLevelController::class);

    Route::post('estimate-templates/save-line-items/{id?}','EstimateTemplateController@saveLineItems')
        ->name('estimate-templates.save-line-items');
    Route::post('estimate-templates/save-items-to-estimate/{id?}','EstimateController@updateEstimateTemplate')
        ->name('estimate.update-estimate-template.update');

    Route::get('estimate-templates/get-line-items/{id?}','EstimateTemplateController@getLineItems')
        ->name('estimate-templates.get-line-items');
    Route::get('estimate-templates/get-csi-codes/{id?}','EstimateTemplateController@getCSICodes')
        ->name('estimate-templates.get-csi-codes');

    Route::resource('estimate-templates',EstimateTemplateController::class, [
        'names'=>[
            'index' => 'estimate-templates.index',
            'create'=>'estimate-templates.create',
            'store'=>'estimate-templates.store',
            'update'=>'estimate-templates.update',
            'edit' => 'estimate-templates.edit',
            'show'=>'estimate-templates.show',
            'destroy'=>'estimate-templates.destroy'
        ]
    ])->parameters(['estimate-templates' => 'estimate_template']);

    Route::post('estimates/save-line-items/{id?}',[App\Http\Controllers\EstimateLineItemController::class, 'saveLineItems'])
        ->name('estimates.save-line-items');
    Route::get('estimates/get-line-items/{id?}',[App\Http\Controllers\EstimateLineItemController::class, 'getLineItems'])
        ->name('estimates.get-line-items');
    Route::get('estimates/get-csi-codes/{id?}',[App\Http\Controllers\EstimateLineItemController::class, 'getCSICodes'])
        ->name('estimates.get-csi-codes');


    Route::resource('estimate-reps','EstimateController', [
        'names'=>[
            'index' => 'estimate-reps.index',
            'create'=>'estimate-reps.create',
            'store'=>'estimate-reps.store',
            'update'=>'estimate-reps.update',
            'edit' => 'estimate-reps.edit',
            'show'=>'estimate-reps.show',
            'destroy'=>'estimate-reps.destroy'
        ]
    ])->parameters(['estimate-reps' => 'estimate']);
    Route::get('estimates/{estimate}/line-items', [App\Http\Controllers\EstimateController::class, 'getLineItems'])
        ->name('estimates.line-items');

    Route::post('estimate-reps/{estimate}/insert-template', [App\Http\Controllers\EstimateController::class, 'insertEstimateTemplate'])->name('estimate-reps.insert_template');

    Route::get('payouts/del/{id_project}/{id}', [App\Http\Controllers\Project\ProjectController::class, 'storePayoutDelete']);
    Route::get('payment/del/{id_project}/{id}', [App\Http\Controllers\Project\ProjectController::class, 'storePaymentDelete']);
    Route::resource('projects', Project\ProjectController::class);
    Route::group(['prefix' => 'projects/{project}', 'as' => 'projects.'], function () {
        Route::post('payments', [App\Http\Controllers\Project\ProjectController::class, 'storePayment'])->name('payments.store');
        Route::post('payouts', [App\Http\Controllers\Project\ProjectController::class, 'storePayout'])->name('payouts.store');

        Route::get('tasks/{task}', [App\Http\Controllers\Task\TaskController::class, 'showTask'])->name('tasks.show');
    });
    Route::resource('payments', Payment\PaymentController::class)->only(['update']); //todo policy
    Route::resource('documents', Document\DocumentController::class)->only(['index']);
    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
        Route::put('{question}/close', [App\Http\Controllers\Question\QuestionController::class, 'updateStatusToClosed'])->name('close');
        Route::put('{question}/reopen', [App\Http\Controllers\Question\QuestionController::class, 'updateStatusToInProgress'])->name('reopen');
        Route::post('{question}/remark', [App\Http\Controllers\Question\QuestionController::class, 'storeRemark'])->name('remarks.store');
        Route::delete('{question}/remark/{remark}', [App\Http\Controllers\Question\QuestionController::class, 'destroyRemark'])->name('remarks.destroy');
        Route::post('{question}/attachment', [App\Http\Controllers\Question\QuestionController::class, 'storeAttachment'])
            ->name('attachments.store');
        Route::delete('{question}/attachments/{attachment}', [App\Http\Controllers\Question\QuestionController::class, 'destroyAttachment'])
            ->name('attachments.destroy');
    });

    Route::resource('questions', Question\QuestionController::class);

});

Route::post('projects/convert', [App\Http\Controllers\Project\ProjectController::class, 'convert'])->name('convert');

Route::get('leads/verification/{token}', [App\Http\Controllers\Lead\LeadsController::class, 'checkUserToken'])->name('mailverification');

Route::post('contact/add-to-lead', [App\Http\Controllers\Contact\ContactController::class, 'addToLead'])->name('add-to-lead');
Route::post('contact/remove-from-lead', [App\Http\Controllers\Contact\ContactController::class, 'removeFromLead'])->name('remove-from-lead');
Route::post('contact/remove-from-lead', [App\Http\Controllers\Contact\ContactController::class, 'removeFromLead'])->name('remove-from-lead');

Route::match(['get', 'post'], 'attachment-create/{id}', [App\Http\Controllers\Attachments\AttachmentEmail::class, 'attachmentCreate'])->name('attachment-create');

Route::resource('initial-form', InitialRequestController::class);

Route::post('initial-form/email', [App\Http\Controllers\InitialRequestController::class, 'validateEmail']);

Route::resource('lead-form', LeadLinkController::class);

Route::post( 'lead-form-create', [App\Http\Controllers\LeadLinkController::class, 'repeatLinkSend'])->name('lead-form-create');

Route::match(['get', 'post', 'delete'],'estimate-templates/remove-template-line-item/{id}', [App\Http\Controllers\EstimateTemplateController::class, 'removeTemplateLineItem'])->name('remove-template-line-item');

Route::match(['get', 'post'], 'level-3', [App\Http\Controllers\Admin\CsiController::class, 'level_3'])->name('level-3');
Route::match(['get', 'post'], 'level-4', [App\Http\Controllers\Admin\CsiController::class, 'level_4'])->name('level-4');
Route::match(['get', 'post'], 'csi-code-tree', [App\Http\Controllers\Admin\CsiController::class, 'csiCodeTree'])->name('csi-code-tree');
Route::post('/csi-edit',[App\Http\Controllers\Admin\CsiController::class, 'csiCodeEdit'])->name('csi-edit');
Route::get('/csi-del/{id}',[App\Http\Controllers\Admin\CsiController::class, 'csiCodeDelete'])->name('csi-del');
Route::get('generate-pdf-document', 'Project\ProjectDocumentController@createDocumentPdf')->name('generate-pdf-document');
Route::get('preview-pdf-document', 'Project\ProjectDocumentController@previewPdf')->name('preview-pdf-document');
Route::resource('project-documents', 'Project\ProjectDocumentController');









