<div>
    Token = {{ $token ?? 'Belum ada token' }}
    <br>
    <x-adminlte-button class="btn-sm" wire:click='generateToken' icon="fas fa-sync" theme="success" label="Get Token" />
</div>
