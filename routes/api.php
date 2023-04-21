<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ListVoteController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user', [AdminController::class,'authenticate']);
Route::get('/vote/{id}', [VoteController::class, 'printFullPollVote']);
Route::post('/vote', [VoteController::class, 'voteChoice']);
Route::get('/list-vote', [ListVoteController::class, 'listVoteContent']);
Route::post('/add-question', [VoteController::class, 'addPollQuestion']);