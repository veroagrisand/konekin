<?php
use App\Http\Controllers\CreateCommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Superuser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landpage');
})->name('landing.page');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('layouts.dashboard');})->name('dashboard');
    Route::get('/Community', [HomeController::class, 'comunity'])->name('community');
    Route::get('/About', [HomeController::class, 'about'])->name('about');
    // Route::get('/coba', [HomeController::class, 'showCommunities'])->name('coba');

    // profile
    Route::get('/Profile-Dasboard', [ProfileController::class, 'dasboard'])->name('profile.dasboard');
    Route::get('/Profile-Profile', [ProfileController::class, 'profile'])->name('profile.prifile');
    Route::get('/Profile-Edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/Profile-Edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/Profile-Edit', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //membuat komunitas
    Route::get('/createcommunity', [CreateCommunityController::class, 'create'])->name('createcommunity.create');
    Route::post('/createcommunity', [CreateCommunityController::class, 'store'])->name('createcommunity.store');

    //join
    Route::get('/JoinCommunity/{id_komunitas}', [CreateCommunityController::class, 'Join'])->name('Community.join');
    Route::post('/JoinCommunity/{id_komunitas}', [CreateCommunityController::class, 'JoinS'])->name('Community.joinS');

    Route::get('/mycommunity/events/{id_komunitas}', [CreateCommunityController::class, 'event'])->name('mycommunity.Event');
    Route::get('/mycommunity/galery/{id_komunitas}', [CreateCommunityController::class, 'galery'])->name('mycommunity.Galery');
    Route::get('/mycommunity/forum/{id_komunitas}', [CreateCommunityController::class, 'forum'])->name('mycommunity.Forum');
    Route::post('/forums/{id_komunitas}/add-comment', [CreateCommunityController::class, 'forumAdd'])->name('mycommunity.ForumAdd');

    // Route::middleware(['member'])->group(function () {

    //amin_group
    Route::middleware(['admin_group'])->group(function () {
        // komunitas
        Route::get('/mycommunity', [CreateCommunityController::class, 'mycommunity'])->name('mycommunity');
        // Route::get('/mycommunity/events/{id_komunitas}', [CreateCommunityController::class, 'event'])->name('mycommunity.Event');
        // Route::get('/mycommunity/galery/{id_komunitas}', [CreateCommunityController::class, 'galery'])->name('mycommunity.Galery');
        // Route::get('/mycommunity/forum/{id_komunitas}', [CreateCommunityController::class, 'forum'])->name('mycommunity.Forum');
        // Route::post('/forums/{id_komunitas}/add-comment', [CreateCommunityController::class, 'forumAdd'])->name('mycommunity.ForumAdd');
        Route::get('/mycommunity/edit/{id_komunitas}', [CreateCommunityController::class, 'edit'])->name('mycommunity.Edit');
        Route::put('/mycommunity/update/{id_komunitas}', [CreateCommunityController::class, 'update'])->name('mycommunity.update');

        //even
        Route::get('/mycommunity/add-event/{id_komunitas}', [KegiatanController::class, 'addEvent'])->name('mycommunity.AddEvent');
        Route::post('/mycommunity/add-event/{id_komunitas}', [KegiatanController::class, 'addEventPost'])->name('mycommunity.addEventPost');
    });
    //superuser akses
    Route::middleware(['superuser'])->group(function () {
        // Route::get('/nav', [Superuser::class, 'index'])->name('superuser.dashboard');
        Route::get('/logout', [Superuser::class, 'logout'])->name('Superuser.logout');

        Route::get('/superuser|Home', [Superuser::class, 'Home'])->name('superuser.Home');
        Route::get('/superuser|Kelola', [Superuser::class, 'kelola'])->name('superuser.kelola');
        Route::get('/superuser|User', [Superuser::class, 'user'])->name('superuser.user');
        // Route::get('/superuser-Kelola|Kegiatan/{id_komunitas}', [Superuser::class, 'kegiatan'])->name('superuser.kegiatan');
        // Route::get('/superuser-Kelola|komunitas/{id_komunitas}', [Superuser::class, 'komunitas'])->name('superuser.komunitas');
        Route::get('/superuser-Kelola|kegiatan|{id_komunitas}', [Superuser::class, 'kegiatan'])->name('superuser.kegiatan');
        Route::get('/superuser-Kelola|kegiatan|', [Superuser::class, 'create'])->name('superuser.create.kegiatan');
        Route::get('/superuser-Kelola|kegiatan|Edit/{id_komunitas}', [Superuser::class, 'editkegiatan'])->name('superuser.edit.kegiatan');
        Route::put('/superuser-Kelola|kegiatan/{id_komunitas}', [Superuser::class, 'updatekegiatan'])->name('superuser.update.kegiatan');
        Route::get('/superuser-Kelola|kegiatan|hapus/{id_komunitas}', [Superuser::class, 'hapuskegiatan'])->name('superuser.hapus.kegiatan');

        Route::get('/superuser-Kelola|komunitas|Edit/{id_komunitas}', [Superuser::class, 'editkomunitas'])->name('superuser.edit.komunitas');
        Route::put('/superuser-Kelola|komunitas/{id_komunitas}', [Superuser::class, 'updatekomunitas'])->name('superuser.update.komunitas');
        Route::get('/superuser-Kelola|komunitas|hapus/{id_komunitas}', [Superuser::class, 'hapuskomunitas'])->name('superuser.hapus.komunitas');


        // Route::get('/mycommunity/edit/{id_komunitas}', [CreateCommunityController::class, 'edit'])->name('mycommunity.Edit');
        // Route::put('/mycommunity/update/{id_komunitas}', [CreateCommunityController::class, 'update'])->name('mycommunity.update');

    });

});

// Include SuperUserMiddleware routes
require __DIR__.'/auth.php';
