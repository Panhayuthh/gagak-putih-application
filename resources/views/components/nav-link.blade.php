@props(['active' => false])

<a 
    class="nav-link text-uppercase fw-semibold px-3 {{ $active ? 'active' : '' }}" 
    aria-current="{{ $active ? 'page' : 'false' }}" 
    {{ $attributes }}
>
    {{ $slot }}
</a>