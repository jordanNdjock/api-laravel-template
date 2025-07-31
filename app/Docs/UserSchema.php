<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="User",
 *   title="User",
 *   description="Représentation d'un utilisateur",
 *
 *   @OA\Property(
 *     property="id",
 *     type="string",
 *     format="uuid",
 *     example="550e8400-e29b-41d4-a716-446655440000"
 *   ),
 *  @OA\Property(
 *     property="username",
 *     type="string",
 *     example="testuser"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string",
 *     format="email",
 *     example="user@example.com"
 *   ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     format="date-time",
 *     example="2025-04-30T08:00:00Z"
 *   ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     format="date-time",
 *     example="2025-04-30T08:00:00Z"
 *   )
 * )
 */
class UserSchema {}
