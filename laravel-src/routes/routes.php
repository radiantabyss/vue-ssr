<?php
use RA\Core\Route;
use RA\Core\RouteCrud;

Route::get('{any?}', 'Index\IndexAction')->where('any', '.*');

Route::group(['middleware' => ['RA\Auth\SetUser']], function() {
    Route::post('/auth/user/reset-password', 'Auth\User\ResetPasswordAction');
    Route::post('/auth/user/accept-invite/{code}', 'Auth\User\AcceptInviteAction');
    Route::post('/auth/user/check-invite/{code}', 'Auth\User\CheckInviteAction');
});

export default [
    {
        middleware: ['SetUser'],
        routes: [
            { path: '/accept-invite/{invite_code}', action: 'Auth.User.AcceptInviteAction' },
        ]
    },
    {
        middleware: ['SetUser', 'NotLogged'],
        routes: [
            // auth routes -----------------------------------------------------------------------------------
            { path: '/login', action: 'Auth.User.LoginAction' },
            { path: '/register', action: 'Auth.User.RegisterAction' },
            { path: '/forgot-password', action: 'Auth.User.ForgotPasswordAction' },
            { path: '/reset-password/{code}', action: 'Auth.User.ResetPasswordAction' },
        ]
    },
];
