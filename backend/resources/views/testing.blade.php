<div class="container">
    <form action="{{ route('testing') }}" method='post'>
        @csrf
        <input type="text" name='test'>
        <input type="submit">
    </form>
</div>
