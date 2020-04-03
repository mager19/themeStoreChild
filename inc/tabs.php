<div class="col-lg-8 d-flex flex-wrap text-center justify-content-center mx-auto mt-4">
    <h3 class="mb-5">Este contenido es exclusivo para usuarios Registrados, Por favor logueate</h3>


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Acceder</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Registrarse</a>
        </div>
    </nav>
    <div class="tab-content mb-5" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <?php echo do_shortcode("[wpmem_form login]"); ?>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <?php echo do_shortcode("[wpmem_form register]"); ?>
        </div>

    </div>

</div>