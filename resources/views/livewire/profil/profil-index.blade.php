 <div class="row">
     <div class="col-md-4">
         <x-adminlte-profile-widget name="{{ $user->name }}" desc="{{ $user->email }}" theme="primary"
             img="{{ $user->adminlte_image() }}">
             <ul class="nav flex-column col-md-12">
                 <li class="nav-item">
                     <b class="nav-link">Nama <b class="float-right ">{{ $user->name }}</b></b>
                 </li>
                 {{-- <li class="nav-item">
                        <b class="nav-link">Username <b class="float-right ">{{ $user->username }}</b></b>
                    </li>
                    <li class="nav-item">
                        <b class="nav-link">Phone <b class="float-right ">{{ $user->phone }}</b></b>
                    </li> --}}
                 <li class="nav-item">
                     <b class="nav-link">Email <b class="float-right ">{{ $user->email }}</b></b>
                 </li>
                 {{-- <li class="nav-item">
                        <b class="nav-link">Role <b class="float-right ">
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </b></b>
                    </li> --}}
             </ul>
         </x-adminlte-profile-widget>
     </div>
     <div class="col-md-8">
         <x-adminlte-card title="Identitas User" theme="primary">
             <form wire:submit="save"  id="formUpdate" >
                 @csrf
                 <input type="hidden" name="id" value="{{ $user->id }}">
                 <x-adminlte-input  wire:model="name" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="name" label="Nama" value="{{ $user->name }}"
                     placeholder="Nama Lengkap" enable-old-support required />
                 {{-- <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="phone" type="number" value="{{ $user->phone }}"
                     label="Nomor HP / Telepon" placeholder="Nomor HP / Telepon yang dapat dihubungi"
                     enable-old-support /> --}}
                 <x-adminlte-input wire:model="email" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="email" type="email" value="{{ $user->email }}" label="Email"
                     placeholder="Email" enable-old-support required />
                 {{-- <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="username" label="Username" value="{{ $user->username }}"
                     placeholder="Username" enable-old-support required />
                 <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="password" type="password" value="" label="Password"
                     placeholder="Password" />
                 <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                     igroup-size="sm" name="password_confirmation" value="" type="password"
                     label="Konfirmasi Password" placeholder="Konfirmasi Password" /> --}}
             </form>
             <x-slot name="footerSlot">
                 <x-adminlte-button label="Update" type="submit" form="formUpdate" theme="warning"
                     icon="fas fa-edit" />
             </x-slot>
         </x-adminlte-card>
     </div>
 </div>
