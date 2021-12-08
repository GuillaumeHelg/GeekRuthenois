<?php
namespace controllers;

use services\UsersService;
use yasmf\HttpHelper;
use yasmf\View;

class HomeController {

    private $usersService;

    public function __construct()
    {
        $this->usersService = UsersService::getDefaultUsersService();
    }

    public function index($pdo) {
        $searchStmt = $this->usersService->findAction($pdo);
        $view = new View("td2-pws-controle-pdo-mvc-GuillaumeHelg/views/actionLog.php");
        $view->setVar('searchStmt',$searchStmt);
        return $view;
    }

    

}


