<div>
    @foreach ($jaminans as $item)
       -  {{ $item->kode }} {{ $item->slug }} {{ $item->nama }} <br>
    @endforeach
</div>
