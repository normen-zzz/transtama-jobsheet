<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sendwa extends CI_Model
{
    function kirim2($phone, $msg)
    {
        $msg = htmlspecialchars($msg);
        $link  =  "https://jogja.wablas.com";
        $data = [
            'phone' => $phone,
            'message' => $msg,
        ];

        $curl = curl_init();
        $token =  "LB3Xn704lMytCHLETfMpGqjwR3tTOafkoeDnBI3LAbPuueZkns3xFup";
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_URL, $link);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    public function kirim($phone, $msg)
    {
        $msg = htmlspecialchars($msg);
        $curl = curl_init();
        $token = "LB3Xn704lMytCHLETfMpGqjwR3tTOafkoeDnBI3LAbPuueZkns3xFup";
        $data = [
            'phone' => $phone,
            'message' => $msg,
        ];
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    public function pickupOld($phone,$msg)
    {

      $msg =  str_replace(" ", "%20", $msg);

        $result = file_get_contents("https://jogja.wablas.com/api/send-message?phone=$phone&message=$msg&token=LB3Xn704lMytCHLETfMpGqjwR3tTOafkoeDnBI3LAbPuueZkns3xFup");
        return $result;
        // echo "<pre>";
        // print_r($result);
    }

 public function pickup($phone, $msg)
    {
        $curl = curl_init();

        // Your API credentials
        $token = "LB3Xn704lMytCHLETfMpGqjwR3tTOafkoeDnBI3LAbPuueZkns3xFup";
        $secret_key = "Y2U44M7O";

        $msg = str_replace(" ", "%20", $msg);



        // Set up the API request
        curl_setopt($curl, CURLOPT_URL, "https://jogja.wablas.com/api/send-message?token=$token.$secret_key&phone=$phone&message=$msg");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        // Execute the request
        $result = curl_exec($curl);

        // Check for errors
        if (curl_errno($curl)) {
            echo 'Request failed: ' . curl_error($curl);
        }

        // Close cURL session
        curl_close($curl);

       return $result;
    }
	
	 

 

}
