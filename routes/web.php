<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

/* Pages Controller*/
Route::get('/dashboard', 'PagesController@index');
Route::get('/', 'PagesController@home');
Route::get('/aboutus', 'PagesController@aboutus');
Route::get('/examtypes', 'PagesController@examtypes');
Route::get('/addexamtype', 'PagesController@addexamtype');
Route::get('/subjects', 'PagesController@subjects');
Route::get('/addsubject', 'PagesController@addsubject');
Route::get('/categories', 'PagesController@categories');
Route::get('/addcategory', 'PagesController@addcategory');
Route::get('/subcategories', 'PagesController@subcategories');
Route::get('/addsubcategory', 'PagesController@addsubcategory');
Route::get('/levels', 'PagesController@levels');
Route::get('/addlevel', 'PagesController@addlevel');
Route::get('/grades', 'PagesController@grades');
Route::get('/addgrade', 'PagesController@addgrade');
Route::get('/entermcqquestion', 'PagesController@entermcqquestion');
Route::get('/entertruefalsequestion', 'PagesController@entertruefalsequestion');
Route::get('/entermatchingquestion', 'PagesController@entermatchingquestion');
Route::get('/enterfillblanksquestion', 'PagesController@enterfillblanksquestion');
Route::get('/entershortquestion', 'PagesController@entershortquestion');
Route::get('/enteressayquestion', 'PagesController@enteressayquestion');
Route::get('/savedquestionsqueu', 'PagesController@savedquestionsqueu');
Route::get('/forapprovequestionsqueu', 'PagesController@forapprovequestionsqueu');
Route::get('/onholdquestionsqueu', 'PagesController@onholdquestionsqueu');
Route::get('/rejectedquestionsqueu', 'PagesController@rejectedquestionsqueu');
Route::get('/promotionsmanager', 'PagesController@promotionsmanager');
Route::get('/promocodemanager', 'PagesController@promocodemanager');
Route::get('/searchquestion', 'PagesController@searchquestion');
Route::get('/examtemplates', 'PagesController@examtemplates');
Route::get('/newexamtemplate', 'PagesController@newexamtemplate');
Route::get('/loginpage', 'PagesController@loginpage');
Route::get('/registernewstudent', 'PagesController@registernewstudent');
Route::get('/elearninghome', 'PagesController@elearninghome');
Route::get('/promotionselect/{id}', 'PagesController@promotionselect');
Route::get('/examhome', 'PagesController@examhome');
Route::get('/addpromotion', 'PagesController@addpromotion');
Route::get('/addpromocode', 'PagesController@addpromocode');
Route::get('/paymentselect', 'PagesController@paymentselect');
Route::get('/paymentmanger', 'PagesController@paymentmanger');
Route::get('/paymentmangerview/{id}', 'PagesController@paymentmangerview');
Route::get('/launchexam/{id}', 'PagesController@launchexam');
Route::get('/userprofile/{id}', 'PagesController@userprofile');
Route::get('/userprofileadmin/{id}', 'PagesController@userprofileadmin');
Route::get('/userroles', 'PagesController@userroles');
Route::get('/addrole', 'PagesController@addrole');
Route::get('/userlist', 'PagesController@userlist');
Route::get('/addnewuser', 'PagesController@addnewuser');
Route::get('/registernewuser', 'PagesController@registernewuser');
Route::get('/dataentrylist', 'PagesController@dataentrylist');
Route::get('/studentslist', 'PagesController@studentslist');
Route::get('/pricingmanager', 'PagesController@pricingmanager');
Route::get('/addnewpricing', 'PagesController@addnewpricing');
Route::get('/forgotmypassword', 'PagesController@forgotmypassword');
Route::get('/papercorrection', 'PagesController@papercorrection');
Route::get('/passwordpolicy', 'PagesController@passwordpolicy');
Route::get('/addnewsecurityquestion', 'PagesController@addnewsecurityquestion');
Route::get('/studenthistory', 'PagesController@studenthistory');
Route::get('/privileges', 'PagesController@privileges');
Route::get('/addprivilege', 'PagesController@addprivilege');
Route::get('/manageprivilege/{id}', 'PagesController@manageprivilege');
Route::get('/courses', 'PagesController@courses');
Route::get('/promopage', 'PagesController@promopage');
Route::get('/privacypolicy', 'PagesController@privacypolicy');
Route::get('/contactus', 'PagesController@contactus');


/* Master Data Management Section*/
//Get Requests
Route::get('/manageexamtype/{id}', 'MasterDataController@manageexamtype');
Route::get('/removeexamtype/{id}', 'MasterDataController@removeexamtype');
Route::get('/managesubject/{id}', 'MasterDataController@managesubject');
Route::get('/removesubject/{id}', 'MasterDataController@removesubject');
Route::get('/managecategory/{id}', 'MasterDataController@managecategory');
Route::get('/removecategory/{id}', 'MasterDataController@removecategory');
Route::get('/managesubcategory/{id}', 'MasterDataController@managesubcategory');
Route::get('/removesubcategory/{id}', 'MasterDataController@removesubcategory');
Route::get('/managelevel/{id}', 'MasterDataController@managelevel');
Route::get('/removelevel/{id}', 'MasterDataController@removelevel');
Route::get('/managegrade/{id}', 'MasterDataController@managegrade');
Route::get('/removegrade/{id}', 'MasterDataController@removegrade');
Route::get('/getsubcategorydata/{id}', 'MasterDataController@getsubcategorydata');
Route::get('/getcategorylist/{id}', 'MasterDataController@getcategorylist');
Route::get('/getcategoryset/{id}', 'MasterDataController@getcategoryset');
Route::get('/gettransactiondata/{id}', 'MasterDataController@gettransactiondata');
Route::get('/getexamdataforsubject/{id}', 'MasterDataController@getexamdataforsubject');
Route::get('/managedataentryop/{id}', 'MasterDataController@managedataentryop');
Route::get('/passwordrestter/{id}', 'MasterDataController@passwordrestter');
Route::get('/manageuser/{id}', 'MasterDataController@manageuser');
Route::get('/deleterole/{id}', 'MasterDataController@deleterole');
Route::get('/managepromotion/{id}', 'MasterDataController@managepromotion');
Route::get('/removepromotion/{id}', 'MasterDataController@removepromotion');

//Post Requests
Route::post('/saveexamtype', 'MasterDataController@saveexamtype');
Route::post('/editexamtype', 'MasterDataController@editexamtype');
Route::post('/savesubject', 'MasterDataController@savesubject');
Route::post('/editsubject', 'MasterDataController@editsubject');
Route::post('/savecategory', 'MasterDataController@savecategory');
Route::post('/editcategory', 'MasterDataController@editcategory');
Route::post('/savesubcategory', 'MasterDataController@savesubcategory');
Route::post('/editsubcategory', 'MasterDataController@editsubcategory');
Route::post('/savelevel', 'MasterDataController@savelevel');
Route::post('/editlevel', 'MasterDataController@editlevel');
Route::post('/savegrade', 'MasterDataController@savegrade');
Route::post('/editgrade', 'MasterDataController@editgrade');
Route::post('/savepromotion', 'MasterDataController@savepromotion');
Route::post('/saveuserrole', 'MasterDataController@saveuserrole');
Route::post('/updateuserrole', 'MasterDataController@updateuserrole');
Route::post('/editdataentryallowance', 'MasterDataController@editdataentryallowance');
Route::post('/sendforgotemail', 'MasterDataController@sendforgotemail');
Route::post('/updatepassword', 'MasterDataController@updatepassword');
Route::post('/updatetransactionstate', 'MasterDataController@updatetransactionstate');
Route::post('/savesecurityquestion', 'MasterDataController@savesecurityquestion');
Route::post('/savepasswordpolicy', 'MasterDataController@savepasswordpolicy');
Route::post('/updateuser', 'MasterDataController@updateuser');
Route::post('/saveuprivilege', 'MasterDataController@saveuprivilege');
Route::post('/updateprivilege', 'MasterDataController@updateprivilege');
Route::post('/updatepromotion', 'MasterDataController@updatepromotion');



/*Questions Controllers*/
//GET Requests
Route::get('/reviewquestion/{id}', 'QuestionsController@reviewquestion');
Route::get('/approvequestion/{id}', 'QuestionsController@approvequestion');
Route::get('/onholdquestion/{id}', 'QuestionsController@onholdquestion');
Route::get('/rejectquestion/{id}', 'QuestionsController@rejectquestion');
Route::get('/removequestion/{id}', 'QuestionsController@removequestion');
Route::get('/editquestion/{id}', 'QuestionsController@editquestion');
Route::get('/prequestion_review/{id}', 'QuestionsController@prequestion_review');
Route::get('/nextquestion_review/{id}', 'QuestionsController@nextquestion_review');

//POST Requests
Route::post('/savemcqquestion', 'QuestionsController@savemcqquestion');
Route::post('/savetruefalsequestion', 'QuestionsController@savetruefalsequestion');
Route::post('/savematchingquestion', 'QuestionsController@savematchingquestion');
Route::post('/saveshortquestion', 'QuestionsController@saveshortquestion');
Route::post('/saveessayquestion', 'QuestionsController@saveessayquestion');
Route::post('/savefillblanksquestion', 'QuestionsController@savefillblanksquestion');
Route::post('/updatemcqquestion', 'QuestionsController@updatemcqquestion');
Route::post('/updatetruefalsequestion', 'QuestionsController@updatetruefalsequestion');
Route::post('/updatematchingquestion', 'QuestionsController@updatematchingquestion');
Route::post('/updateshortquestion', 'QuestionsController@updateshortquestion');
Route::post('/updateessayquestion', 'QuestionsController@updateessayquestion');

Route::post('/filterqueu3', 'QuestionsController@filterqueu3');
Route::post('/filterdash_tobe', 'QuestionsController@filterdash_tobe');
Route::post('/filteredapprove', 'FiltersController@filteredapprove');
Route::post('/filteronhold', 'FiltersController@filteronhold');
Route::post('/filtertobe', 'FiltersController@filtertobe');
Route::post('/filterreject', 'FiltersController@filterreject');
Route::post('/advancedsearchsubmit', 'QuestionsController@advancedsearchsubmit');


/*Paper Template Controller*/
//POST
Route::post('/savepapertemplate', 'PaperTemplateController@savepapertemplate');

/*Exam Controller*/
Route::post('/startexam', 'ExamController@startexam');
Route::post('/saveexamanswer', 'ExamController@saveexamanswer');
Route::post('/nextajaxexam', 'ExamController@nextajaxexam');
Route::post('/saveanswermcq', 'ExamController@saveanswermcq');
Route::post('/saveanswerfillblanks', 'ExamController@saveanswerfillblanks');
Route::post('/saveanswertruefalse', 'ExamController@saveanswertruefalse');
Route::post('/saveanswermatching', 'ExamController@saveanswermatching');
Route::post('/saveanswershort', 'ExamController@saveanswershort');
Route::post('/saveansweressay', 'ExamController@saveansweressay');
Route::post('/examfinishedupdate', 'ExamController@examfinishedupdate');
Route::post('/complatepapercorrection', 'ExamController@complatepapercorrection');

Route::get('/papercorrectionpage/{id}', 'ExamController@papercorrectionpage');
Route::get('/answercanvas/{id}', 'ExamController@answercanvas');
Route::get('/openpapercorrection/{id}', 'ExamController@openpapercorrection');
Route::get('/viweexamresults/{id}', 'ExamController@viweexamresults');

//Canvas for answers
Route::post('/saveanswercanvas', 'CanvasController@saveanswercanvas');
Route::post('/doneanswercanvas', 'CanvasController@doneanswercanvas');

Route::get('/getthepenanswers/{id}', 'CanvasController@getthepenanswers');


/*Exam Templates Controller*/
Route::post('/updatepapertemplate', 'ExamTemplatesController@updatepapertemplate');
Route::post('/ajaxrequest', 'ExamTemplatesController@ajaxrequest');

Route::get('/editexamtemplate/{id}', 'ExamTemplatesController@editexamtemplate');
Route::get('/removetemplate/{id}', 'ExamTemplatesController@removetemplate');

/**Exams Seacrh Controller */
Route::post('/searchexamshome', 'ExamsSearchController@searchexamshome');
Route::post('/searchpromohome', 'ExamsSearchController@searchpromohome');

/*Pricing Controller*/
Route::post('/savepricing', 'PricingController@savepricing');
Route::post('/updatepricing', 'PricingController@updatepricing');
Route::post('/buynewexam', 'PricingController@buynewexam');
Route::post('/proceedtoexampay', 'PricingController@proceedtoexampay');
Route::post('/saveexampayment', 'PricingController@saveexampayment');
Route::post('/emailreceipt', 'PricingController@emailreceipt');
Route::post('/searchpayentries', 'PricingController@searchpayentries');
Route::post('/cardpayproceed', 'PricingController@cardpayproceed');
Route::any('cardpaylistner', 'PricingController@cardpaylistner');
//Http::post('/cardpaylistner', 'PricingController@cardpaylistner');


Route::get('/deletepayment/{id}', 'PricingController@deletepayment');
Route::get('/shoppingcartpage', 'PricingController@shoppingcartpage');
Route::get('/managepricing/{id}', 'PricingController@managepricing');
Route::get('/removepricing/{id}', 'PricingController@removepricing');
Route::get('/clearshoppingcart', 'PricingController@clearshoppingcart');


/* Login Controllers*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registeruser', 'MasterDataController@registeruser');
Route::post('/registerstudent', 'MasterDataController@registerstudent');//This is old full reg function [DEPRECATED]
Route::post('/registerstudentsimp', 'MasterDataController@registerstudentsimp');
Route::post('/changepassworduser', 'MasterDataController@changepassworduser');
Route::post('/changepasswordadmin', 'MasterDataController@changepasswordadmin');
Route::post('/changelanguage', 'MasterDataController@changelanguage');
Route::post('/updatesecurityquestion', 'MasterDataController@updatesecurityquestion');

Route::get('/emailactivation/{id}', 'MasterDataController@emailactivation');
Route::get('/editpolicyquestion/{id}', 'MasterDataController@editpolicyquestion');
Route::get('/managerole/{id}', 'MasterDataController@managerole');
Route::get('/removeuser/{id}', 'MasterDataController@removeuser');



//PDF
Route::post('/pdfreceipt', 'PdfReceiptController@pdfreceipt');


Route::get('/guidlinecanvas/{id}', 'CanvasController@guidlinecanvas');
Route::get('/readessaycookies/{id}', 'CanvasController@readessaycookies');

Route::post('/saveguidlinecanvas', 'CanvasController@saveguidlinecanvas');
Route::post('/doneguidlinecanvas', 'CanvasController@doneguidlinecanvas');




/* Promo Code Controller */

Route::get('/managepromocode/{id}', 'PromoCodeController@managepromocode');
Route::get('/copypromocode/{id}', 'PromoCodeController@copypromocode');
Route::get('/getpayment', 'PromoCodeController@getpayment');


Route::post('/savepromocode', 'PromoCodeController@savepromocode');
Route::post('/updatepromocode', 'PromoCodeController@updatepromocode');



/* Reports Controller */
Route::get('/questionsreport', 'ReportsConstroller@questionsreport');
Route::get('/revenuereport', 'ReportsConstroller@revenuereport');
Route::get('/purchasereport', 'ReportsConstroller@purchasereport');
Route::get('/studentsreport', 'ReportsConstroller@studentsreport');
Route::get('/promocodereport', 'ReportsConstroller@promocodereport');
Route::get('/auditreport', 'ReportsConstroller@auditreport');

Route::post('/genquestionsreport', 'ReportsConstroller@genquestionsreport');
Route::post('/questionsreportPDF', 'ReportsConstroller@questionsreportPDF');
Route::post('/genrevenuereport', 'ReportsConstroller@genrevenuereport');
Route::post('/revenuereportPDF', 'ReportsConstroller@revenuereportPDF');
Route::post('/genpurchasereport', 'ReportsConstroller@genpurchasereport');
Route::post('/purchasereportPDF', 'ReportsConstroller@purchasereportPDF');
Route::post('/genstudentreport', 'ReportsConstroller@genstudentreport');
Route::post('/studentreportPDF', 'ReportsConstroller@studentreportPDF');
Route::post('/genpromocodereport', 'ReportsConstroller@genpromocodereport');
Route::post('/promocodereportPDF', 'ReportsConstroller@promocodereportPDF');
Route::post('/generateauditreport', 'ReportsConstroller@generateauditreport');

// Custom Maintain Scripts
Route::get('/qsimagepaths', 'CustomScriptsController@qsimagepaths');

// Promotion Buy Controller
Route::post('/proceedpromopurchase', 'PromotionBuyController@proceedpromopurchase');
Route::post('/savepromopayment', 'PromotionBuyController@savepromopayment');


Route::get('/paymentmangerviewpromo/{id}', 'PromotionBuyController@paymentmangerviewpromo');

