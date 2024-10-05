<?php

namespace App\Livewire\Integration;

use App\Exports\IntegrationExport;
use App\Imports\IntegrationImport;
use App\Models\ActivityLog;
use App\Models\Integration;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class IntegrationIndex extends Component
{
    use WithFileUploads;

    public $integrations, $integrationId, $name, $slug, $description, $base_url, $auth_url, $user_id, $user_key, $secret_key;
    public $isFormVisible = false;
    public $formImport = false;
    public $fileImport;


    public function render()
    {
        return view('livewire.integration.integration-index')
            ->title('Aplikasi Integrasi');
    }

    public function mount()
    {
        $this->integrations = Integration::all();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $integration = Integration::updateOrCreate(
            ['id' => $this->integrationId],
            [
                'name' => $this->name,
                'slug' => Str::slug($this->slug),
                'description' => $this->description,
                'base_url' => $this->base_url,
                'auth_url' => $this->auth_url,
                'user_id' => $this->user_id,
                'user_key' => $this->user_key,
                'secret_key' => $this->secret_key,
            ]
        );

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update/Create Integration',
            'description' => auth()->user()->name . ' Updated/Created Integration ' . $integration->name,
        ]);

        flash('Aplikasi Integrasi ' . $integration->name . ' saved successfully.', 'success');
        $this->closeForm();
    }

    public function edit($id)
    {
        $this->isFormVisible = true;
        $integration = Integration::findOrFail($id);
        $this->integrationId = $integration->id;
        $this->slug = $integration->slug;
        $this->name = $integration->name;
        $this->description = $integration->description;
        $this->base_url = $integration->base_url;
        $this->auth_url = $integration->auth_url;
        $this->user_id = $integration->user_id;
        $this->user_key = $integration->user_key;
        $this->secret_key = $integration->secret_key;
    }
    public function export()
    {
        try {
            $time = now()->format('Y-m-d');

            ActivityLog::createLog(
                'Export Integration',
                auth()->user()->name . ' mengekspor data Integration'
            );

            flash('Export successfully', 'success');
            return Excel::download(new IntegrationExport, 'integration_backup_' . $time . '.xlsx');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }
    public function openFormImport()
    {
        $this->formImport = $this->formImport ?  0 : 1;
    }
    public function import()
    {
        try {
            $this->validate([
                'fileImport' => 'required|mimes:xlsx'
            ]);

            Excel::import(new IntegrationImport, $this->fileImport->getRealPath());

            ActivityLog::createLog(
                'Import Role',
                auth()->user()->name . ' mengimpor data role'
            );

            Alert::success('Success', 'Imported successfully');
            return redirect()->route('integration.index');
        } catch (\Throwable $th) {
            flash('Mohon maaf ' . $th->getMessage(), 'danger');
        }
    }

    public function openForm()
    {
        $this->isFormVisible = true;
        $this->resetFormFields();
    }

    public function closeForm()
    {
        $this->isFormVisible = false;
        $this->resetFormFields();
    }

    private function resetFormFields()
    {
        $this->integrationId = '';
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->base_url = '';
        $this->auth_url = '';
        $this->user_id = '';
        $this->user_key = '';
        $this->secret_key = '';
    }
}
