<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <h5 class="mb-0 fw-bold text-dark">
                <i class="bi bi-telephone-fill text-success me-2"></i>Listado General de Teléfonos
            </h5>
            <small class="text-muted">
                Total de registros: <?= esc($total) ?>
                <?php if (!empty($personaFiltro)): ?>
                    | Filtrado para: <strong><?= esc($personaFiltro['nombres'] . ' ' . $personaFiltro['apellidos']) ?></strong>
                <?php endif; ?>
            </small>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= base_url('telefono/add' . (!empty($idpersona) ? '/' . $idpersona : '')) ?>" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Teléfono
            </a>
            <a href="<?= base_url('telefono') ?>" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-card-text me-1"></i> Ficha Registro
            </a>
        </div>
    </div>

    <!-- Barra de Búsqueda -->
    <div class="p-3 bg-light border-bottom">
        <form method="get" action="<?= base_url('telefono/listar') ?>" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                    <input type="text" name="q" class="form-control" placeholder="Buscar por número, persona, cédula..." value="<?= esc($search ?? '') ?>">
                </div>
            </div>
            <?php if (!empty($idpersona)): ?>
                <input type="hidden" name="idpersona" value="<?= esc($idpersona) ?>">
            <?php endif; ?>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Buscar</button>
                <?php if (!empty($search) || !empty($idpersona)): ?>
                    <a href="<?= base_url('telefono/listar') ?>" class="btn btn-outline-secondary btn-sm">Limpiar Filtros</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 70px;">ID</th>
                        <th>Persona Propietaria</th>
                        <th>Tipo</th>
                        <th>Número</th>
                        <th>F. Obtención</th>
                        <th class="text-end" style="width: 170px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($telefonos)): ?>
                        <?php foreach ($telefonos as $t): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-secondary border">#<?= esc($t['idtelefono']) ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('persona/actual/' . $t['idpersona']) ?>" class="fw-semibold text-decoration-none">
                                        <i class="bi bi-person me-1"></i><?= esc($t['nombres'] . ' ' . $t['apellidos']) ?>
                                    </a>
                                    <div class="small text-muted font-monospace">C.I. <?= esc($t['cedula']) ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-success-subtle text-success-emphasis">
                                        <?= esc($t['tipo'] ?? 'Celular') ?>
                                    </span>
                                </td>
                                <td class="fw-medium text-dark">
                                    <i class="bi bi-telephone me-1 text-muted"></i>
                                    <a href="tel:<?= esc($t['numero']) ?>" class="text-decoration-none">
                                        <?= esc($t['numero']) ?>
                                    </a>
                                </td>
                                <td class="text-muted small">
                                    <?= !empty($t['fechaoptencion']) ? date('d/m/Y', strtotime($t['fechaoptencion'])) : '-' ?>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('telefono/actual/' . $t['idtelefono']) ?>" class="btn btn-outline-primary" title="Ver Ficha">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="<?= base_url('telefono/edit/' . $t['idtelefono']) ?>" class="btn btn-outline-warning text-dark" title="Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" title="Eliminar"
                                                onclick="confirmarBorrado('<?= base_url('telefono/delete/' . $t['idtelefono']) ?>', '¿Desea eliminar el teléfono <?= esc($t['numero']) ?>?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No se encontraron teléfonos registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>