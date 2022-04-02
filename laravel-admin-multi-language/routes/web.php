<?php

use Omaicode\MultiLanguage\Http\Controllers\MultiLanguageController;
use Omaicode\MultiLanguage\MultiLanguage;

Route::post('/locale', MultiLanguageController::class.'@locale');
if(MultiLanguage::config("show-login-page", true)) {
    Route::get('auth/login', MultiLanguageController::class.'@getLogin');
}
