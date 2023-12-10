<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\PostShortController;
use App\Http\Controllers\Api\QuestionsController;
use App\Http\Controllers\Api\PostRelatedController;

use App\Http\Controllers\Api\ParserController;
use App\Http\Controllers\Api\TranslationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/test', function (Request $request) {
//     return ['mode' => 'test'];
// });

//Все вопросы на главной странице с кратким опсанием
Route::get('/questions', [PostShortController::class, 'short']); //все вопросы с кратким описанием, нужно добавить сотрировку по дате и просморам

//Конкретный вопрос
Route::get('/question/{alias}', [PostController::class, 'get']);

//Получить похожие вопросы
Route::get('/related', [PostRelatedController::class, 'getRelated']); //похожие вопросы

//Получить ответы на Конкретный вопрос
Route::get('/answers/{id}', [PostController::class, 'getAnswers']); //ответы
Route::get('top/answer', [PostController::class, 'getTopAnswers']); //популярные ответы
Route::get('pagetop', [PostController::class, 'getTopQuestions']); //страница популярные/новые ответы



Route::get('/questions/tophome', [QuestionsController::class, 'topHome']); //Заголовки популярных вопросов
Route::get('/questions/newhome', [QuestionsController::class, 'newHome']); //Заголовки новых вопросов
Route::get('/questions/tag/{alias}', [QuestionsController::class, 'getQuestionsTag']); // получить статьи по тегу


//Популярные теги, по кол-ву вопросов
Route::get('/tag/{alias}', [TagsController::class, 'getDescByAlias']); // популярные топовые вопросы по тегу
Route::get('/tags/top', [TagsController::class, 'top']); // популярные топовые вопросы по тегу
Route::get('/tags/list', [TagsController::class, 'listShort']); // Теги на странице тегов
Route::get('/tags/desc/{id}', [TagsController::class, 'getDescTag']); // Теги на странице тегов
Route::get('/tags/desc/{alias}', [TagsController::class, 'tagDesc']); // только описание тега


//Получить имя пользователя (Автор вопроса)
Route::get('/user/{id}', [UserController::class, 'getUserName']);


//Короткие вопросы по определённому тегу
//Популярные вопросы внутки конкретного тега с короткими вопросами


Route::get('search', [SearchController::class, 'getSearch']); //поиск


//! Очереди, на перевод статей и прочее
// Route::get('test', [TranslationController::class, 'translate']); //?создать файл
// Route::get('test_parser', [ParserController::class, 'processFiles']); //?отправить файл в базу