<?php

class TokenZoom
{
    private $clientId = 'vFfxU1pDRwqn5sGaL5kRBA';
    private $clientSecret = 'g0V5QYATIvnGtT2QEz6cYsQfxjtzjrSK';
    private $account_ID = 'fccmIlxOQKmwqFeRQeQZpg';
    private $accessToken;
    private $tokenExpiration;



    public function GenerateToken()
    {
        $tokenUrl = 'https://zoom.us/oauth/token';

        $data = array(
            'grant_type' => 'account_credentials',
            'account_id' => $this->account_ID,
        );

        $ch = curl_init($tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
            'Content-Type: application/x-www-form-urlencoded'
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($ch);


        if ($response === false) {
            echo 'Error al realizar la solicitud: ' . curl_error($ch);
        } else {
            $tokenData = json_decode($response, true);
            if (isset($tokenData)) {
                $this->accessToken = $tokenData['access_token'];
                $this->tokenExpiration = time() + $tokenData['expires_in']; 
            } else {
                echo 'Error al obtener el token de acceso';
            }
        }

        curl_close($ch);
    }

    public function GetToken() 
    {
        return  $this->accessToken;
    }

    public function CheckTokenExpiration()
    {
        // Si el tiempo actual es mayor que la fecha de expiración, actualizar el token
        if (time() > $this->tokenExpiration) {
            $this->GenerateToken(); 
        }
    }
}
