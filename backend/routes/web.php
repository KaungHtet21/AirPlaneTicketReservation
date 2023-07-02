<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\afterTransactionController;
use App\Http\Controllers\seedingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AdminController::class,'homePage'])->name('homePage');
Route::post('admin',[AdminController::class,'authentication'])->name('admin#authentication');
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('flights',[AdminController::class,'manageFlights'])->name('manage#flights');
Route::get('addFlights',[AdminController::class,'addFlights'])->name('add#flight');
Route::get('editflight/{id}',[AdminController::class,'editflight'])->name('edit#flight');
Route::get('deleteflight/{id}',[AdminController::class,'deleteflight'])->name('delete#flight');

Route::post('addFlight',[AdminController::class,'addNewFlight'])->name('add#newflight');
Route::post('updateFlight/{id}',[AdminController::class,'updateFlight'])->name('update#flight');
Route::post('fliterFlight',[AdminController::class,'filterFlights'])->name('filter#flights');
Route::get('previousFlight',[AdminController::class,'previousFlight'])->name('flight#previous');
Route::get('upcomingFlight',[AdminController::class,'upcomingFlight'])->name('flight#upcoming');
Route::get('todayFlight',[AdminController::class,'todayFlight'])->name('flight#today');


Route::get('seats',[AdminController::class,'manageSeats'])->name('manage#seats');
Route::get('addNewSeats',[AdminController::class,'addSeats'])->name('add#seats');
Route::post('searchSeats',[AdminController::class,'searchSeats'])->name('search#seats');
Route::post('addNewSeats',[AdminController::class,'addNewSeats'])->name('add#newSeats');
Route::get('edit/{id}',[AdminController::class,'editSeat'])->name('edit#seat');
Route::get('delete/{id}',[AdminController::class,'deleteSeat'])->name('delete#seat');
Route::post('updateSeat/{id}',[AdminController::class,'updateSeat'])->name('update#seat');
Route::get('updateseatPrice',[AdminController::class,'updateSeatPrice'])->name('update#seatPrice');

Route::get('transactions',[AdminController::class,'manageTransactions'])->name('manage#transactions');
Route::get('editTransactions/{id}',[AdminController::class,'editTransaction'])->name('edit#transaction');
Route::get('deleteTransactions/{id}',[AdminController::class,'deleteTransaction'])->name('delete#transaction');
Route::post('searchTransactions',[AdminController::class,'searchTransactions'])->name('search#transactions');
Route::get('details/{id}',[AdminController::class,'detailsTransaction'])->name('details#transaction');


Route::get('users',[AdminController::class,'manageUsers'])->name('manage#users');
Route::get('editusers/{id}',[AdminController::class,'editUser'])->name('edit#user');
Route::get('deleteusers/{id}',[AdminController::class,'deleteUser'])->name('delete#user');
Route::post('updateusers/{id}',[AdminController::class,'updateUser'])->name('update#user');

Route::get('editpassengers/{id}',[AdminController::class,'editPassenger'])->name('edit#passenger');
Route::get('deletepassengers/{id}',[AdminController::class,'deletePassenger'])->name('delete#passenger');
Route::post('updatepassengers/{id}',[AdminController::class,'updatePassenger'])->name('update#passenger');

Route::post('filter',[AdminController::class,'filterTransactions'])->name('filter#transactions');

Route::get('reservations',[AdminController::class,'manageReservations'])->name('manage#reservations');
Route::get('detailsReservations/{id}',[AdminController::class,'detailsReservation'])->name('details#reservation');
Route::post('filterStatus',[AdminController::class,'filterStatus'])->name('reservation#statusFilter');
Route::post('filterOffice',[AdminController::class,'filterOffice'])->name('reservation#officeFilter');
Route::post('sortDueDate',[AdminController::class,'sortDueDate'])->name('reservation#dueDateSort');

Route::get('/offices',[AdminController::class,'manageOffices'])->name('manage#offices');
Route::get('editoffices/{id}',[AdminController::class,'editOffice'])->name('edit#office');
Route::get('deleteoffices/{id}',[AdminController::class,'deleteOffice'])->name('delete#office');
Route::post('update/{id}',[AdminController::class,'updateoffice'])->name('update#office');

Route::get('/members',[AdminController::class,'manageMembers'])->name('manage#members');
Route::post('/selectMembers',[AdminController::class,'selectMembers'])->name('select#memberType');

Route::get('/reports',[AdminController::class,'reports'])->name('monthly#reports');
Route::post('/date',[AdminController::class,'dateSelect'])->name('date#select');
Route::get('/month',[AdminController::class,'monthlyReports']);

Route::get('/mile',[AdminController::class,'mile']);
Route::get('/tickets',[AdminController::class,'tickets']);
Route::get('/cancel',[AdminController::class,'cancellation']);
Route::get('/mail',[AdminController::class,'sendCancellationFailedMail']);

Route::get('/addOffice',[AdminController::class,'addHeadOffice'])->name('add#headOffice');
Route::post('/addNewOffice',[AdminController::class,'addNewHeadOffice'])->name('add#newHeadOffice');


//  Route::get('/postPassengersInfo',[RouteController::class,'postPassengersInfo']);
//  Route::get('/afterTransaction',[transactionController::class,'afterTransaction']);

 Route::get('tickets',[TicketController::class,'manageTickets'])->name('manage#tickets');
 Route::get('confirmedTickets',[TicketController::class,'filterConfirmedTickets'])->name('filterConfirmed');
 Route::get('pendingTickets',[TicketController::class,'filterPendingTickets'])->name('filterPending');
  Route::get('cancelledTickets',[TicketController::class,'filterCancelledTickets'])->name('filterCancelled');
  Route::get('testing',[transactionController::class,'sendReservationMail']);
//  Route::post('/test',[transactionController::class,'testingPost'])->name('testing');


Route::get('testReservation',[transactionController::class,'testReservation']);
Route::get('deduct',[transactionController::class,'deductAmount']);
