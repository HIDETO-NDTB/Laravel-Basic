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

Route::view('/','welcome');

//Basic Routing
Route::get('/hello',function(){
    return "<h2>Hello World</h2>";
})->name('First');

//Dynamic Routing
Route::get('/user/{name}',function($name){
    return "<h2>Hi $name, Welcome to our site</h2>";
});

Route::get('/user/{id}/{name}',function($id,$name){
    return "<h2>Id: ".$id." Name:" .$name."</h2>";
});

Route::get('/index',function(){
    return view('pages.index');
})->name('index');

Route::get('/services',function(){
    $data = [
        'title' => 'services',
        'services' => ['web design','programming','seo']
    ];
    return view('pages.services')->with($data);
});

Route::redirect('/hello','/index')->name("Redirect to index");

//Optional paramater
Route::get('/hai/{name?}',function($name = null){
    return"<h2>Hai {$name}!</h2>";
})->name('hai');

//Regural Expression constraint
Route::get('/emp/{name}',function($name){
    return "<h2>Welcome {$name}</h2>";
})->where('name','[A-Za-z]+');

// php artisan make: authで勝手にできる
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ここまで


Route::get('/todos','TodosController@index')->name('todos.index');


// detail
Route::get('/todo/{todo}','TodosController@show')->name('todos.show');

Route::get('/done-todo/{id}','TodosController@done')->name('todos.done');
Route::get('/not-done-todo/{id}','TodosController@not_done')->name('todos.not-done');


// ログアウト時に他のページに行かないように
Route::group(['middleware' => 'auth'],function(){
    // create
    Route::get('/new-todo','TodosController@create')->name('todos.create');
    // store button（createの決定）
    Route::post('/store-todo','TodosController@store')->name('todos.store');
    // edit（updateの変更画面）
    Route::get('/edit-todo/{todo}','TodosController@edit')->name('todos.edit');
    // update button
    Route::post('/update-todo/{todo}','TodosController@update')->name('todos.update');
    // delete
    Route::delete('/todo/{todo}','TodosController@delete')->name('todos.delete');

});

Route::view('/test','pages.index')->name('test.auth');
