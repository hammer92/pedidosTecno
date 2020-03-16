<?php

namespace App\Http\Controllers;

use Response;
use InfyOm\Generator\Utils\ResponseUtil;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    protected $firebase;

    public function configFirebase() {

        $this->firebase = new \Firebase\FirebaseLib(env('FIREBASE_URL', 'https://poss-25fb2.firebaseio.com'), env('FIREBASE_TOKEN', 'MMkFF89doKNakks1goBr0uS9Zey0zktqO0MSwz4k'));
        //$firebase->set($path, $value);   // stores data in Firebase
        //$value = $firebase->get($path);  // reads a value from Firebase
        //$firebase->delete($path);        // deletes value from Firebase
        //$firebase->update($path, $data); // updates data in Firebase
        //$firebase->push($path, $data);   // push data to Firebase
        //$value = $firebase->get($path, array('shallow' => 'true'));
        //$value = $firebase->get($path, array('orderBy' => '"height"'));
        //// -- Firebase PHP Library commands
        //$firebase->setToken($token);     // set up Firebase token
        //$firebase->setBaseURI($uri);     // set up Firebase base URI (root node)
        //$firebase->setTimeOut($seconds); // set up maximum timeout / request
    }

    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }
}
