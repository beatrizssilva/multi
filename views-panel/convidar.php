<h3>Convidar</h3>
<div class="convidar">
    <div class="convidar-form">
        <form method="post" action="<?php echo BASE_URL;?>painel/convite" class="col-md-5">
            <div class="form-group">
                <label for="nome">Nome do Convidado:*</label>
                <input type="email" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail do Convidado:*</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            
            <button type="submit" class="btn btn-primary">Convidar</button>
          </form>
    </div>
    <div class="convidar-link">
        <h4>Compartilhar Link de Convite:</h4>
        <form method="post" class="col-md-5">
            <div class="form-inline">
                <label for="link">Link:</label>
                <input type="texte" class="form-control" id="nome" name="link" value="3239eueu" disabled="disabled">
            </div>
        </form>
    </div>
    <div class="convidados">
        <h3>Convites Enviados</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Status</th>
                    <th>reenviar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
                    <td>Renviar Convite</td>
                </tr>
                <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                    <td>Renviar Convite</td>
                </tr>
                <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                    <td>Renviar Convite</td>
                </tr>
                <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                    <td>Renviar Convite</td>
                </tr>
            </tbody>
          </table>
    </div>
</div>