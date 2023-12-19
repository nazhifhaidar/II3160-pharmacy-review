<?php
namespace App\Controllers;
use App\Models\Login;
class LoginController extends BaseController{
    public function index(){
        return view('login');
    }
    public function login_action(){
        $model = model(Login::class);
        $email = $this->request->getPost('email');
        $password = md5((string)$this->request->getPost('password'));
        $user = $model->getDataUsers($email, $password);
        $cek = count($user);
        if ($cek == 1){
            session()->set('num_user', $cek);
            session()->set('username', $user[0]->name);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login');
        }
    }
    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }
    
}