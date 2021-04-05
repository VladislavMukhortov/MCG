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
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/


Route::group(['namespace' => 'Api\v_1', 'prefix' => 'v_1', 'as' => 'api.'], function () {
    Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {

        Route::post('login', 'Jwt\AuthController@login');
        Route::post('logout', 'Jwt\AuthController@logout');
        Route::post('refresh', 'Jwt\AuthController@refresh');
        Route::post('me', 'Jwt\AuthController@me')->middleware('auth:api');
    });
    Route::group(['middleware' => 'auth:api'], function(){

        // Attachments
        Route::post('', 'Attachments\AttachmentController@storeJson')->name('store_json');
        Route::post('attachment-email', 'Attachments\AttachmentController@attachmentEmail')->name('attachment-email');
        Route::post('attachments/link', 'Attachments\AttachmentController@storeLink')->name('attachments-link');
        Route::resource('attachments', 'Attachments\AttachmentController');

        // Email
        Route::resource('emails', 'EmailController');

        // Contacts
        Route::get('/contacts/my','Contact\ContactController@getMyContacts')->name('get-my-contacts');
        Route::get('/contacts/all','Contact\ContactController@getAllContacts')->name('get-all-contacts');
        Route::get('/contacts/{id}/notes','Contact\ContactController@getContactNoteList')->name('get-contacts-notes');
        Route::post('leads/{id}/contacts', 'Contact\ContactController@addContactToLead')->name('add-to-lead');
        Route::resource('contacts', 'Contact\ContactController');

        // Leads
        Route::get('/leads/my','Lead\LeadController@getMyLeads')->name('get-my-leads');
        Route::get('/leads/all','Lead\LeadController@getAllLeads')->name('get-all-leads');
        Route::get('/leads/{id}/activities','Lead\LeadController@getActivitiesList')->name('get-lead-activities');
        Route::get('/leads/{id}/estimates','Lead\LeadController@getEstimatesList')->name('get-lead-estimates');
        Route::get('/leads/{id}/tasks','Lead\LeadController@getAllTasks')->name('get-leads-tasks');
        Route::get('/leads/{id}/tasks/{taskId}','Lead\LeadController@getTask')->name('get-lead-task');
        Route::get('/leads/{id}/requests','Lead\LeadController@getRequests')->name('get-lead-requests');
        Route::get('/leads/{id}/attachments','Lead\LeadController@getAttachments')->name('get-lead-attachments');
        Route::get('/leads/{id}/address','Lead\LeadController@getAddress')->name('get-lead-address');
        Route::get('/leads/{id}/contacts','Lead\LeadController@getContacts')->name('get-lead-contacts');
        Route::get('/leads/{id}/questions','Lead\LeadController@getQuestionsList')->name('get-lead-questions');
        Route::get('/leads/{id}/question/{questionId}','Lead\LeadController@getQuestion')->name('get-lead-question');
        Route::get('/leads/{id}/notes','Lead\LeadController@getNotes')->name('get-lead-notes');
        Route::get('/leads/{id}/emails','Lead\LeadController@getEmails');
        Route::delete('/leads/{id}/contacts/{contactId}', 'Contact\ContactController@removeFromLead');
        Route::resource('leads', 'Lead\LeadController');

        // Leads->Requests
        Route::get('/requests/{id}/lead','Request\RequestController@getLead');
        Route::get('/requests/{id}/notes','Request\RequestController@getNotesList');
        Route::get('/requests/{id}/attachments','Request\RequestController@getAttachmentsList');
        Route::get('/requests/{id}/activities','Request\RequestController@getActivitiesList');
        Route::get('/requests/{id}/rooms','Request\RequestController@getRooms');
        Route::get('/requests/{id}/emails','Request\RequestController@getEmails');
        Route::resource('requests', 'Request\RequestController');

        // Leads->Requests->Rooms
        Route::resource('rooms', 'RoomController' );

        // Jobs
        Route::get('jobs/{id}/estimates', 'JobController@showWithEstimates');
        Route::post('jobs/{id}/estimates/{estimateId}', 'JobController@addExistingEstimate');
        Route::resource('jobs', 'JobController');

        // Estimates
        Route::get('/estimates/all', 'EstimateController@getAllEstimates')->name('estimates-all');
        Route::get('/estimates/templates', 'EstimateController@getEstimateTemplateList')->name('estimates-templates');
        Route::get('/estimates/{id}/attachments', 'EstimateController@getAttachments');
        Route::get('/estimates/{id}/notes', 'EstimateController@getNotes');
        Route::get('/estimates/{id}/questions', 'EstimateController@getQuestions');
        Route::get('/estimates/{id}/lead', 'EstimateController@getLead')->name('estimate-lead');
        Route::get('estimates/{estimate}/line-items', 'EstimateController@getLineItems')->name('estimates-line-items');
        Route::get('/estimates/{id}/emails','EstimateController@getEmails');
        Route::post('estimates/{id}/insert-template', 'EstimateLineItemController@insertEstimateTemplate')->name('estimate-reps.insert_template');
        Route::patch('estimates/{id}/update-template','EstimateController@updateEstimateTemplate')->name('estimate.update-estimate-template.update');

        //Route::get('/estimates/{id}/pre-estimate-email', 'EstimateController@sendPreEstimateEmail')->name('send-pre-estimate-email');
        //Route::get('/estimates/{id}/send-final-estimate-email', 'EstimateController@sendFinalEstimateEmail')->name('send-final-estimate-email');

        Route::resource('estimates','EstimateController');

        Route::get('/csi/all-csi-codes', 'EstimateController@getCsiTree')->name('all-csi-codes');

        Route::get('/sub-contractors/vendors', 'Admin\SubContractorsController@getVendors')->name('sub-contractors-vendors');
        Route::get('/sub-contractors/notes/{id}', 'Admin\SubContractorsController@getNotesList')->name('sub-contractors-notes');
        Route::get('/sub-contractors/attachments/{id}', 'Admin\SubContractorsController@getAttachmentList')->name('sub-contractors-attachments');
        Route::get('/sub-contractors/contacts/{id}', 'Admin\SubContractorsController@getContactList')->name('sub-contractors-contacts');

        Route::get('/users/roles', 'UserController@getUserRoles')->name('get-user-roles');

        Route::get('/projects/own', 'Project\ProjectController@getOwnProjects')->name('get-own-projects');
        Route::get('/projects/subcontractors', 'Project\ProjectController@getAllSubcontractors')->name('get-all-subcontractors');
        Route::get('/projects/representatives', 'Project\ProjectController@getAllRepresentatives')->name('get-all-representatives');

        Route::get('generate-pdf-document', 'Project\ProjectDocumentController@createDocumentPdf')->name('generate-pdf-document');
        Route::get('preview-pdf-document', 'Project\ProjectDocumentController@previewPdf')->name('preview-pdf-document');
        Route::resource('project-documents', 'Project\ProjectDocumentController');
        Route::get('lead-document', 'Project\ProjectDocumentController@documentLead')->name('lead-document');

        //Estimate lead form
        Route::get('estimate-form-init/{leadId}', 'EstimateLeadFormController@estimateFormPage1');
        Route::post('store-file-init', 'EstimateLeadFormController@storeFilePage1');
        Route::post('delete-file-init/{leadFormId}', 'EstimateLeadFormController@deleteFilePage1');

        Route::post('store-premise/{estimateId}', 'EstimateLeadFormController@storePremise');
        Route::post('store-premise-data/{premiseId}', 'EstimateLeadFormController@storePremiseData');
        Route::get('all-premises/{estimateId}', 'EstimateLeadFormController@getAllPremises');
        Route::get('show-premise/{premiseId}', 'EstimateLeadFormController@showPremise');
        Route::post('update-premise/{premiseId}', 'EstimateLeadFormController@updatePremise');
        Route::post('update-premise-data/{premiseId}/{formId}', 'EstimateLeadFormController@updatePremiseData');
        Route::post('delete-premise/{premiseId}', 'EstimateLeadFormController@deletePremise');
        Route::post('delete-premise-data/{premiseId}', 'EstimateLeadFormController@deletePremiseData');

        Route::get('all-phases/{estimateId}', 'EstimateLeadFormController@getAllPhases');
        Route::get('show-phase/{phaseId}', 'EstimateLeadFormController@showPhase');
        Route::post('store-phase', 'EstimateLeadFormController@storePhase');
        Route::post('update-phase/{phaseId}/{formId}', 'EstimateLeadFormController@updatePhase');
        Route::post('delete-phase/{phaseId}', 'EstimateLeadFormController@deletePhase');

        Route::get('estimate-form-codes/{estimateId}', 'EstimateLeadFormController@estimateFormPage4');

        Route::get('next-step/{estimateId}', 'EstimateLeadFormController@estimateFormPage5');
        Route::post('store-next-step', 'EstimateLeadFormController@storeEstimateFormPage5');
        Route::post('update-next-step/{nextStepId}', 'EstimateLeadFormController@updateEstimateFormPage5');
        Route::post('delete-next-step/{nextStepId}', 'EstimateLeadFormController@deleteEstimateFormPage5');

        Route::get('estimate-terms/{estimateId}', 'EstimateLeadFormController@estimateFormPage6');
        Route::post('change-terms/{id?}', 'EstimateLeadFormController@updateOrStoreEstimateFormPage6');
        //

        Route::get('events-index/{userId}', 'EventController@index');
        Route::get('events-show/{eventId}', 'EventController@show');
        Route::post('events-store', 'EventController@store');
        Route::post('events-update/{eventId}', 'EventController@update');
        Route::post('events-delete/{eventId}', 'EventController@destroy');
        Route::get('events-all-users', 'EventController@getAllUsers');


        Route::get('/', "HomeController@index");
        Route::get('/home', "HomeController@index")->name('home');

// Route::get('account-setting', [App\Http\Controllers\Account\AccountController::class, 'index'])->name('account.index');

        Route::resource('account-setting', "Account\AccountController")
            ->only(['index', 'store', 'update'])
            ->parameters(['account-setting' => 'user']); //todo policy


        Route::resource('admin-setting/users', 'UserController');
        Route::group(['prefix' => 'admin-settings/users/{user}', 'as' => 'users.'], function () {
            Route::put('password', 'UserController@setPassword')->name('password.set');
        });

        Route::resource('representatives', 'Admin\RepresentativesController'); //todo policy
        Route::resource('managers', 'Admin\ManagersController');//todo policy
        Route::resource('workers', 'Admin\WorkersController');
        Route::resource('admins', 'Admin\AdminsController'); //todo policy

        Route::resource('general-contractors', 'Admin\GeneralContractorsController')
            ->parameters(['general-contractors' => 'general_contractor']);

     //   Route::resource('subcontractors', 'Admin\SubContractorsController');

     //   Route::resource('public-subcontractors', 'Admin\PublicSubContractorsController'); //todo policy


        Route::resource('user-role', 'User\UserRoleController'); //todo admin middleware

        Route::resource('notes', 'Note\NoteController'); //todo policy

        //Tasks
        Route::get('tasks', 'Task\TaskController@index');
        Route::get('task/{id}', 'Task\TaskController@show');
        Route::post('own-tasks', 'Task\TaskController@taskForCurPage');
        Route::post('task-store/{fromId?}', 'Task\TaskController@store');
        Route::post('task-update/{id}', 'Task\TaskController@update');
        Route::post('task-delete/{id}', 'Task\TaskController@destroy');
        //

//Route::group(['prefix'=>'csicodes','namespace'=>'App\Http\Controllers'],function(){ //todo change policies
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
//    Route::get('csicodes/{code}/categories', [App\Http\Controllers\CSICodesController::class, 'getDefaultCategories'])->name('csicodes.categories');
//    Route::get('csi_categories',  [App\Http\Controllers\CSICodesController::class, 'getCategories'])->name('csi_categories.get');
//});

        Route::group(['namespace'=>'\App\Http\Controllers\Api\v_1'], function(){

            // Estimate Template
            Route::get('estimate-templates/index','EstimateTemplateController@index');
            Route::get('estimate-templates/show/{id}','EstimateTemplateController@show');
            Route::post('estimate-templates/store','EstimateTemplateController@store');
            Route::post('estimate-templates/update/{id}','EstimateTemplateController@update');
            Route::post('estimate-templates/delete/{id}','EstimateTemplateController@destroy');
            Route::get('estimate-templates/get-line-items/{estimateTemplateId}','EstimateTemplateController@getLineItems');
            Route::post('estimate-templates/save-line-items/{estimateTemplateId}','EstimateTemplateController@saveLineItems');
            Route::post('estimate-templates/remove-line-item/{estimateTemplateId}','EstimateTemplateController@removeTemplateLineItem');
            Route::post('estimate-templates/save-items-to-estimate/{id?}','EstimateController@updateEstimateTemplate');
            //

            //Estimate line items
            Route::post('estimates/save-line-items/{$estimateId}','EstimateLineItemController@saveLineItems');
            Route::get('estimates/line-items/{estimateId}','EstimateLineItemController@getLineItems');
            Route::get('estimates/all-csi-codes','EstimateLineItemController@getAllCsiCodes');
            //


            Route::post('estimate/pre/email', 'EstimateController@sendPreEstimateEmail')->name('estimate.pre-email');
            Route::post('estimate/final/email', 'EstimateController@sendFinalEstimateEmail')->name('estimate.final-email');

        });

        Route::get('payouts/del/{id_project}/{id}', 'Project\ProjectController@storePayoutDelete');
        Route::get('payment/del/{id_project}/{id}', 'Project\ProjectController@storePaymentDelete');
        Route::resource('projects', 'Project\ProjectController');
        Route::group(['prefix' => 'projects/{project}', 'as' => 'projects.'], function () {
            Route::post('payments', 'Project\ProjectController@storePayment')->name('payments.store');
            Route::post('payouts', 'Project\ProjectController@storePayout')->name('payouts.store');

            Route::get('tasks/{task}', 'Project\ProjectController@showTask')->name('tasks.show');
        });
        Route::resource('payments', 'Payment\PaymentController')->only(['update']); //todo policy
        Route::resource('documents', 'Document\DocumentController')->only(['index']);

        //Questions
        Route::get('questions/all', 'Questions/QuestionController@getAllQuestions');
        Route::get('questions/my', 'Questions/QuestionController@getMyQuestions');
        Route::get('questions/{id}', 'Questions/QuestionController@show');
        Route::post('questions', 'Questions/QuestionController@store');
        Route::put('questions/{id}', 'Questions/QuestionController@update');
        Route::delete('questions/{id}', 'Questions/QuestionController@destroy');
        Route::post('questions/attachments/{questionId}', 'Questions/QuestionController@storeAttachment');
        Route::get('questions/attachments/{questionId}', 'Questions/QuestionController@getAttachments');
        Route::delete('questions/attachments/{attachmentId}', 'Questions/QuestionController@destroyAttachment');
        Route::post('questions/remarks/{questionId}', 'Questions/QuestionController@storeRemark');
        Route::get('questions/remarks/{questionId}', 'Questions/QuestionController@getRemarks');
        Route::delete('questions/remarks/{remarkId}', 'Questions/QuestionController@destroyRemark');
        Route::post('questions/status/{questionId}', 'Questions/QuestionController@changeStatus');
        //
    });

    Route::post('projects/convert', 'Project\ProjectController@convert')->name('convert');

    Route::get('leads/verification/{token}', 'Lead\LeadController@checkUserToken')->name('mailverification');


    Route::match(['get', 'post'], 'attachment-create/{id}', 'Attachments\AttachmentEmail@attachmentCreate')->name('attachment-create');


    // Initial Form
    Route::resource('initial-form', 'InitialFormController');
    Route::post('initial-form/email', 'InitialFormController@validateEmail');

    Route::resource('initial-completion-form', 'InitialCompletionFormController')->only(['show','store']);
    Route::resource('walkthrough-form', 'WalkthroughFormController')->only(['show','store']);
    Route::resource('final-completion-form', 'FinalCompletionFormController')->only(['show','store']);



    Route::resource('lead-form', 'LeadLinkController');

    Route::post( 'lead-form-create', 'LeadLinkController@repeatLinkSend')->name('lead-form-create');

    //Csi codes
    Route::match(['get', 'post'], 'parents-form-level-3', 'Admin\CsiController@getParentsLevel_3ForForm');
    Route::match(['get', 'post'], 'parents-form-level-4', 'Admin\CsiController@getParentsLevel_4ForForm');
    Route::match(['get', 'post'], 'csi-code-tree', 'Admin\CsiController@csiCodeTree');
    Route::get('all-csi-tree','Admin\CsiController@getCsiTree');
    Route::post('/csi-edit','Admin\CsiController@csiCodeEdit');
    Route::get('/csi-del/{id}','Admin\CsiController@csiCodeDelete');

    Route::post('store-csi-code', 'CSI\CsiCodeController@store');
    Route::post('update-csi-code/{id}', 'CSI\CsiCodeController@update');
    Route::post('delete-csi-code/{id}', 'CSI\CsiCodeController@destroy');

    Route::post('store-csi-level', 'CSI\CsiLevelController@store');
    Route::post('update-csi-level/{id}', 'CSI\CsiLevelController@update');
    Route::post('delete-csi-level/{id}', 'CSI\CsiLevelController@destroy');

    Route::get('admin-setting/csi-code', 'Admin\CsiController@index');
    Route::put('admin-settings/csi-code-categories/{category}', 'Admin\CsiController@update');
    //

    Route::resource('initial-completion-form', 'InitialCompletionFormController');
    Route::resource('walkthrough-form', 'WalkthroughFormController');
    Route::resource('final-completion-form', 'FinalCompletionFormController');
});






