<!-- BRAND LOGO AREA START -->
{{-- @php
    $item = App\Models\Brand::all();
@endphp --}}
<div class="ltn__brand-logo-area ltn__brand-logo-1 section-bg-1 pt-290 pb-110 plr--9">
    <div class="container-fluid">
        <div class="row ltn__brand-logo-active">
            @foreach (App\Models\Brand::all() as $item)
            <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="{{ asset($item->image) }}" alt="Brand Logo">
                </div>
            </div>
            @endforeach
            {{-- <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="assets/img/brand-logo/2.png" alt="Brand Logo">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="assets/img/brand-logo/3.png" alt="Brand Logo">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="assets/img/brand-logo/4.png" alt="Brand Logo">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="assets/img/brand-logo/5.png" alt="Brand Logo">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ltn__brand-logo-item">
                    <img src="assets/img/brand-logo/3.png" alt="Brand Logo">
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- BRAND LOGO AREA END -->
