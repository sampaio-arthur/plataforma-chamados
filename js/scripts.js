/* scripts JS */ 
$(document).ready(function() {
    $('.summernote').summernote({
        height: 200
    });

    let contatoIndex = 1;
    $('#add-contato').click(function() {
        $('#contatos-container').append(`
            <div class="form-group contato">
                <label for="nome_contato">Nome do Contato:</label>
                <input type="text" class="form-control" id="nome_contato" name="contatos[${contatoIndex}][nome]" required>
                <label for="telefone_contato">Telefone:</label>
                <input type="text" class="form-control" id="telefone_contato" name="contatos[${contatoIndex}][telefone]" required>
                <label for="observacao_contato">Observação:</label>
                <input type="text" class="form-control" id="observacao_contato" name="contatos[${contatoIndex}][observacao]">
            </div>
        `);
        contatoIndex++;
    });
});
