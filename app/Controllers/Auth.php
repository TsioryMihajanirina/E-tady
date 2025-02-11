<?php

namespace App\Controllers;

use App\Models\ImageModel;
use App\Models\UtilisateurModel;

use function PHPSTORM_META\type;

class Auth extends BaseController
{
    public function index()
    {
        if (!session()->has('id'))
            return view('show_post');
        return view('auth_view');
    }

    /**
     * connexion
     */
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UtilisateurModel();
        $user = $userModel->where('username', $username)->first();
        
        if ($user && password_verify($password, $user['password'])) {
            session()->set('id', $user['id']);

            // Connexion réussie
            return redirect()->to('/')->with('message', 'Connexion réussie !');
        } else {
            return view('auth_view', ['error'=> 'Nom d\'utilisateur ou mot de passe incorrect.']);
            return redirect()->to('/login')->with('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
        }
    }

    /**
     * inscription
     */
    public function register()
    {

        $username = $this->request->getPost('reg_username');
        $password = password_hash($this->request->getPost('reg_password'), PASSWORD_BCRYPT);
        $email = $this->request->getPost('reg_email');
        $telephone = $this->request->getPost('reg_telephone');

        $userModel = new UtilisateurModel();
        $image = new ImageModel();

        //verification de username et email
        if ($userModel->where('username', $username)->find()){
            return redirect()->back()->withInput()->with('error', ' username existe déja !');
        }
        if ($userModel->isExists('email', $email)){
            return redirect()->back()->withInput()->with('error', 'Cet e-mail existe déja !');
        }

        $image_id = $image->insert([
            'path' => DIRECTORY_SEPARATOR .'assets' . DIRECTORY_SEPARATOR . 'uploads'.DIRECTORY_SEPARATOR . 'user.png'
        ]);
        //enregistrer le nouvel utilisateur
        $user = $userModel->insert([
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'image_id' => $image_id,
            'telephone' => $telephone,
        ]);
        if ($user) {
            session()->set('id', $user);
            return redirect()->to("/")->with('message', 'Inscription réussie !');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de l\'inscription.');
        }
    }

    public function logout() {
        session()->remove(['id', 'username', 'email']);
        return view('auth_view');
    }

    public function inscription()
    {
        return view('inscription');
    }

    public function connReussi() {
        return view('conReussi');
    }

}
