<?php declare(strict_types=1);

namespace CustomerGauge\Cognito;

use CustomerGauge\Cognito\Parsers\ClientAppParser;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

final class CognitoUserProvider implements UserProvider
{
    private $clientAppParser;

    private $accessTokenParser;

    public function __construct(ClientAppParser $clientAppParser/*, AccessTokenParser $accessTokenParser*/)
    {
        $this->clientAppParser = $clientAppParser;
//        $this->accessTokenParser = $accessTokenParser;
    }

    public function retrieveByCredentials(array $credentials)
    {
        $token = $credentials['cognito_token'];

        try {
            return $this->clientAppParser->parse($token);
        } catch (Exception $e) {
var_dump($e->getMessage());
exit;
        }
/*
        try {
            return $this->accessTokenParser->parse($token);
        } catch (Exception $e) {

        }
*/
        return null;
    }

    /** @phpstan ignore */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
    }

    /** @phpstan ignore */
    public function retrieveById($identifier)
    {
    }

    /** @phpstan ignore */
    public function retrieveByToken($identifier, $token)
    {
    }

    /** @phpstan ignore */
    public function updateRememberToken(Authenticatable $user, $token)
    {
    }
}