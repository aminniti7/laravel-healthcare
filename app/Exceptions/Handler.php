<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            return $this->handleException($e, $request);
        });
    }

    protected function handleException(Throwable $e, $request)
    {
        Log::error('Errore: ' . get_class($e));
        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return response()->json(['error' => 'Non autenticato.'], 401);
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'error' => 'Dati non validi.',
                'details' => $e->errors(),
            ], 422);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json(['error' => 'Risorsa non trovata.'], 404);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return response()->json(['error' => 'Metodo HTTP non consentito.'], 405);
        }

        // Per qualsiasi altra eccezione, restituisci un errore generico.
        return response()->json([
            'error' => 'Errore interno del server.',
            'message' => $e->getMessage(), // Rimuovi in produzione per maggiore sicurezza.
        ], 500);
    }

    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
