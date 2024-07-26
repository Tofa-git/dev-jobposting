<div class="ms-2 p-1 px-3 bg-white shadow-sm" style="border-bottom-left-radius: 10px">
    <span class="fs-4 fw-lighter">{{ $title }}</span>
</div>
<div class="d-flex flex-fill flex-column shadow-sm bg-white overflow-hidden ms-2 mt-1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top: 1px solid #dddddd; border-left: 1px solid #dddddd; border-bottom: 1px solid #dddddd;">
	<div class="flex-shrink-1 bg-light">
		<ul class="tab-custom mt-1">
            <li class="nav-item" role="presentation">
                <a href="{{ route('mitra-dan-klien.index', ['tab'=>'mitra perusahaan']) }}" class="@if($tab_active==='mitra perusahaan') active @endif">Mitra Perusahaan</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('mitra-dan-klien.index', ['tab'=>'mitra perseorangan']) }}" class="@if($tab_active==='mitra perseorangan') active @endif">Mitra Perseorangan</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{ route('mitra-dan-klien.index', ['tab'=>'klien']) }}" class="@if($tab_active==='klien') active @endif">Klien</a>
            </li>
        </ul>
    </div>
    <div class="d-flex flex-column flex-fill overflow-hidden">
        @include('backend.mitra dan klien.'.$tab_active.'.index')
    </div>
</div>

@include('backend.partials.form', [
    'modal_type'    => 'modal-lg',
    'title'         => $title
])