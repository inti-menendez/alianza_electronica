<?php

Router::get('',  [AuthController::class, 'index']);

Router::get('/login', [AuthController::class, 'index']);
Router::post('/login', [AuthController::class, 'auth']);

Router::get('/logout', [AuthController::class, 'logout']);

Router::get('/home', [DashboardController::class, 'index']);
 