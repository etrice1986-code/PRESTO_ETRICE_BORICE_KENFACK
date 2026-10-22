@props(['img'])

@php
$likeliHoodName = [
    
    0 => ['bg' => 'secondary', 'icon' => 'bi-circle-fill'],
    1 => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
    2 => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
    3 => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
    4 => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
    5 => ['bg' => 'danger',    'icon' => 'bi-dash-circle-fill'],

    
    'UNKNOWN'       => ['bg' => 'secondary', 'icon' => 'bi-circle-fill'],
    'VERY_UNLIKELY' => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
    'UNLIKELY'      => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
    'POSSIBLE'      => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
    'LIKELY'        => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
    'VERY_LIKELY'   => ['bg' => 'danger',    'icon' => 'bi-dash-circle-fill'],

   
    'text-secondary bi bi-circle-fill'             => ['bg' => 'secondary', 'icon' => 'bi-circle-fill'],
    'text-success bi bi-check-circle-fill'         => ['bg' => 'success',   'icon' => 'bi-check-circle-fill'],
    'text-warning bi bi-exclamation-circle-fill'   => ['bg' => 'warning',   'icon' => 'bi-exclamation-circle-fill'],
    'text-danger bi bi-dash-circle-fill'           => ['bg' => 'danger',    'icon' => 'bi-dash-circle-fill'],
];
@endphp

<div class="d-flex flex-wrap gap-2 mb-2">
   
    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->adult]['bg'] ?? 'secondary' }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
        <i class="bi {{ $likeliHoodName[$img->adult]['icon'] ?? 'bi-circle-fill' }}" style="font-size: 1.3rem;"></i> Adulti
    </span>

    
    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->spoof]['bg'] ?? 'secondary' }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
        <i class="bi {{ $likeliHoodName[$img->spoof]['icon'] ?? 'bi-circle-fill' }}" style="font-size: 1.3rem;"></i> Satira
    </span>

    
    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->medical]['bg'] ?? 'secondary' }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
        <i class="bi {{ $likeliHoodName[$img->medical]['icon'] ?? 'bi-circle-fill' }}" style="font-size: 1.3rem;"></i> Medicina
    </span>

   
    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->violence]['bg'] ?? 'secondary' }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
        <i class="bi {{ $likeliHoodName[$img->violence]['icon'] ?? 'bi-circle-fill' }}" style="font-size: 1.3rem;"></i> Violenza
    </span>

    
    <span class="badge px-3 py-1 bg-{{ $likeliHoodName[$img->racy]['bg'] ?? 'secondary' }} text-white rounded-pill d-flex align-items-center gap-2" style="font-size: 0.85rem;">
        <i class="bi {{ $likeliHoodName[$img->racy]['icon'] ?? 'bi-circle-fill' }}" style="font-size: 1.3rem;"></i> Racy
    </span>
</div>
