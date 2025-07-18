<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    public function showMap()
    {
        // Data for Indian states and Bhutan's dzongkhags
        $regions = [
            'India' => [
                ['state_code' => 'IN-JK', 'state_name' => 'Jammu and Kashmir'],
                ['state_code' => 'IN-LA', 'state_name' => 'Ladakh'],
                ['state_code' => 'IN-HP', 'state_name' => 'Himachal Pradesh'],
                ['state_code' => 'IN-UT', 'state_name' => 'Uttarakhand'],
                ['state_code' => 'IN-PB', 'state_name' => 'Punjab'],
                ['state_code' => 'IN-HR', 'state_name' => 'Haryana'],
                ['state_code' => 'IN-DL', 'state_name' => 'Delhi'],
                ['state_code' => 'IN-UP', 'state_name' => 'Uttar Pradesh'],
                ['state_code' => 'IN-MP', 'state_name' => 'Madhya Pradesh'],
                ['state_code' => 'IN-CT', 'state_name' => 'Chhattisgarh'],
                ['state_code' => 'IN-RJ', 'state_name' => 'Rajasthan'],
                ['state_code' => 'IN-GJ', 'state_name' => 'Gujarat'],
                ['state_code' => 'IN-MH', 'state_name' => 'Maharashtra'],
                ['state_code' => 'IN-GA', 'state_name' => 'Goa'],
                ['state_code' => 'IN-WB', 'state_name' => 'West Bengal'],
                ['state_code' => 'IN-OR', 'state_name' => 'Odisha'],
                ['state_code' => 'IN-BR', 'state_name' => 'Bihar'],
                ['state_code' => 'IN-JH', 'state_name' => 'Jharkhand'],
                ['state_code' => 'IN-AS', 'state_name' => 'Assam'],
                ['state_code' => 'IN-TR', 'state_name' => 'Tripura'],
                ['state_code' => 'IN-ML', 'state_name' => 'Meghalaya'],
                ['state_code' => 'IN-MN', 'state_name' => 'Manipur'],
                ['state_code' => 'IN-NL', 'state_name' => 'Nagaland'],
                ['state_code' => 'IN-MZ', 'state_name' => 'Mizoram'],
                ['state_code' => 'IN-SK', 'state_name' => 'Sikkim'],
                ['state_code' => 'IN-AR', 'state_name' => 'Arunachal Pradesh'],
                ['state_code' => 'IN-TN', 'state_name' => 'Tamil Nadu'],
                ['state_code' => 'IN-KA', 'state_name' => 'Karnataka'],
                ['state_code' => 'IN-AP', 'state_name' => 'Andhra Pradesh'],
                ['state_code' => 'IN-TG', 'state_name' => 'Telangana'],
                ['state_code' => 'IN-KL', 'state_name' => 'Kerala'],
                ['state_code' => 'IN-PY', 'state_name' => 'Puducherry'],
                ['state_code' => 'IN-AN', 'state_name' => 'Andaman and Nicobar Islands'],
                ['state_code' => 'IN-CH', 'state_name' => 'Chandigarh'],
                ['state_code' => 'IN-DN', 'state_name' => 'Dadra and Nagar Haveli'],
                ['state_code' => 'IN-DD', 'state_name' => 'Daman and Diu'],
                ['state_code' => 'IN-LD', 'state_name' => 'Lakshadweep'],
            ],
            'Bhutan' => [
                ['state_code' => 'BT-11', 'state_name' => 'Paro'],
                ['state_code' => 'BT-12', 'state_name' => 'Chukha'],
                ['state_code' => 'BT-13', 'state_name' => 'Haa'],
                ['state_code' => 'BT-14', 'state_name' => 'Samtse'],
                ['state_code' => 'BT-15', 'state_name' => 'Thimphu'],
                ['state_code' => 'BT-22', 'state_name' => 'Dagana'],
                ['state_code' => 'BT-23', 'state_name' => 'Punakha'],
                ['state_code' => 'BT-24', 'state_name' => 'Wangdue Phodrang'],
                ['state_code' => 'BT-31', 'state_name' => 'Sarpang'],
                ['state_code' => 'BT-32', 'state_name' => 'Trongsa'],
                ['state_code' => 'BT-33', 'state_name' => 'Bumthang'],
                ['state_code' => 'BT-34', 'state_name' => 'Zhemgang'],
                ['state_code' => 'BT-41', 'state_name' => 'Trashigang'],
                ['state_code' => 'BT-42', 'state_name' => 'Mongar'],
                ['state_code' => 'BT-43', 'state_name' => 'Samdrup Jongkhar'],
                ['state_code' => 'BT-44', 'state_name' => 'Lhuntse'],
                ['state_code' => 'BT-45', 'state_name' => 'Pemagatshel'],
                ['state_code' => 'BT-46', 'state_name' => 'Tsirang'],
                ['state_code' => 'BT-47', 'state_name' => 'Gasa'],
                ['state_code' => 'BT-48', 'state_name' => 'Yangang'],
            ],
        ];

        // Static member counts for demonstration
        $memberCounts = [
            'IN-DL' => 15, 'IN-UP' => 20,   'IN-MH' => 18, 'IN-WB' => 16, 'IN-BR' => 17, 'IN-TN' => 19, 'IN-KA' => 13, 
            'BT-11' => 2,'BT-14' => 2, 'BT-15' => 4, 
        ];

        return view('maps.index', compact('regions', 'memberCounts'));

    }

    public function Map()
    {
        $regions = [
            ['name' => 'Uttar Pradesh', 'country' => 'India', 'count' => 270],
            ['name' => 'Maharashtra', 'country' => 'India', 'count' => 98],
            ['name' => 'Tamil Nadu', 'country' => 'India', 'count' => 39],
            ['name' => 'Delhi', 'country' => 'India', 'count' => 30],
            ['name' => 'Gujarat', 'country' => 'India', 'count' => 180],
            ['name' => 'Karnataka', 'country' => 'India', 'count' => 250],
            ['name' => 'West Bengal', 'country' => 'India', 'count' => 200],
            ['name' => 'Bihar', 'country' => 'India', 'count' => 100],
            ['name' => 'Rajasthan', 'country' => 'India', 'count' => 80],
            ['name' => 'Punjab', 'country' => 'India', 'count' => 150],
            ['name' => 'Thimphu', 'country' => 'Bhutan', 'count' => 80],
            ['name' => 'Paro', 'country' => 'Bhutan', 'count' => 60],
            ['name' => 'Punakha', 'country' => 'Bhutan', 'count' => 50],
            ['name' => 'Wangdue Phodrang', 'country' => 'Bhutan', 'count' => 40],
            ['name' => 'Trongsa', 'country' => 'Bhutan', 'count' => 35],
        ];

        return view('maps.show', compact('regions'));
    }


    
}
