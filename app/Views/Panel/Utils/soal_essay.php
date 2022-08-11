<div class="app-card app-card-stats-table h-100 shadow-sm soal-div">
    <div class="app-card-header p-3">
        <div class="row text-center">
            <h4 class="app-card-title">Soal Essay Nomor {nomor}</h4>
        </div>
    </div>
    <div class="app-card-body p-3 p-lg-4">
        <form class="form" action="{link_jawab}" method="POST">
            {if $img }
            <img src="{img}" class="img-fluid rounded mx-auto d-block">
            {endif}
            <p for="token" class="mb-2">{soal}</p>
            <input type="hidden" name="tipe" value="essay">
            <textarea id="summernote" name="jawaban">
            {if $jawaban}
            {jawaban|esc(html)}
            {endif}
            </textarea>
    </div>
</div>