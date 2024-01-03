<div>
    @foreach(['success', 'message', 'error'] as $type)
        @if ($message = Session::get($type))
            <div class="alertbox hidden fixed top-0 left-0 w-full bg-{{ $type === 'error' ? 'red' : 'green' }}-100 border border-{{ $type === 'error' ? 'red' : 'green' }}-400 text-{{ $type === 'error' ? 'red' : 'green' }}-700 px-4 rounded text-center z-50" role="alert">
                <strong class="font-bold">{{ $message }}</strong>
            </div>
        @endif
    @endforeach
</div>
<script>
    $(function(){ $('.alertbox').fadeIn(); });
    setTimeout(function() { $('.alertbox').fadeOut(); }, 3000);
</script>
