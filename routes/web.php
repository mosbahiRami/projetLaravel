<?php

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

Route::get('/login','administrateurController@getLogin');
Route::get('/','administrateurController@getLogin');
Route::post('/checklogin','administrateurController@authentification');
Route::get('/dashboard','administrateurController@getDashboard');

//Partie Gouvernorat
Route::get('/gouvernorats','gouvernoratController@index');
Route::post('/ajouterGouvernorat','gouvernoratController@ajouterGouvernorat');
Route::get('/supprimerGouvernorat/{id}','gouvernoratController@supprimerGouvernorat');
Route::get('/updateGouvernorat/{id}','gouvernoratController@show');
Route::post('/modifierGouvernorat','gouvernoratController@modifierGouvernorat');
Route::get('/ws','gouvernoratController@ws');
Route::get('toPdf','gouvernoratController@pdf');
Route::get('toExcel','gouvernoratController@excel');
Route::post('importExcel','gouvernoratController@importExcel');

//Partie Faculte
Route::get('/facultes','faculteController@index');
Route::post('/ajouterFaculte','faculteController@ajouterFaculte');
Route::get('/supprimerFaculte/{id}','faculteController@supprimerFaculte');
Route::get('/updateFaculte/{id}','faculteController@show');
Route::post('/modifierFaculte','faculteController@modifierFaculte');

//Partie Chambre
Route::get('/chambres','chambreController@index');
Route::post('/ajouterChambre','chambreController@ajouterChambre');
Route::get('/supprimerChambre/{id}','chambreController@supprimerChambre');
Route::get('/updateChambre/{id}','chambreController@show');
Route::post('/modifierChambre','chambreController@modifierChambre');


//Partie Administrateur
Route::get('/administrateurs','administrateurController@index');
Route::post('/ajouterAdministrateur','administrateurController@ajouterAdministrateur');
Route::get('/supprimerAdministrateur/{id}','administrateurController@supprimerAdministrateur');
Route::get('/updateAdministrateur/{id}','administrateurController@show');
Route::post('/modifierAdministrateur','administrateurController@modifierAdministrateur');

//Partie Etudiant
Route::get('/etudiants','etudiantController@index');
Route::get('/supprimerEtudiant/{id}','etudiantController@supprimerEtudiant');
Route::get('toPdfEtudiant','etudiantController@pdf');
Route::get('toExcelEtudiant','etudiantController@excel');
Route::post('importExcelEtudiant','etudiantController@importExcel');

//Partie Hébergé
Route::get('/heberges','hebergeController@index');
Route::post('/ajouterHeberge','hebergeController@ajouterHeberge');
Route::get('/supprimerHeberge/{id}','hebergeController@supprimerHeberge');
Route::get('/updateHeberge/{id}','hebergeController@show');
Route::post('/modifierHeberge','hebergeController@modifierHeberge');
Route::get('toPdfHeberge','hebergeController@pdf');
Route::get('toExcelHeberge','hebergeController@excel');
Route::post('importExcelHeberge','hebergeController@importExcel');
Route::get('/wsHeberge','hebergeController@ws');

//Partie Paiement
Route::get('/paiements','paiementController@index');
Route::post('/ajouterPaiement','paiementController@ajouterPaiement');
Route::get('/supprimerPaiement/{id}','paiementController@supprimerPaiement');
Route::get('/updatePaiement/{id}','paiementController@show');
Route::post('/modifierPaiement','paiementController@modifierPaiement');
Route::get('/wsPaiement','paiementController@wsPaiement');