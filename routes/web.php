<?php
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CodesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Artisan;
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

//Route::get('/', function () {
//    return view('welcome');
//});


//get
Route::get('/',[PagesController::class, 'getIndex']);
Route::get('/mobile', [PagesController::class, 'getIndexmobile']);
Route::get('/admindashboard', [PagesController::class, 'getLandingpage']);
Route::get('/withdrawal',[PaymentController::class, 'getWithdrawal']);
Route::get('/withdrawal-annuler',[PaymentController::class, 'getWithdrawal_annuler']);
Route::get('/treatment',[PaymentController::class, 'getTreatment']);
Route::get('/validation_history',[PaymentController::class, 'getValidatedtopuphistory']);
Route::get('/fees',[PaymentController::class, 'getFees']);
Route::get('/fees_entretien',[PaymentController::class, 'feesentretien']);
Route::get('/tva',[PaymentController::class, 'getTva']);
Route::get('/capitalisation',[PaymentController::class, 'getCapitalisation']);
Route::get('/forexecheancier',[PaymentController::class, 'getForexecheancier']);
Route::get('/forexecheancierp',[PaymentController::class, 'getForexecheancierp']);
Route::get('/withdrawalstatement',[PaymentController::class, 'getWithdrawalstatement']);
Route::get('/transferts',[PaymentController::class, 'getTransfert']);
Route::get('/withdrawalstatementref/{id}',[PaymentController::class, 'getWithdrawalstatementref']);
Route::get('/nouvelle_proforma',[PagesController::class, 'getnewproforma']);
Route::get('/activationcodes',[CodesController::class, 'getcodes']);
Route::get('/activationcodes_gen',[CodesController::class, 'getcodesgen']);
Route::get('/liste_proforma',[PagesController::class, 'getlisteproforma']);
Route::get('/liste_facture',[PagesController::class, 'getlistefacture']);
Route::get('/liste_utilisateurs',[PagesController::class, 'getlisteutilisateurs']);
Route::get('/nouvelle_utilisateur',[PagesController::class, 'getnewutilisateur']);
Route::get('/supprimer-client/{id}',[CustomerController::class, 'getsupprimerclient']);

Route::get('/Historique-Immo',[CustomerController::class, 'gethistoriqimmo']);
Route::get('/Clients-Immo',[CustomerController::class, 'getclientsimmo']);

Route::get('/reponse_support/{id}',[PagesController::class, 'getReponse_support']);
Route::get('/rep_support/{id}',[PagesController::class, 'getRep_support']);
Route::get('/test',[PagesController::class, 'test']);
Route::get('/all_support',[PagesController::class, 'GetAll']);
Route::get('/support',[PagesController::class, 'getSupport']);
Route::get('/supports',[PagesController::class, 'getSupports']);
Route::get('/executed_support/{id}',[PagesController::class, 'getExecuted_support']);

Route::get('/active-customer/{id}',[PagesController::class, 'getactivecustomer']);
Route::get('/deactive-customer/{id}',[PagesController::class, 'getdeactivecustomer']);

//API
Route::get('/validatedtopup/{id}',[PaymentController::class, 'getValidationdone']);
Route::get('/refusedtopup/{id}',[PaymentController::class, 'getRefusedtopup']);
Route::post('/executed/{id}',[PaymentController::class, 'getWithdrawaldone']);
Route::get('/custinfo/{id}',[CustomerController::class, 'getCustomerpaymentinfo']);
Route::get('/Users_licence/{id}',[CustomerController::class, 'getUserslicence']);
Route::get('/By_licence',[CustomerController::class, 'Bylicence']);
Route::get('/modifinfo/{id}',[CustomerController::class, 'getCustomermodificationinfo']);
Route::get('/exact_amount/{id}',[PaymentController::class, 'getExactamountwithdrawal']);
Route::get('/traite_amount/{id}',[PaymentController::class, 'getTraiteamount']);
Route::get('/consultercommande/{id}',[PagesController::class, 'getConsultationcommande']);
Route::get('/soumettrecommande/{id}',[PagesController::class, 'getSoumissioncommande']);
Route::get('/acceptercommande/{id}',[PagesController::class, 'getAcceptioncommande']);
Route::get('/envoyerfacture/{id}',[PagesController::class, 'getenvoifacture']);
Route::get('/versementcommande/{id}',[PagesController::class, 'getVersementcommande']);
Route::get('/previewproformat/{id}',[PagesController::class, 'getPreviewproformat']);
Route::get('/previewrecu/{id}',[PagesController::class, 'getPreviewrecu']);
Route::get('/previewfacture/{id}',[PagesController::class, 'getPreviewfacture']);
Route::get('/modifuser/{id}',[PagesController::class, 'getmodifieruser']);
Route::get('/modifiercommande/{id}',[PagesController::class, 'getmodifcommande']);
Route::get('/activationcodes_assign/{id}',[CodesController::class, 'getcodesassignmentpage']);


//post
Route::post('/codes_generation',[CodesController::class, 'codesgeneration']);
Route::post('/newproforma',[PagesController::class, 'proformageneration']);
Route::post('/newversement',[PagesController::class, 'versementcommande']);
Route::post('/newuser',[PagesController::class, 'ajouteruser']);
Route::post('/moduser',[PagesController::class, 'modiuser']);
Route::post('/report_withdrawal',[PaymentController::class, 'get_Report_withdrawal']);
Route::post('/report_withdrawal_op',[PaymentController::class, 'get_Report_withdrawalop']);
Route::post('/report_treatment_select',[PaymentController::class, 'get_Report_treatment_select']);
Route::post('/treatment_select_date',[PaymentController::class, 'getTreatment_select']);
Route::post('/withdrawal_statement_operation',[PaymentController::class, 'getWithdrawal_statement_operation']);
Route::post('/withdrawal_statement_date',[PaymentController::class, 'getWithdrawal_statement_date']);
Route::post('/modifiproforma',[PagesController::class, 'modipro']);
Route::post('/assigncode',[CodesController::class, 'codeassignation']);
Route::post('/update/{id}',[CustomerController::class, 'update']);


Route::post('/rp_sup/{id}',[PagesController::class, 'postSuprep']);


//resources

Route::resource('Customers', CustomerController::class);
Route::resource('Payments', PaymentController::class);

//authentication
Route::post('/customerlogin', [AuthenticationController::class, 'postlogin']);
Route::get('/logout', [AuthenticationController::class, 'getLogout']);


//pdf
// Route::get('pdfview',array('as'=>'pdfview','uses'=>'PagesController@pdfview'));
Route::get('pdfview', [PagesController::class, 'pdfview']);
 

