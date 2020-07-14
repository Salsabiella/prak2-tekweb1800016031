<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class User extends Controller
{

    public function __construct() 
    {
        $this->user = new UserModel();
    }

	public function index()
	{
        $data['user'] = $this->user->getUser();
        echo view('user/index', $data);
    }
    
    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $nama = $this->request->getPost('user_nama');
        $email = $this->request->getPost('user_email');

        $data = [
            'user_nama' => $nama,
            'user_email' => $email
        ];

        
        $simpan = $this->user->insert_user($data);

        if($simpan)
        {
            session()->setFlashdata('success', 'Created user successfully');
            return redirect()->to(base_url('user')); 
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->user->getUser($id);
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $nama = $this->request->getPost('user_nama');
        $email = $this->request->getPost('user_email');

        $data = [
            'user_nama' => $nama,
            'user_email' => $email
        ];

        
        $ubah = $this->user->update_user($data, $id);
        
        if($ubah)
        {
            session()->setFlashdata('info', 'Updated user successfully');
            return redirect()->to(base_url('user')); 
        }
    }

    public function delete($id)
    {
        $hapus = $this->user->delete_user($id);

        if($hapus)
        {
            session()->setFlashdata('warning', 'Deleted user successfully');
            return redirect()->to(base_url('user'));
        }
    }

}
