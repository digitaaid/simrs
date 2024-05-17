<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-4">
        <x-adminlte-profile-widget name="{{ $user->name }}" desc="{{ $user->email }}" theme="primary"
            img="{{ $user->adminlte_image() }}">
            <ul class="nav flex-column col-md-12">
                <li class="nav-item">
                    <b class="nav-link">Nama <b class="float-right ">{{ $user->name }}</b></b>
                </li>
                <li class="nav-item">
                    <b class="nav-link">Username <b class="float-right ">{{ $user->username }}</b></b>
                </li>
                <li class="nav-item">
                    <b class="nav-link">Phone <b class="float-right ">{{ $user->phone }}</b></b>
                </li>
                <li class="nav-item">
                    <b class="nav-link">Email <b class="float-right ">{{ $user->email }}</b></b>
                </li>
            </ul>
        </x-adminlte-profile-widget>
    </div>
    <div class="col-md-8">
        <x-adminlte-card title="Identitas User" theme="primary">
            <form>
                <input hidden wire:model="id" name="id">
                <x-adminlte-input wire:model="name" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="name" label="Nama" placeholder="Nama Lengkap" />
                <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="email" type="email" label="Email"
                    placeholder="Email" />
            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Update" wire:click="save"
                    wire:confirm="Apakah anda ingin mengupdate data profil {{ $user->name }} ?" form="formUpdate"
                    theme="warning" icon="fas fa-edit" />
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
