<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RingfortController;

/*
 * All route names are prefixed with 'admin.'.
 */
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('ringforts', [RingfortController::class, 'index'])->name('ringforts.index');
Route::get('ringforts/deleted', [RingfortController::class, 'getDeleted'])->name('ringforts.deleted');
Route::get('ringforts/confirmed', [RingfortController::class, 'getConfirmed'])->name('ringforts.confirmed');
Route::get('ringforts/pending', [RingfortController::class, 'getPending'])->name('ringforts.pending');
Route::get('ringforts/rejected', [RingfortController::class, 'getRejected'])->name('ringforts.rejected');
Route::get('ringforts/rejected', [RingfortController::class, 'getRejected'])->name('ringforts.rejected');

        /*
         * Specific Ringfort
         */
        Route::group(['prefix' => 'ringfort/{ringfort}'], function () {
            // Ringfort
            Route::get('/', [RingfortController::class, 'show'])->name('ringfort.show');
            Route::get('edit', [RingfortController::class, 'edit'])->name('ringfort.edit');
            Route::patch('/', [RingfortController::class, 'update'])->name('ringfort.update');
            Route::delete('/', [RingfortController::class, 'destroy'])->name('ringfort.destroy');

            // Account
            Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('ringfort.account.confirm.resend');

            // Status
            Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('ringfort.mark')->where(['status' => '[0,1]']);

            // Status
            //Route::get('reject', [UserConfirmationController::class, 'reject'])->name('ringfort.reject');
            //Route::get('comfirm', [UserConfirmationController::class, 'confirm'])->name('ringfort.confirm');
            //Route::get('reset', [UserConfirmationController::class, 'reset'])->name('ringfort.reset');
        });
