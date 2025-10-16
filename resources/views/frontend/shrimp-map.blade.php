@extends('frontend.layouts.app')

@section('title', 'Shrimp Sites Map - Punjab Fisheries')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #shrimpMap { height: 70vh; width: 100%; }
        .leaflet-popup-content { width: 280px; }
        .popup-images { display: flex; gap: 6px; margin: 8px 0; }
        .popup-images img { width: 90px; height: 60px; object-fit: cover; border-radius: 6px; }
        .popup-actions { display: flex; gap: 8px; margin-top: 6px; }
        .btn-sm { padding: 6px 10px; border-radius: 6px; font-size: 12px; line-height: 1; }
        .btn-primary { background: #008ffb; color: #fff; }
        .btn-secondary { background: #e9ecef; color: #111827; }
        /* Simple search bar above the map */
        .site-search-wrap { position: relative; max-width: 520px; }
        .site-search { width: 100%; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #e5e7eb; border-radius: 999px; padding: 8px 12px; box-shadow: 0 10px 20px rgba(0,0,0,.04); }
        .site-search input { flex:1; border:none; outline:none; font-size:14px; background:transparent; }
        .site-search .map-search-btn { background:#008ffb; color:#fff; border:none; border-radius:999px; padding:8px 14px; font-size:13px; cursor:pointer; }
        .site-suggestions { position:absolute; top: 50px; left:0; right:0; background:#fff; border:1px solid #e5e7eb; border-radius:12px; box-shadow: 0 16px 30px rgba(0,0,0,.08); max-height: 280px; overflow:auto; display:none; z-index: 10; }
        .site-suggestions ul{ list-style:none; margin:0; padding:6px; }
        .site-suggestions li{ padding:8px 10px; border-radius:8px; cursor:pointer; }
        .site-suggestions li:hover, .site-suggestions li.active{ background:#f3f4f6; }
        .site-suggestions .meta{ font-size:12px; color:#6b7280; }
        /* Overlay search on map */
        .map-wrap{ position:relative; }
        .map-search{ position:absolute; top:12px; left:12px; right:12px; display:flex; justify-content:center; pointer-events:none; z-index:500; }
        .map-search-inner{ width:min(420px,96%); background:rgba(255,255,255,0.96); backdrop-filter:saturate(180%) blur(10px); border:1px solid #e6e8ec; border-radius:999px; box-shadow:0 4px 14px rgba(0,0,0,.06); display:flex; align-items:center; gap:10px; padding:8px 12px; pointer-events:auto; }
        .map-search-inner:focus-within{ border-color:#93c5fd; box-shadow:0 0 0 3px rgba(59,130,246,.15), 0 6px 18px rgba(0,0,0,.07); }
        .map-search-inner input{ text-align:left; }
        [dir="rtl"] .map-search-inner input{ text-align:right; }
        .map-suggestions{ position:absolute; top:56px; left:50%; transform:translateX(-50%); width:min(480px,96%); background:#fff; border:1px solid #eaecf0; border-radius:14px; box-shadow:0 14px 26px rgba(0,0,0,.10); max-height:320px; overflow:auto; display:none; z-index:600; pointer-events:auto; }
        .map-suggestions ul{ list-style:none; margin:0; padding:6px; }
        .map-suggestions li{ display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:10px; cursor:pointer; }
        .map-suggestions li:hover, .map-suggestions li.active{ background:#f3f4f6; }
        .map-suggestions .title{ font-weight:600; color:#111827; }
        .map-suggestions .meta{ font-size:12px; color:#6b7280; }
        .modal-backdrop { position: fixed; inset: 0; background: rgba(0,0,0,.5); display: none; align-items: center; justify-content: center; z-index: 1000; }
        .modal-card { background: #fff; width: min(900px, 96vw); max-height: 90vh; overflow: auto; border-radius: 10px; padding: 18px; }
        .modal-head { display:flex; align-items:center; justify-content: space-between; margin-bottom: 10px; }
        .close-x { cursor: pointer; font-size: 22px; line-height: 1; }
        .detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
        @media (max-width: 768px){ .detail-grid{ grid-template-columns: 1fr; } #shrimpMap{ height: 60vh; } }
    </style>
@endpush

@section('content')
<section class="py-120 bg-neutral-0">
    <div class="cont">
        <h1 class="text-2xl font-bold mb-4">Shrimp Sites Map</h1>
        <div class="map-wrap">
            <div class="map-search">
                <div class="map-search-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                    <input id="siteSearchInput" type="text" placeholder="{{ app()->getLocale()==='ur' ? 'سائٹس تلاش کریں...' : 'Search shrimp sites...' }}" aria-label="Search shrimp sites" />
                    <button id="siteSearchBtn" class="map-search-btn" type="button" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path></svg>
                    </button>
                </div>
                <div id="siteSearchSug" class="map-suggestions" role="listbox" aria-label="Search suggestions"></div>
            </div>
            <div id="shrimpMap" class="rounded-lg shadow"></div>
        </div>
        <p class="mt-3 text-neutral-600">Click a marker to view site details. Use More Info for full details or Directions to open in Google Maps.</p>
    </div>
</section>

<div id="moreInfoModal" class="modal-backdrop" role="dialog" aria-modal="true">
    <div class="modal-card">
        <div class="modal-head">
            <h3 id="modalTitle" class="text-xl font-semibold">Site Details</h3>
            <span id="modalClose" class="close-x" aria-label="Close">×</span>
        </div>
        <div id="modalBody">
            <div class="detail-grid">
                <div>
                    <img id="modalImage" src="https://placehold.co/600x400" alt="Preview" style="width:100%; height:auto; border-radius:10px;" />
                </div>
                <div>
                    <p id="modalDescription" class="mb-2"></p>
                    <ul class="list-disc pl-5 text-sm">
                        <li><strong>District:</strong> <span id="modalDistrict">-</span></li>
                        <li><strong>Tehsil:</strong> <span id="modalTehsil">-</span></li>
                        <li><strong>Area:</strong> <span id="modalArea">-</span></li>
                        <li><strong>Status:</strong> <span id="modalStatus">-</span></li>
                        <li><strong>Coordinates:</strong> <span id="modalCoords">-</span></li>
                    </ul>
                    <div class="popup-actions mt-3">
                        <a id="modalDirections" target="_blank" class="btn-sm btn-primary" rel="noopener">Directions</a>
                        <button id="modalCloseBtn" class="btn-sm btn-secondary" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
(function(){
    // Center roughly on Punjab
    const center = [31.1704, 72.7097];
    const map = L.map('shrimpMap', { scrollWheelZoom: true }).setView(center, 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Build icon for a site (uses custom marker_icon if provided)
    const DEFAULT_ICON_URL = 'https://cdn-icons-png.flaticon.com/512/3069/3069730.png';
    function getIcon(site){
        const url = site && site.marker_icon ? site.marker_icon : DEFAULT_ICON_URL;
        return L.icon({ iconUrl: url, iconSize: [32,32], iconAnchor: [16,32], popupAnchor: [0,-28] });
    }

    // Load sites from backend
    let sites = [];
    fetch('{{ route('frontend.shrimp.json') }}', { headers: { 'Accept': 'application/json' }})
      .then(r => r.json())
      .then(data => {
        sites = Array.isArray(data) ? data : [];
        renderMarkers();
      })
      .catch(() => { sites = []; renderMarkers(); });

    function buildPopupHTML(site){
        const imgs = (site.images || []).slice(0,3).map(src => `<img src="${src}" alt="${site.name}">`).join('');
        const gmaps = `https://www.google.com/maps/dir/?api=1&destination=${site.lat},${site.lng}`;
        return `
            <div>
                <h4 style="font-weight:700; margin:0 0 6px">${site.name}</h4>
                <div class="text-sm">${site.district || ''}${site.tehsil ? ', ' + site.tehsil : ''}</div>
                <div class="popup-images">${imgs}</div>
                <div class="popup-actions">
                    <button class="btn-sm btn-secondary" data-more="${site.id}">More Info</button>
                    <a class="btn-sm btn-primary" href="${gmaps}" target="_blank" rel="noopener">Directions</a>
                </div>
            </div>
        `;
    }

    function renderMarkers(){
        const markers = {};
        const latlngs = [];
        (sites || []).forEach(site => {
            const lat = parseFloat(site.lat);
            const lng = parseFloat(site.lng);
            if(Number.isNaN(lat) || Number.isNaN(lng)) return; // skip invalid
            const marker = L.marker([lat, lng], { icon: getIcon(site) }).addTo(map);
            // Custom click: zoom first, then open popup to avoid immediate open
            marker.on('click', function(){
                const target = [lat, lng];
                const zoomLevel = Math.max(map.getZoom(), 7) < 14 ? 14 : map.getZoom();
                // Fly to marker position with a smooth animation
                map.flyTo(target, zoomLevel, { duration: 0.6 });
                // After the map finishes moving/zooming, open the popup
                map.once('moveend', function(){
                    const popup = L.popup({ offset: [0, -28] })
                        .setLatLng(target)
                        .setContent(buildPopupHTML(site))
                        .openOn(map);
                    // Attach More Info button handler once popup DOM is in place
                    setTimeout(function(){
                        const container = popup.getElement();
                        if(!container) return;
                        const btn = container.querySelector('[data-more]');
                        if(btn){ btn.addEventListener('click', function(){ openMoreInfo(site); }); }
                    }, 0);
                });
            });
            markers[site.id] = marker;
            latlngs.push([lat, lng]);
        });
        if(latlngs.length){
            const bounds = L.latLngBounds(latlngs);
            map.fitBounds(bounds.pad(0.2));
        }
    }

    // --- Search (above map) ---
    const sInput = document.getElementById('siteSearchInput');
    const sBtn = document.getElementById('siteSearchBtn');
    const sSug = document.getElementById('siteSearchSug');
    let sActive = -1;

    function nrm(v){ return (v||'').toString().toLowerCase().trim(); }
    function siteMatches(q, s){
        const blob = [s.name, s.tehsil, s.district].filter(Boolean).join(' ').toLowerCase();
        return blob.includes(nrm(q));
    }
    function filterSites(q){
        const N = nrm(q); if(!N) return [];
        return (sites||[]).filter(s=>siteMatches(N,s)).slice(0,8);
    }
    function renderSug(items){
        if(!items.length){ sSug.style.display='none'; sSug.innerHTML=''; return; }
        sSug.innerHTML = '<ul>' + items.map((s,i)=>{
            const meta = [s.tehsil, s.district].filter(Boolean).join(', ');
            const active = i===sActive ? ' class="active"' : '';
            return `<li${active} data-id="${s.id}"><div>${s.name}</div><div class="meta">${meta}</div></li>`;
        }).join('') + '</ul>';
        sSug.style.display='block';
    }
    function clearSug(){ sActive=-1; renderSug([]); }
    function zoomAndPopup(site){
        const lat = parseFloat(site.lat), lng = parseFloat(site.lng);
        if(Number.isNaN(lat) || Number.isNaN(lng)) return;
        const target=[lat,lng];
        const zoomLevel = Math.max(map.getZoom(), 7) < 14 ? 14 : map.getZoom();
        map.flyTo(target, zoomLevel, { duration: 0.6 });
        map.once('moveend', function(){
            const popup = L.popup({ offset: [0, -28] })
                .setLatLng(target)
                .setContent(buildPopupHTML(site))
                .openOn(map);
            setTimeout(function(){
                const container = popup.getElement();
                if(!container) return;
                const btn = container.querySelector('[data-more]');
                if(btn){ btn.addEventListener('click', function(){ openMoreInfo(site); }); }
            }, 0);
        });
    }
    function selectSiteById(id){
        const site = (sites||[]).find(s => String(s.id)===String(id));
        if(!site) return; zoomAndPopup(site); clearSug(); try{ sInput.value = site.name; sInput.blur(); }catch(e){}
    }
    sInput.addEventListener('input', function(){ sActive=-1; renderSug(filterSites(this.value)); });
    sInput.addEventListener('focus', function(){ renderSug(filterSites(this.value)); });
    sInput.addEventListener('blur', function(){ setTimeout(clearSug, 120); });
    sBtn.addEventListener('click', function(){ const items=filterSites(sInput.value); if(items.length){ zoomAndPopup(items[0]); clearSug(); }});
    sInput.addEventListener('keydown', function(e){
        const items = filterSites(sInput.value);
        if(['ArrowDown','ArrowUp'].includes(e.key)){
            e.preventDefault(); if(!items.length) return;
            if(e.key==='ArrowDown') sActive = (sActive+1)%items.length;
            if(e.key==='ArrowUp') sActive = (sActive-1+items.length)%items.length;
            renderSug(items); return;
        }
        if(e.key==='Enter'){
            e.preventDefault(); if(items.length){ zoomAndPopup(items[Math.max(0,sActive)]||items[0]); clearSug(); }
        }
        if(e.key==='Escape'){ clearSug(); }
    });
    sSug.addEventListener('mousedown', function(e){
        e.preventDefault(); e.stopPropagation();
        const li = e.target.closest('li[data-id]'); if(!li) return; selectSiteById(li.getAttribute('data-id'));
    });

    const modal = document.getElementById('moreInfoModal');
    const closeEls = [document.getElementById('modalClose'), document.getElementById('modalCloseBtn')];

    function openMoreInfo(site){
        document.getElementById('modalTitle').textContent = site.name;
        document.getElementById('modalDescription').textContent = site.description || '';
        document.getElementById('modalDistrict').textContent = site.district || '-';
        document.getElementById('modalTehsil').textContent = site.tehsil || '-';
        document.getElementById('modalArea').textContent = (site.area_acres ? site.area_acres + ' acres' : '-');
        document.getElementById('modalStatus').textContent = site.status || '-';
        document.getElementById('modalCoords').textContent = `${site.lat}, ${site.lng}`;
        document.getElementById('modalImage').src = (site.images && site.images[0]) ? site.images[0] : 'https://placehold.co/600x400';
        document.getElementById('modalDirections').href = `https://www.google.com/maps/dir/?api=1&destination=${site.lat},${site.lng}`;
        modal.style.display = 'flex';
    }

    closeEls.forEach(el => el && el.addEventListener('click', () => modal.style.display = 'none'));
    modal.addEventListener('click', (e) => { if(e.target === modal){ modal.style.display = 'none'; } });
})();
</script>
@endpush
