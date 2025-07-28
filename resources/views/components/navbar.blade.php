<nav class="navbar navbar-expand-lg bg-secondary">
    <div class="container">
      <img src="{{ asset('img/buildings.svg') }}" height="70" alt="Logo"/>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <div class="navbar-nav ms-auto">
          <x-nav-link href="/"
            :type="request()->is('/') ? 'btn' : 'a'"
            :active="request()->is('/') ? true : false"
          >
            Home
          </x-nav-link>
          <x-nav-link href="/testeI"
            :type="request()->is('testeI') ? 'btn' : 'a'"
            :active="request()->is('testeI') ? true : false"
          >
            Z-Teste
          </x-nav-link>
          <x-nav-link href="/testeII"
            :type="request()->is('testeII') ? 'btn' : 'a'"
            :active="request()->is('testeII') ? true : false"
          >
            Z-TesteII
          </x-nav-link>
        </div>
      </div>
    </div>
</nav>
