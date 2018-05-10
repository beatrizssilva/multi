<h2>Meus Dados Pessoais</h2><br>
    <div class="dadosPessoais-form">
        <form method="post" action="<?php echo BASE_URL;?>painel/convite" class="col-md-5">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="form-group">
                <label for="cpf">CPF:*</label>
                <input type="text" class="form-control" id="cpf" name="cpf">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="natural">Naturalidade:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="civil">Estado Civil:</label>
                <input type="text" class="form-control" id="civil" name="civil">
            </div>            
            <div class="form-group">
                <label for="nomePai">Nome do Pai:</label>
                <input type="text" class="form-control" id="nomePai" name="nomePai">
            </div>
            <div class="form-group">
                <label for="nomeMae">Nome da Mãe:</label>
                <input type="text" class="form-control" id="nomeMae" name="nomeMae">
            </div>
            <div class="form-group">
                <label for="pis" data-toggle="tooltip" data-placement="right" 
                       title="Informação Necessária para Liberação do Pagamento!">PIS:*</label>
                <input type="text" class="form-control" id="pis" name="pis">
            </div>
            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" class="form-control" id="rg" name="rg">
            </div>
      
            <button type="button" class="btn btn-primary" onclick="editDados()">Salvar</button>
          </form>
    </div>

