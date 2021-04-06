<form action="{{ $route }}" method="post">
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Faça uma busca" aria-describedby="button-search" required>
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit" id="button-search">Buscar</button>
        </div>
    </div>
    @error('search')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</form>