<?php

namespace Core\controllers;

use Core\auth\Auth;
use Core\http\Request;
use Core\http\Response;
use Core\models\EmailVerificationRequest;
use Core\models\Permission;
use Core\models\User;
use Core\support\Session;
use Core\View;

class AccountController
{
    public static function create(Request $request, Response $response)
    {

        View::make("admin.account.create", "admin", [
            "permissions" =>  Permission::all(["name","id"])
        ]);
    }

    public static function post(Request $request, Response $response)
    {
        $email = $request->input("email");


        // if (User::exists($email)) {
        //     $response->json(["exists" => true]);
        // }

        $userId = User::save([
            "email" => $request->input("email"),
            "password" => password_hash($request->input("password"), PASSWORD_DEFAULT),
            "verified" => 0,
        ]);

        foreach ($request->input("permissions") as $permissionId) {
            User::savePermissions(
                [
                "userId"       => $userId,
                "permissionId" => $permissionId
                ]
            );
        }

        $response->json($request->input("permissions"));

        if ($userId) {
            $requestObj = EmailVerificationRequest::save($userId);
            $emailVerificationLink = 'http://mvc.test/auth/verify_email.php?id='
                .$requestObj["id"]
                .'&verif_code='
                .$requestObj["verif_code"];

        }

        Session::set("loggedIn", true);
        Session::set("userId", $userId);

        $response->json(
            ["loggedIn"=>true, "redirect" => "/admin/products"]
        );
    }

    public static function destroy(Response $response)
    {
        $deleted = User::destroy((int) Session::get("userId"));

        if ($deleted) {
            Auth::logout();
            $response->json(["redirect" => "/auth/register.php"]);
        }
    }
}
