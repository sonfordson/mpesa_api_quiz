<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Response;

use App\Provision_sim;
use App\activate_sim;

class provisionSIMController extends Controller
{
    public function create_create_sim(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'iccid' =>  'min:20|max:20',
            'imsi' =>  'min:15|max:15',
            'Ki' => 'numeric|min:20|max:20',
            'pin1' => 'numeric|min:4|max:4',
            'puc' => 'numeric|numeric|min:6|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                ' status ' => ' error ',
                ' error ' => [
                    ' code ' => ' input_invalid inputs',
                    ' message ' => $validator->errors()->all()
                ]
            ], 422);
        }

        $ICCID_start_digit = 8925402;
        $IMSI_start_digit = 63902;

        $ICCID_randnum = rand(1111111111111, 9999999999999);
        $IMSI_randnum = rand(1111111111, 9999999999);
        $Ki =  rand(111111111, 99999999);

        $pin1 = $request->input('phone_number');
        $puc = $request->input('account_balance');


        // if (strlen((string)$puc)    != 6) {
        //     return response()->json([
        //         'status' => 'error',
        //         'error' => [
        //             'code' => 'puc_not_found',
        //             'message' => 'the user PUC should not be minimum of 6 digits...'
        //         ]
        //     ], 404);
        // }

        // $PIN1 = strlen($pin1);
        // if ($PIN1 != 4) {
        //     return response()->json([
        //         'status' => 'error',
        //         'error' => [
        //             'code' => 'pin_not_found',
        //             'message' => 'PIN1 should not minimum 4.....'
        //         ]
        //     ], 404);
        // }



        $ICCID_store_value = $ICCID_start_digit . $ICCID_randnum;
        $IMSI_store_value = $IMSI_start_digit . $IMSI_randnum;

        $requestData['ICCID'] = $ICCID_store_value;
        $requestData['IMSI'] = $IMSI_store_value;
        $requestData['Ki'] = $Ki;

        $Provision_sim = new Provision_sim;

        $Provision_sim->ICCID     = $ICCID_store_value;
        $Provision_sim->IMSI      = $IMSI_store_value;
        $Provision_sim->Ki = $Ki;
        $Provision_sim->PIN1 = Input::get('PIN1');
        $Provision_sim->PUC = Input::get('PUC');
        $Provision_sim->status = Input::get('status');

        $Provision_sim->save();
        return Response::json([
            'status' => 'success',
            'message' => [
                'code' => 'ok',
                'message' => 'the bill account created successfully'
            ]
        ], 200);
    }


    public function get_activateSIM(Request $request, $id)
    {
        $get_activateSIM = Provision_sim::findOrFail($id);
        return $get_activateSIM;
    }

    public function get_test_activateSIM(Request $request, $id)
    {


        $Provision_sim = Provision_sim::findOrFail($id);
        $son = $Provision_sim->ICCID;

        $MSISDN = Input::get('MSISDN');
        $activate_sim = new activate_sim;
        $activate_sim->MSISDN = $MSISDN;
        $activate_sim->ICCID  = $son;
        $activate_sim->provisionsim_id  = $Provision_sim->id;
        $activate_sim->status = "active";
        $activate_sim->IMSI =   $Provision_sim->IMSI;
        $activate_sim->save();


        return Response::json([
            'status' => 'success',
            'message' => [
                'code' => 'ok',
                'message' => 'SIM ACTIVATED SUCCESSFULLY'
            ]
        ], 200);
    }

    public function querySubscriberInfo(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 1;

        if (!empty($keyword)) {
            $querySubscriberInfo = activate_sim::where('MSISDN', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $querySubscriberInfo = activate_sim::latest()->paginate($perPage);
        }

        return $querySubscriberInfo;
    }
}
