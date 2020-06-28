<?php

use Illuminate\Support\Facades\DB;
use App\Automobiles;

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

Route::get('/', function () {
	$automibilesModel = new Automobiles;
    return view('home', ['automobilesList' => $automibilesModel->select('Brand', 'Model', 'Year')->get()]);
});

Route::post('/addAutomobiles','AjaxController@addAutomobiles');

Auth::routes();
