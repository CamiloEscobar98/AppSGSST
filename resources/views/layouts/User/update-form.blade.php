<form action="{{ route('user.update') }}" method="post">
    @csrf
    @method('put')
    @if (session('role') != 'administrador')
        <input type="hidden" name="email" value="{{ Auth()->user()->email }}">
    @endif
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="name" class="font-weight-bold text-capitalize">Nombres:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="helpId" placeholder="Escribe tu nombre.." value="{{ Auth()->user()->name }}"
                    {{ session('role') != 'administrador' ? 'disabled' : '' }}>
                @error('name')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="lastname" class="font-weight-bold text-capitalize">Apellidos:</label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                    id="lastname" aria-describedby="helpId" placeholder="Escribe tu nombre.."
                    value="{{ Auth()->user()->lastname }}" {{ session('role') != 'administrador' ? 'disabled' : '' }}>
                @error('lastname')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone" class="font-weight-bold">Teléfono:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " name="phone" id="phone"
                    aria-describedby="helpId" placeholder="Escribe tu nombre.." value="{{ Auth()->user()->phone }}">
                @error('phone')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label for="email" class="font-weight-bold">Correo electrónico:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" aria-describedby="helpId"
                    placeholder="Escribe tu nombre.." value="{{ Auth()->user()->email }}"
                    {{ session('role') != 'administrador' ? 'disabled' : '' }}>
                @error('email')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="birthday" class="font-weight-bold">Fecha de nacimiento:</label>
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" id="birthday" aria-describedby="helpId"
                    value="{{ Auth()->user()->birthday }}" {{ session('role') != 'administrador' ? 'disabled' : '' }}>
                @error('birthday')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="document" class="font-weight-bold">Documento:</label>
                <input type="text" class="form-control @error('document') is-invalid @enderror" name="document" id="document" aria-describedby="helpId"
                    placeholder="Escribe tu nombre.." value="{{ Auth()->user()->document->document }}"
                    {{ session('role') != 'administrador' ? 'disabled' : '' }}>
                @error('document')
                    <small id="helpId"
                        class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="address" class="font-weight-bold">Dirección de residencia:</label>
        <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"
            aria-describedby="helpId">{{ Auth()->user()->address }}</textarea>
        @error('address')
            <small id="helpId" class="form-text bg-danger font-weight-bold py-2 text-white px-2">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-success btn-block">Actualizar</button>
    </div>

</form>
