<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <span class="fw-bold">
                    <i class="bi bi-plus-circle me-2"></i>Registrar Nuevo Teléfono
                </span>
                <a href="<?= !empty($idpersonaSeleccion) ? base_url('persona/actual/' . $idpersonaSeleccion) : base_url('telefono') ?>" class="btn btn-sm btn-light">
                    <i class="bi bi-arrow-left me-1"></i> Cancelar / Volver
                </a>
            </div>

            <form method="post" action="<?= base_url('telefono/store') ?>">
                <?= csrf_field() ?>

                <?php if (!empty($idpersonaSeleccion)): ?>
                    <input type="hidden" name="retornar_persona" value="1">
                <?php endif; ?>

                <div class="card-body">
                    <!-- Selector de Persona -->
                    <div class="mb-3">
                        <label for="idpersona" class="form-label fw-semibold">Persona Propietaria <span class="text-danger">*</span></label>
                        <select class="form-select <?= isset($errors['idpersona']) ? 'is-invalid' : '' ?>" id="idpersona" name="idpersona" required>
                            <option value="">-- Seleccione una Persona --</option>
                            <?php foreach ($personas as $p): ?>
                                <option value="<?= esc($p['idpersona']) ?>" <?= ((isset($old['idpersona']) && $old['idpersona'] == $p['idpersona']) || ($idpersonaSeleccion == $p['idpersona'])) ? 'selected' : '' ?>>
                                    <?= esc($p['apellidos'] . ' ' . $p['nombres']) ?> (C.I. <?= esc($p['cedula']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['idpersona'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['idpersona']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Número de Teléfono -->
                    <div class="mb-3">
                        <label for="numero" class="form-label fw-semibold">Número de Teléfono <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control <?= isset($errors['numero']) ? 'is-invalid' : '' ?>" id="numero" name="numero" value="<?= esc($old['numero'] ?? old('numero')) ?>" placeholder="0987654321" required>
                            <?php if (isset($errors['numero'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['numero']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row g-3">
                        <!-- Tipo de Teléfono -->
                        <div class="col-md-6">
                            <label for="tipo" class="form-label fw-semibold">Tipo de Teléfono</label>
                            <select class="form-select <?= isset($errors['tipo']) ? 'is-invalid' : '' ?>" id="tipo" name="tipo">
                                <option value="Celular" <?= (isset($old['tipo']) && $old['tipo'] === 'Celular') ? 'selected' : '' ?>>Celular</option>
                                <option value="Convencional" <?= (isset($old['tipo']) && $old['tipo'] === 'Convencional') ? 'selected' : '' ?>>Convencional / Casa</option>
                                <option value="Trabajo" <?= (isset($old['tipo']) && $old['tipo'] === 'Trabajo') ? 'selected' : '' ?>>Trabajo</option>
                                <option value="Emergencia" <?= (isset($old['tipo']) && $old['tipo'] === 'Emergencia') ? 'selected' : '' ?>>Emergencia</option>
                            </select>
                        </div>

                        <!-- Fecha de Obtención -->
                        <div class="col-md-6">
                            <label for="fechaoptencion" class="form-label fw-semibold">Fecha de Obtención</label>
                            <input type="date" class="form-control <?= isset($errors['fechaoptencion']) ? 'is-invalid' : '' ?>" id="fechaoptencion" name="fechaoptencion" value="<?= esc($old['fechaoptencion'] ?? date('Y-m-d')) ?>">
                            <?php if (isset($errors['fechaoptencion'])): ?>
                                <div class="invalid-feedback"><?= esc($errors['fechaoptencion']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-between">
                    <a href="<?= !empty($idpersonaSeleccion) ? base_url('persona/actual/' . $idpersonaSeleccion) : base_url('telefono') ?>" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle-fill me-1"></i> Guardar Teléfono
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>