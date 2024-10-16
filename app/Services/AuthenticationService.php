<?php

namespace App\Services;

use App\Models\Keycloak\KeycloakUser;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserDataRepository;
use App\Repositories\UserRoleRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

readonly class AuthenticationService
{
    private const LOG_TAG = 'AuthenticationService::';

    public function __construct(private UserRepository     $userRepository,
                                private RoleRepository     $roleRepository,
                                private UserRoleRepository $userRoleRepository,
                                private UserDataRepository $userDataRepository)
    {
    }

    /**
     * @param array $data ['id?', 'name', 'email', 'password?', 'role_id']
     * @return User
     */
    public function register(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $email = $data['email'];
            $roleId = strtoupper($data['role_id'] ?? 'USER');

            $isEmailAlreadyExists = $this->userRepository->isEmailExists($email);
            if ($isEmailAlreadyExists) {
                throw ValidationException::withMessages([
                    'email' => 'Email yang anda masukkan sudah terdaftar'
                ]);
            }

            $isRoleExists = $this->roleRepository->exists($roleId);
            if (!$isRoleExists) {
                throw ValidationException::withMessages([
                    'role_id' => 'Role yang anda masukkan tidak valid'
                ]);
            }

            $user = $this->userRepository->create([
                'id' => $data['id'] ?? strtolower(Str::ulid()),
                'name' => $data['name'],
                'email' => $email,
                // null if registered via keycloak
                'password' => $data['password'] ?? null,
            ]);

            $role = $this->userRoleRepository->create($user->id, $roleId);
            $userData = $this->userDataRepository->create($user->id);

            Log::info(message: self::LOG_TAG . 'REGISTER', context: [
                'message' => 'SUCCESS',
                'params' => ['data' => $data],
                'data' => ['user' => $user->toArray(), 'role' => $role->toArray(), 'user_data' => $userData->toArray()],
            ]);
            return $user;
        });
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     */
    public function login(string $email, string $password): User
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Email yang anda masukkan tidak ditemukan',
            ]);
        }

        if ($user->hasEmptyPassword()) {
            throw ValidationException::withMessages([
                'email' => 'Email terdaftar dengan Single Sign On (SSO), silahkan masuk dengan SSO atau reset password untuk masuk dengan password',
            ]);
        }

        if (!$user->isValidPassword($password)) {
            throw ValidationException::withMessages([
                'password' => 'Password yang anda masukkan salah',
            ]);
        }

        Log::info(message: self::LOG_TAG . 'LOGIN', context: [
            'message' => 'SUCCESS',
            'params' => ['email' => $email, 'password' => $password],
            'data' => $user->toArray(),
        ]);
        return $user;
    }

    /**
     * @param KeycloakUser $keycloakUser
     * @return User
     */
    public function loginKeycloak(KeycloakUser $keycloakUser): User
    {
        return DB::transaction(function () use ($keycloakUser) {
            $user = $this->userRepository->findByEmail($keycloakUser->email);
            if (!$user) {
                $user = $this->register([
                    'id' => $keycloakUser->id,
                    'name' => $keycloakUser->fullName,
                    'email' => $keycloakUser->email,
                ]);
            }

            Log::info(message: self::LOG_TAG . 'LOGIN_KEYCLOAK', context: [
                'message' => 'SUCCESS',
                'params' => ['keycloak_user' => $keycloakUser->toArray()],
                'data' => $user->toArray(),
            ]);
            return $user;
        });
    }

    /**
     * @param string $email
     * @return string
     * @throws ValidationException
     */
    public function sendResetPasswordEmail(string $email): string
    {
        $params = ['email' => $email];
        $status = Password::sendResetLink($params);

        if ($status !== Password::RESET_LINK_SENT) {
            Log::error(message: self::LOG_TAG . 'SEND_RESET_PASSWORD_EMAIL', context: [
                'message' => 'Error: ' . __($status),
                'params' => $params,
            ]);

            throw ValidationException::withMessages(['email' => __($status)]);
        }

        Log::info(message: self::LOG_TAG . 'SEND_RESET_PASSWORD_EMAIL', context: [
            'message' => 'SUCCESS',
            'params' => $params,
            'data' => __($status),
        ]);
        return $status;
    }

    /**
     * @param string $email
     * @param string $password
     * @param string $token
     * @return string
     * @throws ValidationException
     */
    public function resetPassword(string $email, string $password, string $token): string
    {
        $params = [
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'token' => $token
        ];

        $status = Password::reset($params, function (User $user, string $password) {
            $user->forceFill(['password' => Hash::make($password)])
                ->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            Log::error(message: self::LOG_TAG . 'RESET_PASSWORD', context: [
                'message' => 'Error: ' . __($status),
                'params' => $params,
            ]);

            throw ValidationException::withMessages(['email' => __($status)]);
        }

        Log::info(message: self::LOG_TAG . 'RESET_PASSWORD', context: [
            'message' => 'SUCCESS',
            'params' => $params,
            'data' => __($status),
        ]);
        return $status;
    }
}
