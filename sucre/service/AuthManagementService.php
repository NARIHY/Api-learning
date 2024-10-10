<?php

namespace Sucre\Service\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordForgottenRequest;
use App\Notifications\Auth\PasswordForgotenNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class AuthManagementService
 *
 * This class handles user authentication, password resets, and logout functionality.
 * It provides methods for logging in users, sending password reset links,
 * and logging out authenticated users. Each method includes validation and appropriate responses.
 *
 * @author RANDRIANARISOA <maheninarandrianarisoa@gmail.com>
 * @copyright 2024 RANDRIANARISOA
 */
class AuthManagementService
{


    /**
     * Verifies the input password against the stored password hash.
     *
     * @param string $inputPassword The password provided by the user during login.
     * @param string $storedHash The stored hash of the user's password.
     * @return bool Returns true if the password is valid, otherwise false.
     */
    public function verifyPassword(string $inputPassword, string $storedHash): bool
    {
        // Split the stored hash to get the salt and the hashed password
        list($salt, $hash) = explode(':', $storedHash);

        // Hash the input password with the stored salt
        $inputHash = hash('sha256', $salt . $inputPassword);

        // Use hash_equals to securely compare the two hashes
        return hash_equals($inputHash, $hash); // Protects against timing attacks
    }
}
