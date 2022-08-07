<div class="app-card app-card-stats-table h-100 shadow-sm soal-div">
    <div class="app-card-header p-3">
        <div class="row text-center">
            <h4 class="app-card-title">Soal Pilgan Nomor {nomor}</h4>
        </div>
    </div>
    <div class="app-card-body p-3 p-lg-4">
        <form class="form" method="POST">
            {if $img }
            <img src="{img}" class="img-fluid rounded mx-auto d-block">
            {endif}
            <p for="token" class="mb-2">{soal}</p>
            {pilihan}
            <div class="mb-3">
                <input type="radio" class="btn-check" name="id_pilgan" id="option{abc}" value="{id}">
                <label class="btn app-btn-secondary" for="option{abc}">{abc}.</label>
                {text}
            </div>
            {/pilihan}
    </div>
</div>