<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">User</p>
                {{-- <div>
                        <form wire:submit.prevent="save">
                            <input type="text" wire:model="title">
                            <input type="text" wire:model="content">
                            <button type="submit">Save</button>
                        </form>
                        <button type="button" wire:click="download">
                            Download Invoice
                        </button>
                    </div> --}}
                <div> <!-- Added this wrapping div -->
                    <div>
                        Some content
                    </div>

                    <button wire:click="download">Do Something</button>
                </div>
            </div>
        </div>
    </div>
</div>
