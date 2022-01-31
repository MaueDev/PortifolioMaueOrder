let ClienteBtn = document.getElementById("ClienteBtn");

ClienteBtn.addEventListener('click',function()
{
    let Modal = document.getElementById('ListClienteModal');
    if(Modal.style.display == "none")
    {
        Modal.style.display = "flex";
    }
    else
    {
        Modal.style.display = "none";
    }
})

function SetarCliente(produtoid)
{
    let produto = document.getElementById(produtoid);
    let td = produto.getElementsByTagName("td")
    let ProdutoContent = document.getElementById('ProdutoName');
    let idProduto = document.getElementById('IdProdutoAdicionar');
    console.log(td[0].textContent)
    idProduto.value = td[0].textContent;
    ProdutoContent.value = td[1].textContent;
}

function filterFunction(inputserch,containerprod,tags) {
  var input, filter, ul, li, a, i;
  input = document.getElementById(inputserch);
  filter = input.value.toUpperCase();
  div = document.getElementById(containerprod);
  a = div.getElementsByTagName(tags);
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}