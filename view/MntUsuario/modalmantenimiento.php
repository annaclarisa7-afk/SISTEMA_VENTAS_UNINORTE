<div id="modalmantenimiento" class="modal fade" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="mdltitulo">Nuevo Registro</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="usuario_form">
                <div class="modal-body pd-25">
                    <input type="hidden" id="usu_id" name="usu_id">

                    <div class="form-group mg-b-15">
                        <label class="form-control-label" for="usu_nom">Nombre <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" id="usu_nom" name="usu_nom" placeholder="Ingrese Nombre" required>
                    </div>

                    <div class="form-group mg-b-15">
                        <label class="form-control-label" for="usu_sesion">Usuario (Sesión) <span class="tx-danger">*</span></label>
                        <input type="text" class="form-control" id="usu_sesion" name="usu_sesion" placeholder="Ingrese Usuario" required>
                    </div>

                    <div class="form-group mg-b-15">
                        <label class="form-control-label" id="lbl_usu_clave" for="usu_clave">Contraseña <span class="tx-danger" id="span_clave_required">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="usu_clave" name="usu_clave" placeholder="Ingrese Contraseña" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btnToggleClave">
                                    <i class="fa fa-eye" id="iconToggleClave"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
