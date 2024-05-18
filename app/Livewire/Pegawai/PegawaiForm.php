<?php

namespace App\Livewire\Pegawai;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PegawaiForm extends Component
{
    public $id, $name, $email;
    public $nik, $nohp, $alamat, $jabatan, $awal_kerja, $pendidikan, $sekolah, $jurusan, $sip, $sip_expire, $str, $status = 1;
    public $isEditMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'nik' => 'numeric|digits:16',
            'nohp' => 'numeric',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $this->isEditMode = true;
            $user = User::findOrFail($id);
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            // pegawai
            $this->nik = $user->pegawai?->nik;
            $this->nohp = $user->pegawai?->nohp;
        }
    }

    public function save()
    {
        $this->validate();
        if ($this->isEditMode) {
            $user = User::findOrFail($this->id);
            $message = 'Pegawai updated successfully.';
        } else {
            $user = new User;
            $message = 'Pegawai created successfully.';
        }
        $user->name = $this->name;
        $user->email = $this->email;
        $user->updated_at = now();
        $user->save();
        $user->pegawai()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nik' => $this->nik,
                'nohp' => $this->nohp,
                'alamat' => $this->alamat,
                'jabatan' => $this->jabatan,
                'awal_kerja' => $this->awal_kerja,
                'pendidikan' => $this->pendidikan,
                'sekolah' => $this->sekolah,
                'jurusan' => $this->jurusan,
                'sip_expire' => $this->sip_expire,
                'str' => $this->str,
                'status' => $this->status,
                'user' => Auth::user()->id,
                'pic' => Auth::user()->name,
            ]
        );
        flash($message, 'success');
        return redirect()->to('/pegawai');
    }

    public function render()
    {
        $title =  $this->name ? 'Edit Pegawai ' . $this->name : 'Tambah Pegawai';
        return view('livewire.pegawai.pegawai-form')
            ->title($title);
    }
}
