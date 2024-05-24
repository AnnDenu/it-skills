<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SheduleController;
use App\Http\Controllers\ReviewController;
use App\Models\Shedule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CourseController::class, 'index'])->name('welcome');

//Вывод страницы "О нас"
Route::get('about', [AboutController::class, 'show'])->name('about');

//Вывод всех курсов у user
Route::get('dashboardCourse', [CourseController::class, 'courseShow'])->name('course.show');
Route::get('course/{category}', [CourseController::class, 'courseShow'])->name('course.category');
//Подробности курса (карточка)
Route::get('/show/{id}', [CartController::class, 'cart'])->name('cart');

Route::get('reviews', [ReviewController::class, 'reviewList'])->name('review.list');
Route::get('/reviews/list', [ReviewController::class, 'showReviewsByCourse'])->name('review.list');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Управление избранным у пользователя

    Route::get('/favorite', [FavoriteController::class, 'wishlist'])->middleware(['auth', 'verified'])->name('wishlist');
    Route::post('/favorite/{id}', [FavoriteController::class, 'favoriteStore'])->middleware(['auth', 'verified'])->name('update');
    Route::delete('/favorite/{id}', [FavoriteController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy');

    //Получает отзывы
    Route::get('/courses/{id}/reviews', [CartController::class, 'index'])->name('reviews.index');
    //Принимает все отзывы в определнном курсе
    Route::post('/course/{id}/review', [ReviewController::class, 'reviewCourse'])->name('review.course');
    //Обновление избранного
    Route::patch('/reviews/update/{id}', [ReviewController::class, 'update'])
        ->name('reviews.update');
    //удаление отзывы
    Route::delete('/reviews/{id}/destroy', [CartController::class, 'destroy'])->name('reviews.destroy');

    //Вывод у администратора
    Route::get('/reviews/control', [ReviewController::class, 'store'])->name('review.store');


    //Переход в личный кабинет
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    //Просмотр курсов на которые записались
    Route::get('/student/checkout', [StudentController::class, 'checkoutCourse'])->name('course.checkout');
    
    Route::get('/student/{id}', [StudentController::class, 'courseLK'])->name('course.lk');
    Route::get('/student/theme/{id}', [StudentController::class, 'themeLK'])->name('theme.lk');
    Route::post('/student/theme/{id}', [StudentController::class, 'upload'])->name('create.works');
    Route::post('/student/course/{id}', [StudentController::class, 'addCourseToCart'])->name('addCourse.to.cart');
    Route::delete('/student/delete-cart-course/{course}', [StudentController::class, 'destroy'])->name('deleteCourse');


    //Управление категориями
    Route::get('/categories', [CategoryController::class, 'storeCategory'])
        ->name('categories');
    //обновление категорий
    Route::patch('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    //создание категорий
    Route::post('/categories/create', [CategoryController::class, 'createСategory'])
        ->name('categories.create');
    //удаление категорий
    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

    //Управление курсами
    Route::get('/courses', [CourseController::class, 'storeCourse'])->name('courses');
    //обновление курсов
    Route::patch('/courses/update/{id}', [CourseController::class, 'update'])->name('courses.update');
    //создание курсов
    Route::post('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    //удаление курсов
    Route::delete('/courses/delete/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    //Управление разделами
    Route::get('/chapters', [ChapterController::class, 'storeChapter'])
        ->name('chapters');
    //создание разделов
    Route::post('/chapters/create', [ChapterController::class, 'create_chapter'])
        ->name('chapters.create');
    //обновление разделов
    Route::patch('/chapters/update/{id}', [ChapterController::class, 'update_chapter'])
        ->name('chapters.update');
    //удаление разделов
    Route::delete('/chapters/delete/{id}', [ChapterController::class, 'chapter_destroy'])
        ->name('chapter_destroy');

    //Управление темами
    Route::get('/themes', [ThemeController::class, 'storeTheme'])
        ->name('themes');
    //Создание темы
    Route::post('/themes/create', [ThemeController::class, 'create_theme'])
        ->name('themes.create');
    //Обновление темы
    Route::patch('/themes/update/{id}', [ThemeController::class, 'update'])
        ->name('themes.update');
    Route::post('/themes/update-order', [CartController::class, 'updateOrder'])->name('themes.updateOrder');
    //Удаление темы
    Route::delete('/themes/delete/{id}', [ThemeController::class, 'destroy'])
        ->name('themes.destroy');
    //Загрузка файла в темы
    Route::post('/themes/{id}/upload-document', [ThemeController::class, 'uploadDocument'])->name('themes.upload.document');
    //Скачивание файла
    Route::get('/themes/{id}/download', [ThemeController::class, 'downloadDocument'])->name('themes.download');

    //Управление заданиями
    Route::get('/works', [WorkController::class, 'getWork'])->name('works');
    Route::patch('/works/update/{id}', [WorkController::class, 'update'])->name('works.update');
    Route::delete('/works/delete/{id}', [WorkController::class, 'destroy'])->name('works.destroy');

    //Управление пользователями
    Route::get('storeUser', [UserController::class, 'showUser'])->name('storeUser');
    //Создание пользователей
    Route::post('/users/create', [UserController::class, 'create'])
        ->name('create.user');
    //Изменение пользователя
    Route::patch('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    //Удаление
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    //Поиск пользователей
    Route::get('users/search', [UserController::class, 'search'])->name('users.search');
    Route::patch('/users/{user}/avatar', [UserController::class, 'updateAvatar'])->name('users.update_avatar');

    //Расписание курсов
    Route::get('/calendar', [SheduleController::class, 'show'])->name('calendar');
    //создание
    Route::post('/calendar/create', [SheduleController::class, 'create_shedule'])->name('calendar.create');
    //отвечает за отображение формы редактирования расписания с определенным id.
    Route::get('/calendar/{id}/edit', [SheduleController::class, 'edit'])->name('calendar.edit');
    //отвечает за обновление расписания в базе данных.
    Route::patch('/calendar/update/{id}', [SheduleController::class, 'update_shedule'])
        ->name('calendar.update');
    //отвечает за удаление расписания из базы данных.
    Route::delete('/calendar/delete/{id}', [SheduleController::class, 'shedule_destroy'])
        ->name('calendar.destroy');
    //Чат
    Route::prefix('chats')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chats.index');
//  Route::get('/{chat}', [ChatController::class, 'show'])->name('chats.show');
    Route::get('/search', [ChatController::class, 'searchUsers'])->name('chats.search');

    });
    Route::post('/', [MessageController::class, 'store'])->name('message.store');
    Route::get('download/{filename}', [MessageController::class, 'download'])->name('download.file');
});
require __DIR__ . '/auth.php';
