<?php

class CrudZoom
{

    public function CrearReunion($token, $topic, $start_time, $duration)
    {
        $default_settings = array(
            "host_video" => true,
            "participant_video" => true,
            "join_before_host" => true,
            "mute_upon_entry" => "true",
            "watermark" => "true",
            "audio" => "voip",
            "auto_recording" => "cloud"
        );

        $data = array(
            "topic" => $topic,
            "type" => 2,
            "start_time" => $start_time,
            "duration" => $duration,
            "settings" => $default_settings
        );

        $curl = curl_init('https://api.zoom.us/v2/users/me/meetings');

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        );

        $data_string = json_encode($data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


    public function ObtenerReuniones($token)
    {
        $curl = curl_init('https://api.zoom.us/v2/users/me/meetings');

        $headers = array(
            'Authorization: Bearer ' . $token
        );

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


    public function ObtenerReunionPorId($token, $meetingId)
    {
        $curl = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId);

        $headers = array(
            'Authorization: Bearer ' . $token
        );

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    public function ActualizarReunion($token, $meetingId, $topic, $start_time, $duration)
    {
        $default_settings = array(
            "host_video" => true,
            "participant_video" => true,
            "join_before_host" => true,
            "mute_upon_entry" => "true",
            "watermark" => "true",
            "audio" => "voip",
            "auto_recording" => "cloud"
        );

        $data = array(
            "topic" => $topic,
            "type" => 2,
            "start_time" => $start_time,
            "duration" => $duration,
            "settings" => $default_settings
        );

        $curl = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId);

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        );

        $data_string = json_encode($data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH'); // Usar método PATCH para la actualización
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }


    public function EliminarReunion($token, $meetingId)
    {
        $curl = curl_init('https://api.zoom.us/v2/meetings/' . $meetingId);

        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token
        );

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;
    }
}
