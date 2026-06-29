document.addEventListener('DOMContentLoaded', function() {

    const formEncomenda = document.getElementById('formEncomenda');

    if (formEncomenda) {

        // calcula o subtotal do pedido com base no produto e quantidade
        const selectProduto = document.getElementById('produto');
        const inputQuantidade = document.getElementById('quantidade');
        const inputSubtotal = document.getElementById('subtotal');

        function calcularSubtotal() {
            const opcaoSelecionada = selectProduto.options[selectProduto.selectedIndex];
            const precoBase = parseFloat(opcaoSelecionada.getAttribute('data-preco')) || 0;
            const quantidade = parseInt(inputQuantidade.value) || 1;
            const total = precoBase * quantidade;

            inputSubtotal.value = "R$ " + total.toFixed(2).replace('.', ',');
        }

        selectProduto.addEventListener('change', calcularSubtotal);
        inputQuantidade.addEventListener('input', calcularSubtotal);


        // mostra o bloco de endereço só quando o cliente escolhe "Entrega"
        const radiosRecebimento = document.getElementsByName('recebimento');
        const grupoEndereco = document.getElementById('grupoEndereco');
        const camposEndereco = grupoEndereco.querySelectorAll('input[type="text"]');

        for (let i = 0; i < radiosRecebimento.length; i++) {
            radiosRecebimento[i].addEventListener('change', function() {
                if (this.value === 'Entrega') {
                    grupoEndereco.classList.remove('oculto');
                    for (let j = 0; j < camposEndereco.length; j++) {
                        camposEndereco[j].required = true;
                    }
                } else {
                    grupoEndereco.classList.add('oculto');
                    for (let j = 0; j < camposEndereco.length; j++) {
                        camposEndereco[j].required = false;
                        camposEndereco[j].value = '';
                    }
                }
            });
        }

        // envio do formulário e validação do campo de observações quando o sabor escolhido for "Misto"
        formEncomenda.addEventListener('submit', function(event) {
            const saborEscolhido = document.getElementById('sabor').value;
            const observacoesDigitadas = document.getElementById('observacoes').value;

            if (saborEscolhido === 'Misto' && observacoesDigitadas.trim() === '') {
                event.preventDefault();
                alert('Você escolheu "Misto", preencha as observações pra dizer como dividir os sabores.');
                document.getElementById('observacoes').focus();
            }
        });
    }


    // monta o recibo na formAction.html lendo os parametros do GET
    const areaRecibo = document.getElementById('reciboPedido');

    if (areaRecibo) {
        const parametros = new URLSearchParams(window.location.search);

        const nome = parametros.get('nome');
        const telefone = parametros.get('telefone');
        const sabor = parametros.get('sabor');
        const produto = parametros.get('produto');
        const quantidade = parametros.get('quantidade');
        const observacoes = parametros.get('observacoes');
        const subtotal = parametros.get('subtotal');
        const recebimento = parametros.get('recebimento');
        const rua = parametros.get('rua');
        const numero = parametros.get('numero');
        const bairro = parametros.get('bairro');

        if (nome) {
            let htmlRecibo = '<h2>Detalhes da sua Encomenda</h2>';
            htmlRecibo += '<p><strong>Cliente:</strong> ' + nome + '</p>';
            htmlRecibo += '<p><strong>Contato (WhatsApp):</strong> ' + telefone + '</p>';
            htmlRecibo += "<hr class='linha-divisoria'>";
            htmlRecibo += '<p><strong>Produto:</strong> ' + produto + '</p>';
            htmlRecibo += '<p><strong>Sabor(es):</strong> ' + sabor + '</p>';
            htmlRecibo += '<p><strong>Quantidade:</strong> ' + quantidade + '</p>';

            if (subtotal) {
                htmlRecibo += '<p><strong>Subtotal Estimado:</strong> ' + subtotal + '</p>';
            }

            htmlRecibo += "<hr class='linha-divisoria'>";
            htmlRecibo += '<p><strong>Método:</strong> ' + recebimento + '</p>';

            if (recebimento === 'Entrega' && rua) {
                htmlRecibo += '<p><strong>Endereço de Entrega:</strong> ' + rua + ', ' + numero + ' - ' + bairro + ' (Curitiba)</p>';
            }

            if (observacoes) {
                htmlRecibo += "<hr class='linha-divisoria'>";
                htmlRecibo += '<p><strong>Observações:</strong> ' + observacoes + '</p>';
            }

            htmlRecibo += "<br><p class='mensagem-sucesso'>Muito obrigado pela preferência!<br> Seu pedido foi registrado com sucesso, e logo entraremos em contato para a confirmação do pedido e demais informações.</p>";

            areaRecibo.innerHTML = htmlRecibo;
        } else {
            areaRecibo.innerHTML = "<p class='mensagem-erro'>Nenhum pedido encontrado. Por favor, volte à página de encomendas e preencha o formulário.</p>";
        }
    }
});