<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <div class="modal fade" id="modalEstadoTurnos" tabindex=-1 role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <select id="estado" class="form-control">
                        <option value="PRE">presente</option>
                        <option value="AcA">ausente con aviso</option>
                        <option value="AsA">ausente sin aviso</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" id="actualizar" class="btn btn-success">actualizar</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">cancelar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

