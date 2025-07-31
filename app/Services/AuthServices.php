<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthServices{

     /**
     * Authentifie un utilisateur et retourne le token.
     *
     * @param  string  $email
     * @param  string  $password
     * @return array{user: User, token: string}
     *
     * @throws AuthenticationException
     */
    public function authenticate(string $email, string $password): array
    {

        $user = User::query()
        ->where('email', $email)
        ->first();

        if (! $user || ! Hash::check($password, $user->mdp)) {
            throw new AuthenticationException('Identifiants invalides ou utilisateur supprimé/bloqué.');
        }

        Log::channel('user_actions')->info("Utilisateur authentifié avec succès : {$user->email}");
        $token = $user
            ->createToken("access_token_of_{$user->email}")
            ->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    /**
     * Déconnecte l'utilisateur donné en supprimant son token courant.
     *
     * @param  User|null  $user
     * @return void
     *
     * @throws AuthenticationException si l'utilisateur n'est pas authentifié
     * @throws \Throwable           pour toute autre erreur
     */
    public function logout(?User $user): void
    {
        Log::channel('user_actions')->info("Tentative de déconnexion pour l'utilisateur : {$user->email}");
        if (! $user) {
            throw new AuthenticationException('Non authentifié.');
        }

        DB::transaction(function () use ($user) {
            $user->currentAccessToken()->delete();
        });
        Log::channel('user_actions')->info("Utilisateur déconnecté avec succès : ".auth()->user()->email);
    }
}